<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;

use Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::all();
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        return view('customers.index', compact('data', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'birthday' => 'required|integer|between:1,31',
            'birthmonth' => 'required|integer|between:1,12',
            'zipcode' => 'required|integer',
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }
            
        Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'birthmonth' => $request->input('birthmonth'),
            'zipcode' => $request->input('zipcode'),
        ]);

        return redirect('customers');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json(['customer' => $customer]);        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Customer::find($id);
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        return view('customers.edit', compact('data', 'months'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $validation = Validator::make( $request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'birthday' => 'required|integer|between:1,31',
            'birthmonth' => 'required|integer|between:1,12',
            'zipcode' => 'required|integer',
        ]);
 
        if ($validation->fails()) {
            return redirect()->back()
                        ->withErrors($validation)
                        ->withInput();
        }
            
        Customer::find($id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'birthmonth' => $request->input('birthmonth'),
            'zipcode' => $request->input('zipcode'),
        ]);
        
        return redirect('/customers')->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Customer::findOrFail($id);

        if ($coupon->status == 1) {
            $coupon->update(['status' => 0]);
            $message = 'Customer inactivated successfully';
        } else {
            $coupon->update(['status' => 1]);
            $message = 'Customer activated successfully';
        }

        return redirect('/customers')->with('success', $message);
    }


}
