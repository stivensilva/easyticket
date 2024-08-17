<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sorteo;

use Validator;

class SorteoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sorteo::all();
        return view('sorteos.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sorteos.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'valor'     => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'fecha_sorteo' => 'required|date',
            'premio' => 'required',
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }

        Sorteo::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'valor_boleta' => $request->input('valor'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin'),
            'fecha_sorteo' => $request->input('fecha_sorteo'),
            'premio' => $request->input('premio'),
        ]);
        
        return redirect('sorteos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sorteo = Sorteo::findOrFail($id);
        return response()->json(['sorteo' => $sorteo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Sorteo::find($id);
        return view('sorteos.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'valor'     => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'fecha_sorteo' => 'required|date',
            'premio' => 'required',
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }

        Sorteo::find($id)->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'valor_boleta' => $request->input('valor'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin'),
            'fecha_sorteo' => $request->input('fecha_sorteo'),
            'premio' => $request->input('premio'),
        ]);
        
        return redirect('/sorteos')->with('success', 'Sorteo editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sorteo = Sorteo::findOrFail($id);

        if ($sorteo->status == 1) {
            $sorteo->update(['status' => 0]);
            $message = 'Sorteo inactivado exitosamente';
        } else {
            $sorteo->update(['status' => 1]);
            $message = 'Sorteo activado exitosamente';
        }

        return redirect('/sorteos')->with('success', $message);
    }


}
