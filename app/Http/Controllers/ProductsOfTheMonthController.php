<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOfTheMonth;

use Validator;

class ProductsOfTheMonthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProductOfTheMonth::all();
        return view('monthsproducts.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();
        
        return view('monthsproducts.new', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $validation = Validator::make($request->all(), [
            'product_1' => 'required',
            'product_2' => 'required',
            'product_3' => 'required',
            'title_1' => 'required',
            'title_2' => 'required',
            'title_3' => 'required',
            'promo_1' => 'required',
            'promo_2' => 'required',
            'promo_3' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'photo_1' => 'required|image',
            'photo_2' => 'required|image',
            'photo_3' => 'required|image',
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }
        
        $directory = public_path('images/monthsproducts/');
        $files = scandir($directory);
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $filePath = $directory . $file;
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }
        }
        
        ProductOfTheMonth::truncate();
        
        for ($i=1; $i<=3; $i++) {
        
            $product = new ProductOfTheMonth();
    
            $product->product_id = $request->input("product_$i");
            $product->title = $request->input("title_$i");
            $product->promo = $request->input("promo_$i");
            $product->startdate = $request->input("startdate");
            $product->enddate = $request->input("enddate");
    
            if ($request->hasFile("photo_$i")) {
                $image = $request->file("photo_$i");
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('images/monthsproducts'), $imageName);
                $product->photo = $imageName;
            }
    
            $product->save();
        }
        
        return redirect('products-of-the-month');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::orderBy('name')->get();
        $data = ProductOfTheMonth::all();
        
        return view('monthsproducts.edit', compact('products', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        
        $validation = Validator::make($request->all(), [
            'product_1' => 'required',
            'product_2' => 'required',
            'product_3' => 'required',
            'title_1' => 'required',
            'title_2' => 'required',
            'title_3' => 'required',
            'promo_1' => 'required',
            'promo_2' => 'required',
            'promo_3' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            // 'photo_1' => 'required|image',
            // 'photo_2' => 'required|image',
            // 'photo_3' => 'required|image',
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }
        
        // $directory = public_path('images/monthsproducts/');
        // $files = scandir($directory);
        
        // foreach ($files as $file) {
        //     if ($file != '.' && $file != '..') {
        //         $filePath = $directory . $file;
        //         if (is_file($filePath)) {
        //             unlink($filePath);
        //         }
        //     }
        // }
        
        // ProductOfTheMonth::truncate();
        
        for ($i=1; $i<=3; $i++) {
        
            $product = ProductOfTheMonth::find($request->input("id_$i"));
    
            $product->product_id = $request->input("product_$i");
            $product->title = $request->input("title_$i");
            $product->promo = $request->input("promo_$i");
            $product->startdate = $request->input("startdate");
            $product->enddate = $request->input("enddate");
    
            if ($request->hasFile("photo_$i")) {
                $image = $request->file("photo_$i");
                $imageName = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('images/monthsproducts'), $imageName);
                $product->photo = $imageName;
            }
    
            $product->save();
        }
        
        return redirect('products-of-the-month');
       
        // return redirect('/products')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    }


}
