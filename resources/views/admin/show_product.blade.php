<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .center{
            margin: auto;
            width: 60%;
            border: 2px solid white;
            text-align: center;
            margin-top: 40px;
        }
        .font{
            text-align: center;
            font-size: 40px;
            padding-top: 20px; 
        }
        .img{
            width: 100px;
            height: 100px;
        }

       td, th, tr{
            border: 2px solid white;
           
        }

        th{
             padding: 20px;
        }
        .color{
           background-color: skyblue;
        }
       
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
       @include('admin.header')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

               @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


            <table class="center">
                <h2 class="font">All Products</h2>
<tr class="color">
    <th>Product Title</th>
    <th>Description</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Discount Price</th>
    <th>Category</th>
    <th>Product Image</th>
        <th>Delete</th>
        <th>Edit</th>

</tr>
@foreach($product as $product)
<tr>
    <td>{{$product->title}}</td>
    <td>{{$product->description}}</td>
    <td>{{$product->quantity}}</td>
    <td>{{$product->price}}</td>
    <td>{{$product->discount_price}}</td> 
    <td>{{$product->category}}</td>
    <td>
        <img class="img" src="/product/{{$product->image}}" alt="">
    </td>
    <td><a class="btn btn-danger" onclick="return confirm('Are You Sure to Delete This')" href="{{route('delete_product', $product->id)}}">Delete</a></td>
    <td><a class="btn btn-success" href="{{route('update_product',$product->id)}}">Edit</a></td>
</tr>
@endforeach

            </table>
            </div>
            </div>
            
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>
