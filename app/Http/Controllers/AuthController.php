<?php

namespace App\Http\Controllers;

use App\Models\ModelUser;
use App\Models\Membership;
use App\Models\ModelRoles;
use App\Models\ModelOutlet;
use Illuminate\Http\Request;
use App\Models\ModelMembership;
use App\Models\ModelRekeningOwner;
use Illuminate\Support\Facades\DB;
use App\Models\ModelUserPermission;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelOutletGroup; // Tambahkan ModelOutletGroup
use Illuminate\Support\Facades\Validator; // Import class Validator

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }
    public function login(Request $request)
    {
        // Redirect ke /dashboard jika user sudah login
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        // Periksa jika ada parameter 'redirect_to' dan simpan ke session
        if ($request->has('redirect_to')) {
            session(['intended_url' => $request->get('redirect_to')]);
        }

        return view('auth/login');
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        // Ambil data memberships dengan is_active = 1
        $memberships = ModelMembership::where('is_active', 1)->get();
        // dd($memberships);

        return view('auth.register', compact('memberships'));
    }


    public function showLoginForm(Request $request)
    {
        // Periksa jika user belum login dan ada 'redirect_to'
        if (!Auth::check() && $request->has('redirect_to')) {
            session(['intended_url' => $request->get('redirect_to')]);
        }

        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        // Validasi input
        // $request->validate([
        //     'username' => 'required|string',
        //     'password' => 'required|string',
        // ]);

        // Mencoba autentikasi user
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Regenerasi session
            $request->session()->regenerate();

            // Ambil data user yang sedang login
            $user = Auth::user();

            // Tangkap data outlet yang terhubung
            $outlet = \App\Models\ModelOutlet::find($user->outlet_id);

            // Tangkap data membership
            $membership = null;
            if ($outlet && $outlet->membership_id) {
                $membership = \App\Models\ModelMembership::find($outlet->membership_id);
            }

            // Tangkap data permissions menggunakan ModelUserPermission
            $permissions = ModelUserPermission::where('role_id', $user->role_id)
                ->where('outlet_id', $user->outlet_id)
                ->first();

            // Simpan data permissions ke dalam format array
            $permissionsArray = $permissions ? $permissions->only([
                'can_add_supplier',
                'can_edit_supplier',
                'can_delete_supplier',
                'can_edit_category',
                'can_delete_category',
                'can_add_category',
                'can_edit_product',
                'can_delete_product',
                'can_add_product',
                'can_add_user',
                'can_edit_user',
                'can_delete_user',
                'can_add_product_location',
                'can_edit_product_location',
                'can_delete_product_location',
                'can_see_cost_price',
                'can_see_sale_price',
                'can_see_supplier',
                'can_see_category',
                'can_see_operator',
                'can_see_outlet',
                'can_see_stock',
                'can_see_brand',
                'can_see_product_location',
                'can_see_barcode',
                'can_see_unit_barcode',
                'can_see_product_id',
            ]) : [];

            // Simpan data ke session
            session([
                '__ci_last_regenerate' => time(),
                '_ci_previous_url' => url()->previous(),
                'user_id' => $user->user_id,
                'outlet_id' => $user->outlet_id,
                'username' => $user->username,
                'role' => $user->role,
                'is_owner' => $user->is_owner,
                'owner_dashboard_access' => $user->is_owner ? 1 : 0,
                'logged_in' => 1,
                'isLoggedIn' => true,
                'is_parent' => $user->is_parent,
                'outlet_name' => $outlet->outlet_name ?? null,
                'outlet_status' => $outlet->status ?? null,
                'group_id' => $outlet->outlet_group_id ?? null,
                'parent_outlet_id' => $outlet->parent_outlet_id ?? null,
                'membership_id' => $membership->membership_id ?? null,
                'membership_name' => $membership->membership_name ?? null,
                'jenis_outlet' => $outlet->jenis_outlet ?? null,
                'admin_id' => $outlet->admin_user_id ?? null,
                'branch_limit' => $membership->branch_limit ?? null,
                'daily_transaction_limit' => $membership->daily_transaction_limit ?? null,
                'daily_product_addition_limit' => $membership->daily_product_addition_limit ?? null,
                'user_limit' => $membership->user_limit ?? null,
                'permissions' => $permissionsArray,
            ]);

            // Ambil URL yang disimpan
            $intendedUrl = session('intended_url');

            // Hapus URL yang disimpan
            session()->forget('intended_url');

            // Redirect berdasarkan is_owner
            if ($user->is_owner == 1) {
                return redirect('/owner/dashboard');
            }

            // Redirect sesuai dengan URL yang disimpan atau ke dashboard jika tidak ada
            if ($intendedUrl) {
                return redirect($intendedUrl);
            }

            // Redirect ke halaman dashboard untuk non-owner
            return redirect('/dashboard');
        }

        // Jika login gagal
        return back()->with('error', 'Username or password invalid!');
    }

    public function doRegister(Request $request)
    {
        Log::debug('doRegister: Mulai proses registrasi', ['request' => $request->all()]);

        // Validasi Input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|confirmed|min:3',
            'outlet_name' => 'required|string|max:255',
            'outlet_address' => 'required|string|max:255',
            'outlet_phone' => 'required|string|max:20',
            'membership_id' => 'required|integer',
        ]);
        Log::debug('doRegister: Validasi input', ['validator' => $validator->errors()]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah username sudah ada
        $usernameExists = ModelUser::where('username', $request->username)->exists();
        Log::debug('doRegister: Cek username', ['username' => $request->username, 'exists' => $usernameExists]);


        // Cek apakah email sudah ada
        $emailExists = ModelUser::where('email', $request->email)->exists();
        Log::debug('doRegister: Cek email', ['email' => $request->email, 'exists' => $emailExists]);

        if ($usernameExists) {
            return redirect()->back()->withErrors(['username' => 'Username sudah digunakan.'])->withInput();
        }

        if ($emailExists) {
            return redirect()->back()->withErrors(['email' => 'Email sudah digunakan.'])->withInput();
        }

        DB::beginTransaction(); // Mulai Transaksi
        Log::debug('doRegister: Mulai transaksi database');
        try {
            // Enkripsi Password
            $password = Hash::make($request->password);
            Log::debug('doRegister: Password dienkripsi');

            $superAdminRole = ModelRoles::where('role_name', 'superadmin')->first();
            Log::debug('doRegister: role superadmin', ['role' => $superAdminRole]);

            if (!$superAdminRole) {
                Log::error('doRegister: Role superadmin tidak ditemukan di tabel roles');
                throw new \Exception('Role superadmin tidak ditemukan di tabel roles. Pastikan data superadmin sudah dibuat di table roles.');
            }
            // Buat User Baru
            $user = ModelUser::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $password,
                'phone_number' => $request->outlet_phone,
                'role_id' => $superAdminRole->role_id,
                'is_parent' => '1',
                'is_verified' => '0',
                'status' => 'active',
                'is_deletable' => '0'
            ]);
            Log::debug('doRegister: User baru dibuat', ['user' => $user, 'assigned_role_id' => $superAdminRole->role_id]);
            $today = date('Y-m-d');
            Log::debug('doRegister: Tanggal hari ini', ['today' => $today]);
            $nextMonth = date('Y-m-d', strtotime('+1 month', strtotime($today)));
            Log::debug('doRegister: Tanggal jatuh tempo bulan depan', ['nextMonth' => $nextMonth]);


            // Buat Outlet Group Baru
            $outletGroup = ModelOutletGroup::create([
                'outlet_group_name' => $request->outlet_name,
                'description' => 'Group for ' . $request->outlet_name,
                'user_id' => $user->user_id,
            ]);
            Log::debug('doRegister: Outlet group baru dibuat', ['outlet_group' => $outletGroup]);

            // Ambil data membership
            $membership = ModelMembership::find($request->membership_id);
            Log::debug('doRegister: Data membership', ['membership' => $membership]);


            // Buat Outlet Baru dengan admin_user_id dan outlet_group_id yang diambil dari user dan group yang baru saja dibuat
            $outlet = ModelOutlet::create([
                'outlet_name' => $request->outlet_name,
                'email' => $request->email,
                'address' => $request->outlet_address,
                'status' => 'induk',
                'parent_outlet_id' => null,
                'registration_status' => 'baru',
                'jenis_outlet' => 'Konter Handphone',
                'contact_info' => $request->outlet_phone,
                'admin_user_id' => $user->user_id,
                'membership_id' => $request->membership_id,
                'outlet_group_id' => $outletGroup->outlet_group_id,
                'registration_fee' => $membership ? $membership->biaya_pendaftaran : 0,
                'monthly_fee' => $membership ? $membership->biaya_bulanan : 0,
                'registration_date' => $today, // set registration_date
                'next_due_date' => $nextMonth, // set next_due_date
            ]);
            Log::debug('doRegister: Outlet baru dibuat', ['outlet' => $outlet]);


            // Update user dengan outlet_id
            $user->outlet_id = $outlet->outlet_id;
            $user->save();
            Log::debug('doRegister: User diupdate dengan outlet id', ['user' => $user]);

            // Ambil data rekening owner
            $rekeningOwner = ModelRekeningOwner::where('is_active', 1)->where('is_default', 1)->first();
            Log::debug('doRegister: Data rekening owner', ['rekeningOwner' => $rekeningOwner]);


            // Kirim email konfirmasi transfer ke user
            if ($rekeningOwner && $membership) {
                try {
                    Log::info('Mengirim email konfirmasi transfer ke user', [
                        'email' => $request->email,
                        'subject' => 'Konfirmasi Transfer Biaya Pendaftaran',
                        'payload' => [
                            'account_number' => $rekeningOwner->account_number,
                            'account_name' => $rekeningOwner->account_name,
                            'bank_name' => $rekeningOwner->bank_name,
                            'biaya_pendaftaran' => $membership->biaya_pendaftaran,
                            'membership_name' => $membership->membership_name,
                        ]
                    ]);

                    Mail::send('admin.emails.konfirmasi-transfer', [
                        'account_number' => $rekeningOwner->account_number,
                        'account_name' => $rekeningOwner->account_name,
                        'bank_name' => $rekeningOwner->bank_name,
                        'biaya_pendaftaran' => $membership->biaya_pendaftaran,
                        'membership_name' => $membership->membership_name,
                        'link_konfirmasi' => 'http://localhost:8000/confirm-payment/' . $user->user_id,
                    ], function ($message) use ($request) {
                        $message->to($request->email);
                        $message->subject('Konfirmasi Transfer Biaya Pendaftaran');
                    });

                    Log::info('Email konfirmasi transfer ke user berhasil terkirim');
                } catch (\Exception $e) {
                    Log::error('Email konfirmasi transfer ke user gagal terkirim: ' . $e->getMessage());
                }
            }

            // Kirim email pemberitahuan ke owner
            if ($rekeningOwner) {
                try {
                    Log::info('Mengirim email pemberitahuan ke owner', [
                        'email' => $rekeningOwner->email,
                        'subject' => 'Pemberitahuan Pendaftaran Pelanggan Baru',
                        'payload' => [
                            'username' => $request->username,
                            'email' => $request->email,
                        ]
                    ]);

                    Mail::send('admin.emails.pemberitahuan-pendaftaran', [
                        'username' => $request->username,
                        'email' => $request->email,
                    ], function ($message) use ($rekeningOwner) {
                        $message->to($rekeningOwner->email);
                        $message->subject('Pemberitahuan Pendaftaran Pelanggan Baru');
                    });

                    Log::info('Email pemberitahuan ke owner berhasil terkirim');
                } catch (\Exception $e) {
                    Log::error('Email pemberitahuan ke owner gagal terkirim: ' . $e->getMessage());
                }
            }
            Log::debug('doRegister: Commit transaksi database');
            DB::commit(); // Commit Transaksi jika semua berhasil

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback Transaksi jika ada yang gagal
            // Log the exception
            Log::error('Transaction failed: ' . $e->getMessage());
            // Return back with error message
            Log::debug('doRegister: Transaksi database rollback', [
                'message' => 'Pendaftaran gagal, silakan coba lagi. Periksa koneksi database, input form anda atau hubungi customer service kami.',
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->withErrors(['error' => 'Pendaftaran gagal, silakan coba lagi. Periksa koneksi database, input form anda atau hubungi customer service kami.'])->withInput();
        }

        // Redirect ke Login Page
        Log::debug('doRegister: Redirect ke login');

        return redirect('/login')->with('success', 'Registration successful, Please Login');
    }



    public function logout(Request $request)
    {
        // Hapus semua data session pengguna
        Auth::logout();

        // Regenerasi session untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
    public function clearTables()
    {
        try {
            // Delete from tables which have foreign key to outlets
            DB::table('user_permissions')->whereIn('outlet_id', function ($query) {
                $query->select('outlet_id')->from('outlets');
            })->delete();

            DB::table('products')->whereIn('outlet_id', function ($query) {
                $query->select('outlet_id')->from('outlets');
            })->delete();

            DB::table('product_serials')->whereIn('outlet_id', function ($query) {
                $query->select('outlet_id')->from('outlets');
            })->delete();

            DB::table('categories')->whereIn('outlet_id', function ($query) {
                $query->select('outlet_id')->from('outlets');
            })->delete();

            DB::table('suppliers')->whereIn('outlet_id', function ($query) {
                $query->select('outlet_id')->from('outlets');
            })->delete();

            // Delete from tables which have foreign key to users.
            DB::table('user_permissions')->whereIn('operator_id', function ($query) {
                $query->select('user_id')->from('users');
            })->delete();
            DB::table('products')->whereIn('user_id', function ($query) {
                $query->select('user_id')->from('users');
            })->delete();
            DB::table('product_serials')->whereIn('user_id', function ($query) {
                $query->select('user_id')->from('users');
            })->delete();

            DB::table('categories')->whereIn('user_id', function ($query) {
                $query->select('user_id')->from('users');
            })->delete();
            DB::table('suppliers')->whereIn('user_id', function ($query) {
                $query->select('user_id')->from('users');
            })->delete();


            DB::table('users')->whereIn('outlet_id', function ($query) {
                $query->select('outlet_id')->from('outlets');
            })->delete();

            // Delete from parent tables.
            ModelOutlet::query()->delete();
            ModelOutletGroup::query()->delete();
            ModelUser::query()->delete();



            return response()->json([
                'message' => 'Tables cleared successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to clear tables.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
