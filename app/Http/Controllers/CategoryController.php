<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;

use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Category::where('status', 1)->get();
        $data = Category::all();
        return view('categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg',
            'description' => 'required',
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }

        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images/categories'), $imageName);

        Category::create([
            'name' => $request->input('name'),
            'image' => $imageName,
            'description' => $request->input('description'),
        ]);
        
        return redirect('categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "Metodo show - $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Category::find($id);
        return view('categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->input('name');
        $category->description = $request->input('description');

        if ($request->hasFile('image')) {

            if ($category->image) {
                $filePath = public_path('images/categories/' . $category->image);
                if (file_exists($filePath))
                    unlink($filePath);
            }
            
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect('/categories')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->status == 1) {
            $category->update(['status' => 0]);
            $message = 'Category inactivated successfully';
        } else {
            $category->update(['status' => 1]);
            $message = 'Category activated successfully';
        }

        return redirect('/categories')->with('success', $message);
    }

}
