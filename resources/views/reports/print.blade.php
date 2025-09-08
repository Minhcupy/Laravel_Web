<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>In báo cáo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body onload="window.print()">
    <div class="container mt-4">
        <h3 class="mb-3">Báo cáo doanh thu</h3>

        <p><strong>Bộ lọc:</strong>
            @foreach($filters as $k => $v)
            @if($v && $k !== '_token')
            {{ ucfirst($k) }}: {{ $v }};
            @endif
            @endforeach
        </p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Số đơn</th>
                    <th>Doanh thu (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $r)
                <tr>
                    <td>{{ $r->day }}</td>
                    <td>{{ $r->orders_count }}</td>
                    <td>{{ number_format($r->revenue) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Tổng</th>
                    <th>{{ $data->sum('orders_count') }}</th>
                    <th>{{ number_format($data->sum('revenue')) }}</th>
                </tr>
            </tfoot>
        </table>

    </div>
</body>

</html>