<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\CateringCategory;

use Validator;

class CateringCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = CateringCategory::where('status', 1)->get();
        $data = CateringCategory::all();
        return view('cateringcategories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cateringcategories.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'name' => 'required|unique:catering_categories',
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
        $image->move(public_path('images/cateringcategories'), $imageName);

        CateringCategory::create([
            'name' => $request->input('name'),
            'image' => $imageName,
            'description' => $request->input('description'),
        ]);
        
        return redirect('catering-categories');
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
        $data = CateringCategory::find($id);
        return view('cateringcategories.edit', compact('data'));
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

        $category = CateringCategory::findOrFail($id);

        $category->name = $request->input('name');
        $category->description = $request->input('description');

        if ($request->hasFile('image')) {

            if ($category->image) {
                $filePath = public_path('images/cateringcategories/' . $category->image);
                if (file_exists($filePath))
                    unlink($filePath);
            }
            
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/cateringcategories'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect('/catering-categories')->with('success', 'Catering category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CateringCategory::findOrFail($id);

        if ($category->status == 1) {
            $category->update(['status' => 0]);
            $message = 'Catering category inactivated successfully';
        } else {
            $category->update(['status' => 1]);
            $message = 'Catering category activated successfully';
        }

        return redirect('/catering-categories')->with('success', $message);
    }

}
