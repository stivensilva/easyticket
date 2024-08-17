<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Customer;


use Validator;
use Hash;
use Auth;
use DB;
use Carbon\Carbon;

class LoginController extends Controller
{
    
    public function check(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('home');
        }
 
        return back()->withErrors([
            'email' => 'Las credenciales ingresadas son incorrectas!',
        ])->onlyInput('email');
    }
    
    public function dashboard(){
        
        // $categories = Category::count();
        // $products = Product::count();
        // $customers = Customer::count();
        
        // $coupons = Coupon::count();
        // $active_coupons = Coupon::where('status', 1)->count();
        // $acquired_coupons = DB::table('coupons_customers')->where('status', '!=', 0)->count();
        // $redeemed_coupons = DB::table('coupons_customers')->where('status', 4)->count();
        
        
        return view('home');
        // return view('home', compact('categories', 'products', 'coupons', 'customers', 'active_coupons', 'acquired_coupons', 'redeemed_coupons'));
    }
    
    public function couponsData(){
        
        $startDate = Carbon::now()->subMonths(6)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        
        $months = DB::table('coupons_customers')
                    ->select(DB::raw('SUBSTRING(MONTHNAME(created_at), 1, 3) as month'))
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy(DB::raw('month'))
                    ->pluck('month');
        
        $data1 = DB::table('coupons_customers')
                    ->select(DB::raw('MONTH(created_at) as month, COUNT(*) as total'))
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->where('status', '!=', 0)
                    ->orderBy('month')
                    ->pluck('total');
            
        $data2 = DB::table('coupons_customers')
                    ->select(DB::raw('MONTH(created_at) as month, COUNT(*) as total'))
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('status', 4)
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->orderBy('month')
                    ->pluck('total');
                    
        $sumData1 = array_sum($data1->toArray());
        $sumData2 = array_sum($data2->toArray());
        $percentage = ($sumData2 / $sumData1) * 100;
        $percentage = number_format($percentage, 2);
        
        $data = [
            'months'     => $months->toArray(),
            'redeemed'   => $data1->toArray(),
            'delivered'  => $data2->toArray(),
            'percentage' => $percentage
        ];
        
        return response()->json($data);
    }
    
    public function showLinkRequestForm()
    {
        return view('auth.password.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:usuarios,email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
    
    
    public function showResetForm($token)
    {
        return view('auth.password.showResetForm', ['token' => $token]);
    }

    
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        // Determine what message to show to the user based on the status
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Your password has been reset!');
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
    
    public function profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        $user = Auth::user();
        $user->nombre = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    
  
    
    public function avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {

            $usuario = Auth::user();
            $imagenAnterior = $usuario->foto;
    
            if ($imagenAnterior) {
                $rutaImagenAnterior = public_path('images/users/') . $imagenAnterior;
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
            }
    
            $imagen = $request->file('avatar');
            $nombreImagen = $usuario->id . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('images/users'), $nombreImagen);
    
            $usuario->foto = $nombreImagen;
            $usuario->save();
        }
    
        return back();
    }

    
    public function logout(){
        Auth::logout();
        return redirect('login');
    }

}
