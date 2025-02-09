<!DOCTYPE html>
<html>
<head>
    <title>Orders Report</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Orders Report</h2>
    <table>
        <thead>
        <tr>
            <th>Customer</th>
            <th>Email</th>
            <th>Order Date</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                @foreach($order->items as $item)
                <tr>
                <td>{{ $order->customer->customer_name }}</td>
                <td>{{ $order->customer->customer_email }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->product_price }}</td>
                <td>{{ $item->quantity }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
