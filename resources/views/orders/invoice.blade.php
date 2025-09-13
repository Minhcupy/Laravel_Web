<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            font-size: 14px;
            background: #f8f9fa;
        }
        .invoice-box {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .invoice-header {
            border-bottom: 2px solid #0d6efd;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .invoice-header h2 {
            margin: 0;
            font-weight: 700;
            color: #0d6efd;
        }
        table th {
            background: #e9ecef;
        }
        table td, table th {
            vertical-align: middle;
        }
        .total {
            font-size: 16px;
            font-weight: bold;
            color: #dc3545;
        }
        @media print {
            body {
                background: #fff;
            }
            .btn {
                display: none;
            }
            .invoice-box {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="invoice-box">
        {{-- Header --}}
        <div class="invoice-header d-flex justify-content-between align-items-center">
            <h2>🧾 HÓA ĐƠN</h2>
            <span class="text-muted">Mã đơn: #{{ $order->id }}</span>
        </div>

        {{-- Thông tin khách hàng --}}
        <div class="mb-3">
            <p><strong>📅 Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>👤 Khách hàng:</strong> {{ $order->name }}</p>
            <p><strong>📞 Điện thoại:</strong> {{ $order->phone }}</p>
            <p><strong>🏠 Địa chỉ:</strong> {{ $order->address }}</p>
        </div>

        {{-- Bảng sản phẩm --}}
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-end">Đơn giá</th>
                    <th class="text-end">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Sản phẩm' }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">{{ number_format($item->price, 0, ',', '.') }} ₫</td>
                    <td class="text-end">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} ₫</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Tổng cộng --}}
        <div class="d-flex justify-content-end mt-3">
            <div class="total">
                Tổng tiền: {{ number_format($order->total, 0, ',', '.') }} ₫
            </div>
        </div>

        {{-- Nút in --}}
        <div class="text-center mt-4">
            <button onclick="window.print()" class="btn btn-primary px-4">
                🖨️ In hóa đơn
            </button>
        </div>
    </div>
</div>
</body>
</html>
