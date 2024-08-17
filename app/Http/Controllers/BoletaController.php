<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boleta;
use App\Models\Sorteo;
use App\Models\Cliente;
use App\Models\Vendedor;

use Validator;

class BoletaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Boleta::all();
        return view('boletas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sorteos = Sorteo::all();
        return view('boletas.new', compact('sorteos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'sorteo' => 'required|exists:sorteos,id',
            'desde' => 'required|numeric',
            'hasta' => 'required|numeric',
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }

        $sorteo = $data['sorteo'];

        for ($i=$data['desde']; $i < $data['hasta']; $i++) { 
            $numero = str_pad($i, 4, '0', STR_PAD_LEFT);
            Boleta::create([
                'numero' => $numero,
                'sorteo_id' => $sorteo,
            ]);
        }
        
        return redirect('boletas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json(['product' => $product]);
    }

    public function bestseller(string $id)
    {
        $data = Product::findOrFail($id);
        $data->bestseller = !$data->bestseller;
        $data->save();

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Product::find($id);
        $categories = Category::where('status', 1)->get();
        return view('products.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
        ]);

        $product = product::findOrFail($id);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->status = $request->input('status');
        $product->bestseller = $request->input('bestseller');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {

            if ($product->image) {
                $filePath = public_path('images/products/' . $product->image);
                if (file_exists($filePath))
                    unlink($filePath);
            }
            
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect('/products')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->status == 1) {
            $product->update(['status' => 0]);
            $message = 'Product inactivated successfully';
        } else {
            $product->update(['status' => 1]);
            $message = 'Product activated successfully';
        }

        return redirect('/products')->with('success', $message);
    }


}
