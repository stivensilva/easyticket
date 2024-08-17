<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

use Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cliente::all();
        return view('clientes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required|numeric',
            'direccion' => 'required'
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }

        Cliente::create([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'customer_key' => $request->input('customer_key')

        ]);
        
        return redirect('clientes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Cliente = Cliente::findOrFail($id);
        return response()->json(['Cliente' => $Cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Cliente::find($id);
        return view('clientes.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required|numeric',
            'direccion' => 'required'
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }

        Cliente::find($id)->update([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion')
        ]);
        
        return redirect('/clientes')->with('success', 'Cliente editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Cliente = Cliente::findOrFail($id);

        if ($Cliente->status == 1) {
            $Cliente->update(['status' => 0]);
            $message = 'Cliente inactivado exitosamente';
        } else {
            $Cliente->update(['status' => 1]);
            $message = 'Cliente activado exitosamente';
        }

        return redirect('/clientes')->with('success', $message);
    }


}
