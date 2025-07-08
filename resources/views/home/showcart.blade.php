<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('home/images/favicon.png')}}" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style>
         .center{
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 30px;
         }

         table,th,td{
            border: 2px solid grey;
         }
         .th_deg{
            font-size: 30px;
            padding: 5px;
            background: skyblue; 
         }

         .imgg{
            height: 100px;
            width: 100px;
         }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')


               @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
         <!-- end header section -->
         <!-- slider section -->
         <!-- end slider section -->
      {{-- </div> --}}
      <!-- why section -->
      <!-- end why section -->
      <div class="center">
<table>
<tr>
   <th class="th_deg">Product Title</th>
   <th class="th_deg">Product Quantity</th>
   <th class="th_deg">Price</th>
   <th class="th_deg">Image</th>
   <th class="th_deg">Action</th>
</tr>

<?php $totalprice=0; ?>
@foreach($cart as $cart)
<tr>
   <td>{{$cart->product_title}}</td>
   <td>{{$cart->quantity}}</td>
   <td>${{$cart->price}}</td>
   <td><img class="imgg" src="/product/{{$cart->image}}" alt=""></td>
   <td><a class="btn btn-danger" onclick="return confirm('Are You Sure to Remove This Product From Cart')" href="{{route('remove_cart', $cart->id)}}">Remove</a> </td>
</tr>
<?php $totalprice= $totalprice+ $cart->price ?>

@endforeach

</table>

<div>
   <h1 style="font-size:20px; padding:40px;">
     Total Price: ${{$totalprice}} 
   </h1>
</div>

<div>
   <h1 style="font-size: 25px; padding-bottom:15px;">Proceed To Order</h1>
   <a class="btn btn-danger" href="{{route('cash_order')}}">Cash On Delivery</a>
   <a class="btn btn-danger" href="{{route('stripe', $totalprice)}}">Pay Using Card</a>

</div>

      </div>
      <!-- arrival section -->

      <!-- end arrival section -->
      
      <!-- product section -->
     

      <!-- end client section -->
      <!-- footer start -->
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>
   </body>
</html>