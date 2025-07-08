<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Details - #{{ $order->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            line-height: 1.5;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #666;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            color: #444;
        }
        .info, .items {
            margin-bottom: 25px;
        }
        .info p {
            margin: 0 0 6px 0;
        }
        .status {
            background-color: #f4f4f4;
            padding: 10px;
            border-left: 5px solid {{ $order->payment_status === 'Paid' ? '#28a745' : '#dc3545' }};
            margin-top: 10px;
            margin-bottom: 25px;
            font-weight: bold;
        }
        .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .items th, .items td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .items th {
            background-color: #f4f4f4;
        }
        .total {
            text-align: right;
            font-size: 18px;
            margin-top: 15px;
        }
        .img {
            width: 60px;
            height: auto;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Order Invoice</h1>
        <p>Order ID: #{{ $order->id }}</p>
    </div>

    <div class="info">
        <p><strong>Customer Name:</strong> {{ $order->name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
    </div>

    <div class="status">
        Payment Status: {{ ucfirst($order->payment_status) }}
    </div>

    <div class="items">
        <h3>Order Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>{{ $order->product_title }}</td>
                    <td>
<img src="{{ public_path('product/' . $order->image) }}" class="img" alt="Product Image">
                    </td>
                    <td>{{ $order->quantity }}</td>
                    <td>$ {{ number_format($order->price, 2) }}</td>
                    <td>$ {{ number_format($order->price * $order->quantity, 2) }}</td>
                </tr>
               
            </tbody>
        </table>
    </div>

    <div class="total">
        <p><strong>Total:</strong> $ {{ number_format($order->price * $order->quantity, 2) }}</p>
    </div>

</body>
</html>
