<?php

namespace App\Http\Controllers;

use App\Models\ModelWholesaleCustomer;
use Illuminate\Http\Request;

class WholesaleCustomersController extends Controller
{
    public function index()
    {
        // Filter data by outlet_id in the query
        $wholesaleCustomers = ModelWholesaleCustomer::with(['outlet', 'operator'])
            ->where('customer_outlet_id', session('outlet_id'))  // Changed from outlet_id to customer_outlet_id
            ->get();

        return view('admin.wholesale_customer.index', compact('wholesaleCustomers'), ['title' => 'Data Pelanggan Grosir']);
    }

    public function create()
    {
        return view('admin.wholesale_customer.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:wholesale_customers,email',
            'contact_info' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        try {
            ModelWholesaleCustomer::create([
                'customer_name' => $validatedData['customer_name'],
                'email' => $validatedData['email'],
                'contact_info' => $validatedData['contact_info'],
                'address' => $validatedData['address'],
                'customer_outlet_id' => session('outlet_id'),
                'operator_id' => session('user_id')
            ]);

            return redirect()->route('wholesale-customer.index')
                ->with('success', 'Data Pelanggan Grosir Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $customer = ModelWholesaleCustomer::with(['outlet', 'operator'])->findOrFail($id);
        return view('admin.wholesale_customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:100|unique:wholesale_customers,email,' . $id . ',wholesale_customer_id',
            'contact_info' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'customer_outlet_id' => 'nullable|exists:outlets,outlet_id',
            'operator_id' => 'nullable|exists:users,user_id',
        ]);


        $customer = ModelWholesaleCustomer::findOrFail($id);
        $customer->update($validatedData);

        return redirect('/wholesale-customer')->with('success', 'Data Pelanggan Grosir Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $customer = ModelWholesaleCustomer::findOrFail($id);
        $customerName = $customer->customer_name;
        $customer->delete();
        return redirect('/wholesale-customer')->with('success', "Pelanggan  $customerName berhasil dihapus");
    }
}
