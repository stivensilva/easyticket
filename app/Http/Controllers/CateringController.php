<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CateringCategory;
use App\Models\Catering;

use Validator;

class CateringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Catering::where('status', 1)->get();
        $data = Catering::all();
        return view('catering.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CateringCategory::where('status', 1)->get();
        return view('catering.new', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg',
            'category_id' => 'required|exists:catering_categories,id',
            'description' => 'required'
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }

        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images/catering'), $imageName);

        Catering::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imageName,
            'status' => $request->input('status'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
        ]);
        
        return redirect('catering');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catering = Catering::with('catering_category')->findOrFail($id);
        return response()->json(['catering' => $catering]);
    }

    // public function bestseller(string $id)
    // {
    //     $data = Catering::findOrFail($id);
    //     $data->bestseller = !$data->bestseller;
    //     $data->save();

    //     return response()->json(['success' => true]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Catering::find($id);
        $categories = CateringCategory::where('status', 1)->get();
        return view('catering.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg',
            'category_id' => 'required|exists:catering_categories,id',
            'description' => 'required',
        ]);

        $catering = Catering::findOrFail($id);

        $catering->name = $request->input('name');
        $catering->price = $request->input('price');
        $catering->status = $request->input('status');
        $catering->bestseller = $request->input('bestseller');
        $catering->category_id = $request->input('category_id');
        $catering->description = $request->input('description');

        if ($request->hasFile('image')) {

            if ($catering->image) {
                $filePath = public_path('images/catering/' . $catering->image);
                if (file_exists($filePath))
                    unlink($filePath);
            }
            
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/catering'), $imageName);
            $catering->image = $imageName;
        }

        $catering->save();

        return redirect('/catering')->with('success', 'Catering updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catering = Catering::findOrFail($id);

        if ($catering->status == 1) {
            $catering->update(['status' => 0]);
            $message = 'Catering inactivated successfully';
        } else {
            $catering->update(['status' => 1]);
            $message = 'Catering activated successfully';
        }

        return redirect('/catering')->with('success', $message);
    }


}
