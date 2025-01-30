<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ModelTransaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'user_id',
        'outlet_id',
        'wholesale_customer_id',
        'total_amount',
        'paid_amount',
        'received_amount',
        'change_amount',
        'payment_method',
        'payment_status',
        'transaction_date',
        'status',
        'sale_type',
        'bank_id'
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'total_amount' => 'integer',
        'paid_amount' => 'integer',
        'received_amount' => 'integer',
        'change_amount' => 'integer'
    ];

    // Payment method enum values
    const PAYMENT_CASH = 'tunai';
    const PAYMENT_MBANKING = 'mbanking';

    // Payment status enum values 
    const STATUS_PAID = 'lunas';
    const STATUS_CREDIT = 'bon';

    // Transaction status enum values
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_PARTIAL = 'partial';
    const STATUS_CANCELLED = 'cancelled';

    // Sale type enum values
    const SALE_RETAIL = 'ecer';
    const SALE_WHOLESALE = 'grosir';

    // Relationships
    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id')
            ->withDefault(['username' => '-']);
    }

    public function outlet()
    {
        return $this->belongsTo(ModelOutlet::class, 'outlet_id', 'outlet_id');
    }

    public function wholesaleCustomer()
    {
        return $this->belongsTo(ModelWholesaleCustomer::class, 'wholesale_customer_id', 'wholesale_customer_id')
            ->withDefault(['customer_name' => '-']);
    }

    public function bank()
    {
        return $this->belongsTo(ModelBank::class, 'bank_id', 'bank_id');
    }

    public function items()
    {
        return $this->hasMany(ModelTransactionItem::class, 'transaction_id', 'transaction_id');
    }

    public function getTotalPaidAttribute()
    {
        return $this->paymentDetails()->sum('amount');
    }

    // Add debug logging to getData method
    public static function getDebugData()
    {
        $query = self::query();
        \Log::info('SQL Query:', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);
        return $query->get();
    }

    // Add this debug method
    public static function debug()
    {
        try {
            $query = self::query();
            $data = $query->get();
            
            \Log::info('ModelTransaction Debug:', [
                'query' => $query->toSql(),
                'bindings' => $query->getBindings(),
                'count' => $data->count(),
                'data' => $data->toArray()
            ]);

            return $data;
        } catch (\Exception $e) {
            \Log::error('ModelTransaction Debug Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    public static function getTodayTransactionCount($outletGroupId)
    {
        return self::whereHas('outlet', function($query) use ($outletGroupId) {
                $query->where('outlet_group_id', $outletGroupId);
            })
            ->whereDate('created_at', now())
            ->count();
    }

    public static function getSalesReport($startDate = null, $endDate = null, $outletId = null)
    {
        $query = self::with(['user', 'outlet', 'items.product'])
            ->select([
                'transactions.*',
                DB::raw('DATE(created_at) as date')
            ]);

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);
        }

        if ($outletId) {
            $query->where('outlet_id', $outletId);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public static function getSalesSummary($transactions)
    {
        return [
            'total_transactions' => $transactions->count(),
            'total_sales' => $transactions->sum('total_amount'),
            'cash_sales' => $transactions->where('payment_method', self::PAYMENT_CASH)->sum('total_amount'),
            'mbanking_sales' => $transactions->where('payment_method', self::PAYMENT_MBANKING)->sum('total_amount'),
            'retail_sales' => $transactions->where('sale_type', self::SALE_RETAIL)->sum('total_amount'),
            'wholesale_sales' => $transactions->where('sale_type', self::SALE_WHOLESALE)->sum('total_amount'),
            'average_transaction' => $transactions->count() > 0 ? $transactions->average('total_amount') : 0
        ];
    }

    public static function getChartData($outletId, $days = 30)
    {
        $startDate = now()->subDays($days);
        
        $dailySales = self::where('outlet_id', $outletId)
            ->where('created_at', '>=', $startDate)
            ->select(DB::raw('DATE(created_at) as date'), 
                    DB::raw('SUM(total_amount) as total_sales'),
                    DB::raw('COUNT(*) as transaction_count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'labels' => $dailySales->pluck('date')->map(function($date) {
                return \Carbon\Carbon::parse($date)->format('d M');
            })->toArray(),
            'sales' => $dailySales->pluck('total_sales')->toArray(),
            'counts' => $dailySales->pluck('transaction_count')->toArray(),
        ];
    }

    public static function getMonthlyStatistics($outletId)
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        // Get all transactions for current month
        $transactions = self::with(['user', 'items.product'])
            ->where('outlet_id', $outletId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Get highest sale day
        $highestSale = $transactions->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        })->map(function($group) {
            return [
                'date' => $group->first()->created_at->format('d M Y'),
                'total' => $group->sum('total_amount')
            ];
        })->sortByDesc('total')->first();

        // Get operator with most transactions
        $topOperator = $transactions->groupBy('user_id')
            ->map(function($group) {
                return [
                    'operator' => $group->first()->user->username,
                    'count' => $group->count(),
                    'total' => $group->sum('total_amount')
                ];
            })->sortByDesc('count')->first();

        // Get best selling product
        $bestProduct = ModelTransactionItem::whereIn('transaction_id', $transactions->pluck('transaction_id'))
            ->with('product')
            ->select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->first();

        // Get busiest hour
        $busiestHour = $transactions->groupBy(function($item) {
            return $item->created_at->format('H');
        })->map(function($group) {
            return [
                'hour' => $group->first()->created_at->format('H:00'),
                'count' => $group->count()
            ];
        })->sortByDesc('count')->first();

        // Calculate daily average
        $totalDays = now()->diffInDays($startDate) + 1;
        $dailyAverage = $transactions->sum('total_amount') / $totalDays;

        // Add new statistics calculations
        
        // Payment Methods Distribution
        $paymentMethods = $transactions->groupBy('payment_method')
            ->map(function($group) use($transactions) {
                return [
                    'count' => $group->count(),
                    'percentage' => ($group->count() / $transactions->count()) * 100,
                    'method' => $group->first()->payment_method // Add the method name here
                ];
            })->sortByDesc('count')->first() ?? null;

        // Customer Types Distribution
        $retailCount = $transactions->where('sale_type', self::SALE_RETAIL)->count();
        $wholesaleCount = $transactions->where('sale_type', self::SALE_WHOLESALE)->count();
        $totalCount = $transactions->count();

        // Peak Days Analysis
        $peakDays = $transactions->groupBy(function($item) {
            return $item->created_at->format('l'); // Group by day name
        })->map(function($group) {
            return [
                'count' => $group->count(),
                'avg' => $group->count() / 4 // Assuming 4 weeks per month
            ];
        })->sortByDesc('avg')->first();

        // Growth Rate (compare with previous month)
        $lastMonth = now()->subMonth();
        $lastMonthTransactions = self::where('outlet_id', $outletId)
            ->whereBetween('created_at', [
                $lastMonth->startOfMonth(),
                $lastMonth->endOfMonth()
            ])->sum('total_amount');

        $currentMonthTotal = $transactions->sum('total_amount');
        $growthRate = $lastMonthTransactions > 0 
            ? (($currentMonthTotal - $lastMonthTransactions) / $lastMonthTransactions) * 100 
            : null;

        return [
            'highest_sale' => $highestSale,
            'top_operator' => $topOperator,
            'best_product' => $bestProduct ? [
                'name' => $bestProduct->product->product_name,
                'quantity' => $bestProduct->total_qty
            ] : null,
            'busiest_hour' => $busiestHour,
            'daily_average' => $dailyAverage,
            'period' => [
                'start' => $startDate->format('d M Y'),
                'end' => $endDate->format('d M Y')
            ],
            'payment_methods' => $paymentMethods ? [
                'method' => ucfirst($paymentMethods['method']), // Use the method from the array
                'percentage' => $paymentMethods['percentage']
            ] : null,
            'customer_types' => [
                'retail_percentage' => $totalCount > 0 ? ($retailCount / $totalCount) * 100 : 0,
                'wholesale_percentage' => $totalCount > 0 ? ($wholesaleCount / $totalCount) * 100 : 0
            ],
            'peak_days' => $peakDays ? [
                'day' => array_key_first((array)$peakDays), // Cast to array and use array_key_first
                'avg_transactions' => is_array($peakDays) ? $peakDays['avg'] : $peakDays->avg
            ] : null,
            'growth_rate' => $growthRate
        ];
    }

    // Timestamps
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
