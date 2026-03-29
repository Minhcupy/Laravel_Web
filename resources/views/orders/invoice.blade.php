<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; font-size: 14px; }
        table th, table td { vertical-align: middle; }
    </style>
</head>
<body>
<div class="container py-4">
    <h2 class="mb-4">🧾 Hóa đơn đơn hàng #{{ $order->id }}</h2>

    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Khách hàng:</strong> {{ $order->name }}</p>
    <p><strong>Điện thoại:</strong> {{ $order->phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'Sản phẩm' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }} ₫</td>
                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} ₫</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="text-end mt-3">Tổng tiền: {{ number_format($order->total, 0, ',', '.') }} ₫</h5>

    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">🖨️ In hóa đơn</button>
    </div>
</div>
</body>
</html>
