<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Services::all();

        // return view('services', ['services' => $data]);
        return view('services', ['services' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'service_name'=> ['required'],
            'category'=> ['required'],
            'amount'=> ['required'],
        ]);

        Services::create($validated);
        return redirect('/services');
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
        //
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
        $validated = $request->validate([
            'service_name'=> ['required'],
            'category'=> ['required'],
            'amount'=> ['required'],
        ]);

        $services = Services::findOrFail($request->input('id'));
        $services->update($validated);

        $data = Services::all();

        return view('services', ['services' => $data]);
        
        

       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Services::findOrFail($id);
        $service->delete();

        $data = Services::all();

        return redirect('/services')->with('services', $data);
        
    }
}
