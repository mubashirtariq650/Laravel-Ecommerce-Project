<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class StripeController extends Controller
{
    public function stripe($totalprice){

    return view('home.stripe', compact('totalprice'));

    }

    public function stripePost(Request $request ,$totalprice)

    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $totalprice * 100, 
                // (100means cents 100 centens equal to one dollar)

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Thanks For Payment" 

        ]);
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

  $order->payment_status = 'Paid';
  $order->delivery_status= 'Processing';
  $order->save();
  $cart_id=$data->id;
  $cart=Cart::find($cart_id);
  $cart->delete();

     }

       return back()->with('message', 'Payment successful!');

              

        return back();

    }
}
