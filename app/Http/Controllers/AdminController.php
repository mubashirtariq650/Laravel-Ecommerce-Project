<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Barryvdh\DomPDF\Facade\PDF;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
   public function view_category()
   {
      $data = Category::all();
      return view('admin.category', compact('data'));
   }

   public function add_category(Request $request)
   {
      $data = new Category;
      $data->category_name = $request->category;
      $data->save();
      return redirect()->back()->with('message', 'Category Added Successfully');
   }

   public function delete_category($id)
   {
      $data = Category::find($id);
      $data->delete();
      return redirect()->back()->with('message', 'Category Deleted Successfully');
   }


   public function view_product()
   {
      $category = Category::all();
      return view('admin.product', compact('category'));
   }

   public function add_product(Request $request)
   {
      $product = new Product;
      $product->title = $request->title;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->quantity = $request->quantity;
      $product->discount_price = $request->discount_price;
      $product->category = $request->category;
      $image = $request->image;
      $imagename = time() . '.' . $image->getClientOriginalExtension();
      $request->image->move('product', $imagename);
      $product->image = $imagename;
      $product->save();
      return redirect()->route('show_product')->with('message', 'Product Added Successfully');
   }

   public function show_product()
   {
      $product = Product::all();
      return view('admin.show_product', compact('product'));
   }

   public function delete_product($id)
   {
      $product = Product::find($id);
      $product->delete();
      return redirect()->back()->with('message', 'Product Deleted Successfully');
   }
   public function update_product($id)
   {
      $category = Category::all();
      $product = Product::find($id);
      return view('admin.update_product', compact('product', 'category'));
   }

   public function update_product_confirm(Request $request, $id)
   {

      $product = Product::find($id);
      $product->title = $request->title;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->quantity = $request->quantity;
      $product->discount_price = $request->discount_price;
      $product->category = $request->category;
      $image = $request->image;

      if ($request->hasFile('image')) {
         $imagename = time() . '.' . $image->getClientOriginalExtension();
         $request->image->move('product', $imagename);
         $product->image = $imagename;
      }

      $product->save();
      return redirect()->route('show_product')->with('message', 'Product Updated Successfully');
   }

   public function order()
   {
      $order = Order::all();
      return view('admin.order', compact('order'));
   }

   public function delivered($id)
   {
      $order = Order::find($id);
      $order->delivery_status = "delivered";
      $order->payment_status = "Paid";
      $order->save();
      return redirect()->back()->with('message', 'Product marked as delivered!');
   }

   public function print_pdf($id)
   {
      $order = Order::findOrFail($id);
      // Set DomPDF options to allow image rendering
      PDF::setOptions([
         'isRemoteEnabled' => true
      ]);
      $pdf = PDF::loadView('admin.pdf', compact('order'));
      return $pdf->download('order_details.pdf');
   }

   public function send_email($id)
   {
      $order = Order::find($id);
      return view('admin.email_info', compact('order'));
   }

public function send_user_email(Request $request, $id)
{
    $request->validate([
        'greeting'   => 'required|string',
        'firstline'  => 'required|string',
        'body'       => 'required|string',
        'button'     => 'required|string',
        'url'        => 'required|url',
        'lastline'   => 'required|string',
    ]);

    $order = Order::findOrFail( $id); // safer than find()

    $details = [
        'greeting'   => $request->greeting,
        'firstline'  => $request->firstline,
        'body'       => $request->body,
        'button'     => $request->button,
        'url'        => $request->url,
        'lastline'   => $request->lastline,
    ];

    Notification::send($order, new SendEmailNotification($details));

    return redirect()->back()->with('message', 'Email sent successfully!');
}


public function search(Request $request){
   $searchtext = $request->search;
   $order=Order::where('name','Like',"%$searchtext%")->orwhere('phone','Like',"%$searchtext%")->orwhere('product_title','Like',"%$searchtext%")->get();
   return view('admin.order', compact('order'));

}

 }