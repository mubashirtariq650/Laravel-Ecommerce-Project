<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .div_center{
        text-align: center;
        padding: 40px;
        }
        .font{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .colour{
            color: black;
            padding-bottom: 20px;
        }

        label{
            display: inline-block;
            width: 200px;
        }

        .div_design{
            padding-bottom: 15px;

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


<div class="div_center">
    <h1 class="font">Add Products</h1>
<form action="{{route('update_product_confirm', $product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="div_design">
<label for="">Product Title :</label>
<input  class="colour" type="text" name="title" placeholder="Write A Title" required value="{{$product->title}}">
</div>

<div class="div_design">
<label for="">Product Description :</label>
<input  class="colour" type="text" name="description" placeholder="Write A Description" required value="{{$product->description}}">
</div>


<div class="div_design">
<label for="">Product Price :</label>
<input  class="colour" type="number" name="price" placeholder="Write A Price" required value="{{$product->price}}">
</div>


<div class="div_design">
<label for="">Discount Price :</label>
<input  class="colour" type="text" name="discount_price" placeholder="Write A Discounted Price" value="{{$product->discount_price}}">
</div>


<div class="div_design">
<label for="">Product Quantity :</label>
<input  class="colour" type="number" min="0" name="quantity" placeholder="Write A Quantity" required value="{{$product->quantity}}">
</div>


<div class="div_design">
  <label for="category">Product Category:</label>
  <select class="colour" name="category"  required >
    <option value="{{$product->category}}">{{$product->category}}</option>
     @foreach($category as $category)
    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
    @endforeach
    <!-- Add more categories as needed -->
  </select>
</div>


<div class="div_design">
  <label for="image">Current Product Image:</label>
  <img style="margin: auto" height="100" width="100" src="/product/{{$product->image}}" alt="">
  </div>

<div class="div_design">
  <label for="image">Change Product Image:</label>
  <input class="colour" type="file" name="image" id="image">
  </div>





<div class="div_design">

<input type="submit" value="Update Product" class="btn btn-primary"  >
</div>
 </form>



             </div>
            </div>
            </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>
