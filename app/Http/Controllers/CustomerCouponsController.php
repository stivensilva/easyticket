<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\CustomerCoupon;

use Validator;
use DB;

class CustomerCouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = date('Y-m-d');
        
        // DB::table('coupons_customers')
        //       ->join('coupons', 'coupons_customers.coupon_id', '=', 'coupons.id')
        //       ->where('coupons.status', 0)
        //       ->where('coupons_customers.status', '!=', 4)
        //       ->update(['coupons_customers.status' => 0]);
        
        DB::table('coupons_customers')
                ->join('coupons', 'coupons_customers.coupon_id', '=', 'coupons.id')
                ->where('coupons.startdate', '<=', $currentDate)
                ->where('coupons.enddate', '>=', $currentDate)
                ->where('coupons_customers.status', '!=', 0)
                ->where('coupons_customers.status', '!=', 4)
                ->update(['coupons_customers.status' => 1]);

        DB::table('coupons_customers')
              ->join('coupons', 'coupons_customers.coupon_id', '=', 'coupons.id')
              ->where('coupons.enddate', '<', $currentDate)
                ->where('coupons_customers.status', '!=', 0)
              ->where('coupons_customers.status', '!=', 3)
              ->where('coupons_customers.status', '!=', 4)
              ->update(['coupons_customers.status' => 3]);

        DB::table('coupons_customers')
              ->join('coupons', 'coupons_customers.coupon_id', '=', 'coupons.id')
              ->where('coupons.startdate', '>', $currentDate)
                ->where('coupons_customers.status', '!=', 0)
              ->where('coupons_customers.status', '!=', 2)
              ->where('coupons_customers.status', '!=', 4)
              ->update(['coupons_customers.status' => 2]);
        
        // CustomerCoupon::whereHas('coupon', function($query) use ($currentDate) {
        //             $query->where('startdate', '<=', $currentDate)
        //                   ->where('enddate', '>=', $currentDate)
        //                   ->where('status', '!=', 0);
        //             })->update(['status' => 1]);
                    
        // CustomerCoupon::whereHas('coupon', function($query) use ($currentDate) {
        //             $query->where('enddate', '<', $currentDate)
        //                   ->where('status', '!=', 0);
        //             })->update(['status' => 3]);
                    
        // CustomerCoupon::whereHas('coupon', function($query) use ($currentDate) {
        //             $query->where('startdate', '>', $currentDate)
        //                   ->where('status', '!=', 0);
        //             })->update(['status' => 2]);

        $data = CustomerCoupon::all();
        
        return view('customercoupons.index', compact('data'));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coupon = CustomerCoupon::with('customer')->with('coupon')->findOrFail($id);
        return response()->json(['coupon' => $coupon]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = CustomerCoupon::findOrFail($id);

        if ($coupon->status != 0) {
            $coupon->status = 0;
            $message = 'Coupon inactivated successfully';
        } else {
            $coupon->status = 1;
            $message = 'Coupon activated successfully';
        }
    
        $coupon->save();
        
        return redirect('/customer-coupons')->with('success', $message);
    }


}
