<?php

namespace App\Http\Controllers;

use App\Models\ModelCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ModelDiscount;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        Log::info('CategoriesController@data: Request received', ['session' => $request->session()->all()]);
        $outletId = $request->session()->get('outlet_id');

        $categories = ModelCategories::where('outlet_id', $outletId);

        return DataTables::of($categories)
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outletId = session('outlet_id');
        $userId = session('user_id');
        $outletName = \App\Models\ModelOutlet::where('outlet_id', $outletId)->value('outlet_name');
        $username = \App\Models\ModelUser::where('user_id', $userId)->value('username');

        // Ambil data kategori
        $categories = ModelCategories::where('outlet_id', $outletId)->get();

        return view('admin.categories.add', compact('outletName', 'username', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('CategoriesController@store: Request received', ['data' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'category_name' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query->where('outlet_id', $request->outlet_id);
                }),
            ],
        ], [
            // Custom error messages
            'category_name.required' => 'Nama kategori wajib diisi.',
            'category_name.string' => 'Nama kategori harus berupa teks.',
            'category_name.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
            'category_name.unique' => 'Nama kategori sudah ada untuk outlet ini.',
        ]);

        if ($validator->fails()) {
            Log::error('CategoriesController@store: Validation failed', ['errors' => $validator->errors()->toArray()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = ModelCategories::create($request->all());
        Log::info('CategoriesController@store: Category created successfully', ['category' => $category->toArray()]);

        // Redirect ke index dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
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
            $category = ModelCategories::findOrFail($id);
            $outletId = session('outlet_id');
            $userId = session('user_id');
            $outletName = \App\Models\ModelOutlet::where('outlet_id', $category->outlet_id)->value('outlet_name');
            $username = \App\Models\ModelUser::where('user_id', $category->user_id)->value('username');

            Log::info('CategoriesController@edit: Category data fetched', ['category' => $category->toArray(), 'outletName' => $outletName, 'username' => $username]);
            return view('admin.categories.edit', compact('category', 'outletName', 'username'));
        } catch (ModelNotFoundException $e) {
            Log::error('CategoriesController@edit: Category not found', ['id' => $id]);
            return redirect()->route('categories.index')->with('error', 'Kategori tidak ditemukan!');
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
            $category = ModelCategories::findOrFail($id);

            // Cek apakah kategori digunakan di tabel discounts
            $discountCount = ModelDiscount::where('category_id', $id)->count();
            if ($discountCount > 0) {
                return redirect()->route('categories.index')
                    ->with('error', "Kategori {$category->category_name} tidak dapat dihapus karena masih digunakan pada data diskon!");
            }

            // Jika tidak digunakan, lakukan penghapusan
            $categoryName = $category->category_name;
            $category->delete();

            return redirect()->route('categories.index')
                ->with('success', "Kategori $categoryName berhasil dihapus!");
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak ditemukan!');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')
                ->with('error', 'Terjadi kesalahan saat menghapus kategori!');
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
            $category = ModelCategories::with('outlet', 'user')->findOrFail($id);
            return response()->json(['data' => $category], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found'], 404);
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
        Log::info('CategoriesController@update: Request received', ['id' => $id, 'data' => $request->all()]);
        $validator = Validator::make(
            $request->all(),
            [
                'category_name' => [
                    'required',
                    'string',
                    'max:255',
                    \Illuminate\Validation\Rule::unique('categories')->where(function ($query) use ($request, $id) {
                        return $query->where('outlet_id', $request->outlet_id)
                            ->where('category_id', '!=', $id);
                    }),
                ],

            ],
            [
                'category_name.required' => 'Nama kategori wajib diisi.',
                'category_name.string' => 'Nama kategori harus berupa teks.',
                'category_name.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
                'category_name.unique' => 'Nama kategori sudah ada untuk outlet ini.',

            ]
        );


        if ($validator->fails()) {
            Log::error('CategoriesController@update: Validation failed', ['errors' => $validator->errors()->toArray()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $category = ModelCategories::findOrFail($id);
            $category->update($request->all());
            Log::info('CategoriesController@update: Category updated successfully', ['category' => $category->toArray()]);
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil diubah!');
        } catch (ModelNotFoundException $e) {
            Log::error('CategoriesController@update: Category not found', ['id' => $id]);
            return redirect()->route('categories.index')->with('error', 'Kategori tidak ditemukan!');
        }
    }
}
