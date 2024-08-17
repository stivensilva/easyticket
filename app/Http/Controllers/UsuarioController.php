<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

use Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Usuario::all();
        return view('Usuarios.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Usuarios.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'nombre' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg',
            'email' => 'required',
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'password' => 'required',
            'rol' => 'required'
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }
        $foto = $request->file('foto');
        $fotoName = time().'.'.$foto->getClientOriginalExtension();
        $foto->move(public_path('images/users'), $fotoName);

        Usuario::create([
            'nombre' => $request->input('nombre'),
            'foto' => $fotoName,
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'password' => $request->input('password'),
            'rol' => $request->input('rol')

        ]);
        
        return redirect('usuarios');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Usuario = Usuario::findOrFail($id);
        return response()->json(['Usuario' => $Usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Usuario::find($id);
        return view('Usuarios.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       

      $request->validate([
    'nombre' => 'required',
    'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg',
    'email' => 'required|email',
    'telefono' => 'required|numeric',
    'direccion' => 'required',
    'rol' => 'required'
        ]);

        $catering = Usuario::findOrFail($id);

        $catering->nombre = $request->input('nombre');
        $catering->email = $request->input('email');
        $catering->telefono = $request->input('telefono');
        $catering->direccion = $request->input('direccion');
        $catering->rol = $request->input('rol');

        if ($request->hasFile('foto')) {
            // Si existe una imagen anterior, la eliminamos
            if ($catering->foto) {
                $filePath = public_path('images/users/' . $catering->foto);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Guardamos la nueva imagen
            $image = $request->file('foto');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/users'), $imageName);
            $catering->foto = $imageName;
        }

        // Guardar los cambios en el usuario
        $catering->save();


        
        return redirect('/usuarios')->with('success', 'Usuario editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Usuario = Usuario::findOrFail($id);

        if ($Usuario->status == 1) {
            $Usuario->update(['status' => 0]);
            $message = 'Usuario inactivado exitosamente';
        } else {
            $Usuario->update(['status' => 1]);
            $message = 'Usuario activado exitosamente';
        }

        return redirect('/Usuarios')->with('success', $message);
    }


}
