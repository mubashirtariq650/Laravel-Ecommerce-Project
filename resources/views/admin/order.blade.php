<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style>
      .deg {
        text-align: center;
        font-size: 25px;
        font-weight: bold;
        padding-bottom: 40px;
      }

      .table-container {
        overflow-x: auto;
        margin-bottom: 30px;
      }

      .tabl {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px; /* ensure wide tables scroll on small screens */
      }

      .tabl th, .tabl td {
        padding: 10px;
        border: 2px solid white;
        text-align: center;
      }

      .tabl .th {
        background-color: skyblue;
      }

      .img {
        height: 100px;
        width: auto;
        max-width: 100%;
       }

      /* Responsive adjustments */
      @media (max-width: 768px) {
        .deg {
          font-size: 20px;
        }
        .tabl th, .tabl td {
          font-size: 14px;
          padding: 8px;
        }
        .img {
          height: 80px;
        }
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      @include('admin.header')

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

          <h1 class="deg">All Orders</h1>
          <div style="color:black;   margin:auto; text-align:center; padding-bottom:30px;">

             <form action="{{route('search')}}" method="get">
              @csrf
              <input type="text" name="search" placeholder="Search here">
              <input type="submit" value="search" class="btn btn-outline-primary">
             </form>
          </div>

          <div class="table-container">
            <table class="tabl">
              <thead>
                <tr class="th">
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Product Title</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Payment Status</th>
                  <th>Delivery Status</th>
                  <th>Image</th>
                  <th>Delivered</th>
                  <th>Print PDF</th>
                  <th>Send Email</th>

                </tr>
              </thead>
              <tbody>
                @forelse($order as $order)
                <tr>
                  <td>{{$order->name}}</td>
                  <td>{{$order->email}}</td>
                  <td>{{$order->address}}</td>
                  <td>{{$order->phone}}</td>
                  <td>{{$order->product_title}}</td>
                  <td>{{$order->quantity}}</td>
                  <td>${{$order->price}}</td>
                  <td>{{$order->payment_status}}</td>
                  <td>{{$order->delivery_status}}</td>
                  <td><img class="img" src="/product/{{$order->image}}" alt=""></td>
                  <td>
                    @if($order->delivery_status == 'Processing')
                      <a class="btn btn-primary" href="{{ route('delivered', $order->id) }}"
                        onclick="return confirm('Are you sure the product is delivered?')">Delivered</a>
                    @else
                      <span style="color: green; font-weight: bold; font-size: 20px;">&#10004;</span>
                    @endif
                  </td>
                  <td><a href="{{route('print_pdf',$order->id)}}" class="btn btn-secondary">Print</a></td>
                  <td>
                    <a href="{{route('send_email', $order->id)}}" class="btn btn-info" >Send Email</a>
                  </td>
                </tr>

                @empty
                <tr>
<td colspan="16">
                  <p style="font-size: 25px;">No Data Found</p>
                </td>
                </tr>
                
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    @include('admin.script')
  </body>
</html>
