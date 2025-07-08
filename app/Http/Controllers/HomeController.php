<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


      public function index(){
        $product = Product::paginate(9);
        return view('home.userpage' , compact('product'));
    }


    public function redirect(){
            
        // 🔐 Block unverified users
/** @var \App\Models\User $user */
    $user = Auth::user();

    if (!$user->hasVerifiedEmail()) {
        return redirect('/email/verify');
    }

    // 🧠 Now verified users continue
    $usertype = Auth::user()->usertype;
       

        if( $usertype=='1'){
            $total_product=Product::all()->count();
            $total_customer=User::all()->count();
            $total_order=Order::all()->count();
            $order= Order::all();
            $total_revenue=0;
            foreach($order as $order){
                $total_revenue=$total_revenue + $order->price;
            }

            $total_delivered=Order::where('delivery_status', '=', 'delivered')->get()->count();
            $total_processing=Order::where('delivery_status', '=', 'processing')->get()->count();


            return view('admin.home', compact('total_product', 'total_customer','total_order','total_revenue', 'total_delivered', 'total_processing'));
        }

        else{
             $product = Product::paginate(9);
        return view('home.userpage' , compact('product'));
        }
    }

    public function product_details($id){
       $product = Product::findOrFail($id);
        return view('home.product_details',compact('product'));
    }

    public function add_cart(Request $request, $id){
        if(Auth::id()){
            
            $user=Auth::user();
            $product= Product::find($id);
            $cart =new cart;
            $cart->name= $user->name;
            $cart->email= $user->email;
            $cart->phone= $user->phone;
            $cart->address= $user->address;
            $cart->user_id= $user->id;
             $cart->product_title= $product->title;
             $cart->quantity = $request->quantity;
 $cart->price = ($product->discount_price ?? $product->price) * $request->quantity;
               $cart->image= $product->image;
                $cart->product_id= $product->id;
                $cart->quantity = $request->quantity;
                $cart->save();
                return redirect()->back();
            
        }
        else{
            return redirect('login');
        }
    }

    public function show_cart(){
        if(Auth::id()){
             $id=Auth::user()->id;       
        // Logged in user ka ID le raha hai
        $cart= Cart::where('user_id', '=' , $id)->get();
        // Cart table se sirf wo items nikaal raha hai jinka user_id logged-in user ke ID ke barabar hai.
   return view('home.showcart', compact('cart'));

        }

        else{
            return redirect('login');
        }
       
 }

 public function remove_cart($id){
    $cart =Cart::find($id);
    $cart->delete();
    return redirect()->back();
 }


 public function cash_order(){
    $user=Auth::user();
    $userid= $user->id;
    $data=Cart::where('user_id','=', $userid)->get();
     foreach($data as $data){
  $order = new Order;
  $order->name = $data->name;
  $order->email = $data->email;
  $order->phone = $data->phone;
  $order->address = $data->address;
  $order->user_id = $data->user_id;


  $order->product_title = $data->product_title;
  $order->price = $data->price;
  $order->quantity = $data->quantity;
  $order->image = $data->image;
  $order->product_id = $data->product_id;

  $order->payment_status = 'Cash On Delivery';
  $order->delivery_status= 'Processing';
  $order->save();
  $cart_id=$data->id;
  $cart=Cart::find($cart_id);
  $cart->delete();
     }
     return redirect()->back()->with('message','We Received Your Order.We will Connect With You Soon....');
 }

  
}
