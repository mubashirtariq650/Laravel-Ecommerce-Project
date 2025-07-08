<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        label{
            display: inline-block;
            width: 170px;
            font-size: 15px;
            font-weight: bold;
        }
        .form-input {
            color: black;
            width: 300px;
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


 {{-- ❌ Error Messages - ALL errors in ONE alert box --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin-top: 10px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <h1 style="text-align:center; font-size:25px;">Send Email to ({{ $order->email }})</h1>
                <form action="{{route('send_user_email', $order->id)}}" method="POST">
                    @csrf
                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email Greeting :</label>
                        <input style="color: black" type="text" name="greeting">
                    </div>


                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email First Line :</label>
                        <input style="color: black"  type="text" name="firstline">
                    </div>

                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email body :</label>
                        <input style="color: black"  type="text" name="body">
                    </div>

                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email Button Name :</label>
                        <input style="color: black"  type="text" name="button">
                    </div>

                    <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email URL : </label>
                        <input style="color: black"  type="text" name="url">
                    </div>

                     <div style="padding-left:35%; padding-top:30px;">
                        <label for="">Email Last Line :</label>
                        <input style="color: black"  type="text" name="lastline">
                    </div>

                     <div style="padding-left:35%; padding-top:30px;">  
                        <input type="submit" value="Send Email" class="btn btn-primary">
                    </div>
                </form>


            </div>
        </div>
        <!-- plugins:js -->
        @include('admin.script')
</body>

</html>
