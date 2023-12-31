<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customers::all();

        return view('/customers', ['customers' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'customer_name'=> ['required'],
            'customer_type'=> ['required'],
            'contact_number'=> ['required'],
        ]);

        Customers::create($validated);
        return redirect('/customers')->with('data', Customers::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Customers::findOrFail($id);
        return view('/customers', ['customer' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
           $customers = Customers::findOrFail($request->input('id'));
           $validated = $request->validate([
               'customer_name'=> ['required'],
               'contact_number'=> ['required'],
               'customer_type'=> ['required'],
           ]);
   
           $customers->update($validated);
   
           return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Customers::findOrFail($id);
        $product->delete();

        $data = Customers::all();

        return redirect('/customers')->with('customers', $data);
    }
}
