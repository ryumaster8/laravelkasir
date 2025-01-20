<?php

namespace App\Http\Controllers;

use App\Models\ModelSuppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $outletId = session('outlet_id');
            $userId = session('user_id');

            // Ambil data outlet dan user
            $outletName = \App\Models\ModelOutlet::where('outlet_id', $outletId)->value('outlet_name');
            $username = \App\Models\ModelUser::where('user_id', $userId)->value('username');

            return view('admin.suppliers.add', compact('outletName', 'username'));
        } catch (\Exception $e) {
            \Log::error('Error in SuppliersController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }

        // Add this method after index()
    /**
     * Display a listing of suppliers.
     *
     * @return \Illuminate\Http\Response
     */
        /**
     * Display a listing of suppliers.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            $outletId = session('outlet_id');
            $userId = session('user_id');
    
            // Get outlet and user data
            $outletName = \App\Models\ModelOutlet::where('outlet_id', $outletId)->value('outlet_name');
            $username = \App\Models\ModelUser::where('user_id', $userId)->value('username');
    
            // Fetch suppliers for current outlet
            $suppliers = ModelSuppliers::where('outlet_id', $outletId)
                ->orderBy('created_at', 'desc')
                ->get();
    
            return view('admin.suppliers.list', compact('outletName', 'username', 'suppliers'));
        } catch (\Exception $e) {
            \Log::error('Error in SuppliersController@list: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        try {
            $outletId = session('outlet_id');

            // Query supplier berdasarkan outlet_id
            $suppliers = ModelSuppliers::select([
                'supplier_id',
                'outlet_id',
                'user_id',
                'supplier_name',
                'contact_info',
                'address',
                'created_at',
                'updated_at'
            ])
                ->where('outlet_id', $outletId);

            return DataTables::of($suppliers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="flex space-x-2">
                        <a href="' . route('suppliers.edit', $row->supplier_id) . '" 
                           class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button onclick="deleteSupplier(' . $row->supplier_id . ')" 
                                class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d/m/Y H:i:s') : '';
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at ? $row->updated_at->format('d/m/Y H:i:s') : '';
                })
                ->rawColumns(['action'])
                ->toJson();
        } catch (\Exception $e) {
            \Log::error('Error in suppliers.data: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $outletId = session('outlet_id');
        $userId = session('user_id');
        $outletName = \App\Models\ModelOutlet::where('outlet_id', $outletId)->value('outlet_name');
        $username = \App\Models\ModelUser::where('user_id', $userId)->value('username');

        Log::info('SuppliersController@create: Session data set', ['outletName' => $outletName, 'username' => $username]);
        return view('admin.suppliers.add', compact('outletName', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('SuppliersController@store: Request received', ['data' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'supplier_name' => 'required|string|max:255',
            'outlet_id' => 'required|integer',
            'user_id' => 'required|integer',
            'contact_info' => 'nullable|string',
            'address' => 'nullable|string',
            'supplier_name' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('suppliers')->where(function ($query) use ($request) {
                    return $query->where('outlet_id', $request->outlet_id);
                }),
            ],
        ], [
            'supplier_name.required' => 'Nama supplier wajib diisi.',
            'supplier_name.string' => 'Nama supplier harus berupa teks.',
            'supplier_name.max' => 'Nama supplier tidak boleh lebih dari 255 karakter.',
            'supplier_name.unique' => 'Nama supplier sudah ada untuk outlet ini.',
            'outlet_id.required' => 'Outlet wajib dipilih.',
            'outlet_id.integer' => 'Outlet harus berupa angka.',
            'user_id.required' => 'ID pengguna wajib diisi.',
            'user_id.integer' => 'ID pengguna harus berupa angka.',
        ]);

        if ($validator->fails()) {
            Log::error('SuppliersController@store: Validation failed', ['errors' => $validator->errors()->toArray()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $supplier = ModelSuppliers::create($request->all());
        Log::info('SuppliersController@store: Supplier created successfully', ['supplier' => $supplier->toArray()]);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('suppliers.index')->with('success', 'Supplier ' . $supplier->supplier_name . ' berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $supplier = ModelSuppliers::findOrFail($id);
            $outletId = session('outlet_id');
            $userId = session('user_id');
            $outletName = \App\Models\ModelOutlet::where('outlet_id', $supplier->outlet_id)->value('outlet_name');
            $username = \App\Models\ModelUser::where('user_id', $supplier->user_id)->value('username');
            Log::info('SuppliersController@edit: Supplier data fetched', ['supplier' => $supplier->toArray(), 'outletName' => $outletName, 'username' => $username]);
            return view('admin.suppliers.edit', compact('supplier', 'outletName', 'username'));
        } catch (ModelNotFoundException $e) {
            Log::error('SuppliersController@edit: Supplier not found', ['id' => $id]);
            return redirect()->route('suppliers.index')->with('error', 'Supplier tidak ditemukan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $supplier = ModelSuppliers::findOrFail($id);

            // Simpan data supplier untuk pesan
            $supplierData = [
                'nama' => $supplier->supplier_name,
                'kontak' => $supplier->contact_info,
                'alamat' => $supplier->address
            ];

            // Cek apakah supplier memiliki produk
            $hasProducts = \App\Models\ModelProduct::where('supplier_id', $id)->exists();

            if ($hasProducts) {
                return redirect()->route('suppliers.index')
                    ->with('error', "Gagal menghapus supplier!\n\n" .
                        "Supplier {$supplierData['nama']} tidak dapat dihapus karena masih memiliki produk yang terkait.\n\n" .
                        "Detail Supplier:\n" .
                        "Nama: {$supplierData['nama']}\n" .
                        "Kontak: {$supplierData['kontak']}\n" .
                        "Alamat: {$supplierData['alamat']}\n\n" .
                        "Untuk menghapus supplier ini:\n" .
                        "1. Hapus atau pindahkan semua produk yang terkait dengan supplier ini\n" .
                        "2. Hapus atau pindahkan semua diskon yang terkait dengan produk supplier ini\n" .
                        "3. Coba hapus supplier kembali setelah langkah di atas selesai");
            }

            if ($supplier->outlet_id != session('outlet_id')) {
                return redirect()->route('suppliers.index')
                    ->with('error', "Akses Ditolak!\n\n" .
                        "Anda tidak memiliki akses untuk menghapus supplier ini.\n\n" .
                        "Detail Supplier:\n" .
                        "Nama: {$supplierData['nama']}\n" .
                        "Kontak: {$supplierData['kontak']}\n" .
                        "Alamat: {$supplierData['alamat']}");
            }

            $supplier->delete();

            return redirect()->route('suppliers.index')
                ->with('success', "Supplier berhasil dihapus!\n\n" .
                    "Detail Supplier yang dihapus:\n" .
                    "Nama: {$supplierData['nama']}\n" .
                    "Kontak: {$supplierData['kontak']}\n" .
                    "Alamat: {$supplierData['alamat']}");
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap foreign key constraint error
            if ($e->getCode() == "23000") {
                return redirect()->route('suppliers.index')
                    ->with('error', "Gagal menghapus supplier!\n\n" .
                        "Supplier ini tidak dapat dihapus karena masih digunakan oleh data lain.\n\n" .
                        "Detail Supplier:\n" .
                        "Nama: {$supplierData['nama']}\n" .
                        "Kontak: {$supplierData['kontak']}\n" .
                        "Alamat: {$supplierData['alamat']}\n\n" .
                        "Langkah yang harus dilakukan:\n" .
                        "1. Hapus atau pindahkan semua produk dari supplier ini\n" .
                        "2. Hapus atau pindahkan semua diskon terkait\n" .
                        "3. Coba hapus supplier kembali");
            }

            \Log::error('Error deleting supplier: ' . $e->getMessage());
            return redirect()->route('suppliers.index')
                ->with('error', "Gagal menghapus supplier!\n\n" .
                    "Terjadi kesalahan sistem. Silakan coba lagi atau hubungi administrator.\n\n" .
                    "Detail Error: " . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('Error deleting supplier: ' . $e->getMessage());
            return redirect()->route('suppliers.index')
                ->with('error', "Gagal menghapus supplier!\n\n" .
                    "Terjadi kesalahan sistem. Silakan coba lagi atau hubungi administrator.\n\n" .
                    "Detail Error: " . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $supplier = ModelSuppliers::with('outlet', 'user')->findOrFail($id);
            return response()->json(['data' => $supplier], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $supplier = ModelSuppliers::findOrFail($id);

            // Simpan data lama untuk ditampilkan di flash message
            $oldData = [
                'nama' => $supplier->supplier_name,
                'kontak' => $supplier->contact_info,
                'alamat' => $supplier->address
            ];

            if ($supplier->outlet_id != session('outlet_id')) {
                return redirect()->route('suppliers.index')
                    ->with('error', "Akses Ditolak!\nAnda tidak memiliki akses untuk mengubah supplier ini.\n\nDetail Supplier:\nNama: {$oldData['nama']}\nKontak: {$oldData['kontak']}\nAlamat: {$oldData['alamat']}");
            }

            $validated = $request->validate([
                'supplier_name' => 'required|string|max:255',
                'contact_info' => 'required|string|max:255',
                'address' => 'required|string'
            ]);

            $supplier->update($validated);

            // Data baru setelah diupdate
            $newData = [
                'nama' => $supplier->supplier_name,
                'kontak' => $supplier->contact_info,
                'alamat' => $supplier->address
            ];

            return redirect()->route('suppliers.index')
                ->with('success', "Supplier berhasil diperbarui!\n\nDetail Perubahan:\nData Lama:\nNama: {$oldData['nama']}\nKontak: {$oldData['kontak']}\nAlamat: {$oldData['alamat']}\n\nData Baru:\nNama: {$newData['nama']}\nKontak: {$newData['kontak']}\nAlamat: {$newData['alamat']}");
        } catch (ModelNotFoundException $e) {
            return redirect()->route('suppliers.index')
                ->with('error', "Supplier tidak ditemukan!\n\nDetail Error: Data supplier yang akan diubah tidak ditemukan dalam database.");
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', "Validasi gagal!\n\nSilakan periksa kembali data yang diinputkan.");
        } catch (\Exception $e) {
            \Log::error('Error updating supplier: ' . $e->getMessage());
            return redirect()->route('suppliers.index')
                ->with('error', "Gagal memperbarui supplier!\n\nTerjadi kesalahan sistem. Silakan coba lagi atau hubungi administrator.\nDetail Error: " . $e->getMessage());
        }
    }

    /**
     * Tambahkan method untuk debugging
     */
    public function debug()
    {
        $outletId = session('outlet_id');
        $suppliers = ModelSuppliers::where('outlet_id', $outletId)->get();

        dd([
            'outlet_id' => $outletId,
            'suppliers_count' => $suppliers->count(),
            'suppliers' => $suppliers->toArray()
        ]);
    }
}
