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
        try {
            // Tambahkan debug untuk melihat nilai yang dicari
            \Log::info("Searching for customer with ID: " . $id);
            \Log::info("Current outlet_id: " . session('outlet_id'));
            
            $customer = ModelWholesaleCustomer::with(['outlet', 'operator'])
                ->where('wholesale_customer_id', $id)  // Ganti primary key yang benar
                ->first();
                
            if (!$customer) {
                throw new \Exception("Customer not found");
            }

            \Log::info("Customer found: " . json_encode($customer));
            
            return view('admin.wholesale_customer.edit', compact('customer'));
        } catch (\Exception $e) {
            \Log::error("Error in edit method: " . $e->getMessage());
            return redirect()->route('wholesale-customer.index')
                ->with('error', 'Pelanggan tidak ditemukan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'customer_name' => 'required|string|max:255',
                'email' => 'required|email|max:100|unique:wholesale_customers,email,' . $id . ',wholesale_customer_id',
                'contact_info' => 'required|string|max:15',
                'address' => 'required|string',
                'customer_outlet_id' => 'required|exists:outlets,outlet_id',
                'operator_id' => 'required|exists:users,user_id',
            ]);

            $customer = ModelWholesaleCustomer::where('customer_outlet_id', session('outlet_id'))
                ->findOrFail($id);
            $customer->update($validatedData);

            return redirect()->route('wholesale-customer.index')
                ->with('success', 'Data Pelanggan Grosir Berhasil Diubah!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $customer = ModelWholesaleCustomer::findOrFail($id);
        $customerName = $customer->customer_name;
        $customer->delete();
        return redirect('/wholesale-customer')->with('success', "Pelanggan  $customerName berhasil dihapus");
    }
}
