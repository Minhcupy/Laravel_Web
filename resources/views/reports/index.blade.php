@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-bold text-primary">
        <i class="bi bi-bar-chart-line"></i> Báo cáo doanh thu
    </h2>

    {{-- Form lọc --}}
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3 text-secondary">
                <i class="bi bi-funnel"></i> Bộ lọc dữ liệu
            </h5>
            <form id="filterForm" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Ngày</label>
                    <input type="date" name="date" class="form-control">
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">Tháng</label>
                    <select name="month" class="form-select">
                        <option value="">--Tất cả--</option>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ $m }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">Năm</label>
                    <select name="year" class="form-select">
                        <option value="">--Tất cả--</option>
                        @for($y = now()->year; $y >= 2000; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Phương thức thanh toán</label>
                    <select name="payment_method" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="cod">COD</option>
                        <option value="vnpay">VNPAY</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label fw-semibold">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="processing">Đang xử lý</option>
                        <option value="completed">Hoàn thành</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Danh mục</label>
                    <select name="category" class="form-select">
                        <option value="">Tất cả</option>
                        @foreach(($categories ?? []) as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 me-2">
                        <i class="bi bi-search"></i> Lọc
                    </button>
                    <button type="button" id="printBtn" class="btn btn-success px-4 d-none">
                        <i class="bi bi-printer"></i> In báo cáo
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Kết quả --}}
    <div id="resultSection" class="d-none">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title mb-3 text-secondary">
                    <i class="bi bi-table"></i> Kết quả lọc
                </h5>
                <div id="resultTable"></div>

                <div class="mt-4 row">
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 p-3 rounded-4">
                            <h6 class="fw-bold mb-2 text-primary"><i class="bi bi-bar-chart"></i> Doanh thu theo ngày</h6>
                            <canvas id="revenueChart" height="150"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 p-3 rounded-4">
                            <h6 class="fw-bold mb-2 text-danger"><i class="bi bi-graph-up"></i> Xu hướng doanh thu</h6>
                            <canvas id="lineChart" height="150"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 p-3 rounded-4">
                            <h6 class="fw-bold mb-2 text-success"><i class="bi bi-pie-chart"></i> Tỉ lệ đơn hàng</h6>
                            <canvas id="pieChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

{{-- ChartJS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function() {
    const form = document.getElementById('filterForm');
    const section = document.getElementById('resultSection');
    const tableWrap = document.getElementById('resultTable');
    const printBtn = document.getElementById('printBtn');
    let barChart, lineChart, pieChart;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const fd = new FormData(form);

        // Nút In báo cáo
        printBtn.classList.remove('d-none');
        printBtn.onclick = function() {
            const params = new URLSearchParams(fd).toString();
            window.open("{{ route('admin.reports.print') }}?" + params, "_blank");
        };

        fetch("{{ route('reports.filter') }}", {
            method: "POST",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: fd
        })
        .then(r => r.json())
        .then(data => {
            if (!data || !data.rows || data.rows.length === 0) {
                section.classList.remove('d-none');
                tableWrap.innerHTML = `<div class="alert alert-warning mb-0">Không có dữ liệu phù hợp.</div>`;
                drawCharts([], [], []);
                return;
            }

            // Bảng kết quả
            let html = `
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Ngày</th>
                            <th>Số đơn</th>
                            <th>Doanh thu (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody>`;
            data.rows.forEach(r => {
                html += `
                    <tr>
                        <td>${r.day}</td>
                        <td>${r.orders_count}</td>
                        <td class="text-end">${new Intl.NumberFormat().format(r.revenue)}</td>
                    </tr>`;
            });
            html += `
                    </tbody>
                    <tfoot class="table-secondary fw-bold">
                        <tr>
                            <td>Tổng</td>
                            <td>${data.rows.reduce((s, x) => s + Number(x.orders_count), 0)}</td>
                            <td class="text-end">${new Intl.NumberFormat().format(data.rows.reduce((s, x) => s + Number(x.revenue), 0))}</td>
                        </tr>
                    </tfoot>
                </table>`;
            tableWrap.innerHTML = html;

            // Hiện chart
            section.classList.remove('d-none');
            drawCharts(data.labels, data.revenues, data.rows.map(r => r.orders_count));
        })
        .catch(err => {
            console.error(err);
            section.classList.remove('d-none');
            tableWrap.innerHTML = `<div class="alert alert-danger mb-0">Có lỗi xảy ra khi tải dữ liệu.</div>`;
            drawCharts([], [], []);
        });
    });

    function drawCharts(labels, revenues, orders) {
        const barCtx = document.getElementById('revenueChart').getContext('2d');
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const pieCtx = document.getElementById('pieChart').getContext('2d');

        if (barChart) barChart.destroy();
        if (lineChart) lineChart.destroy();
        if (pieChart) pieChart.destroy();

        barChart = new Chart(barCtx, {
            type: 'bar',
            data: { labels, datasets: [{ label: 'Doanh thu (VNĐ)', data: revenues, backgroundColor: '#4e73df' }] },
            options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { callback: v => new Intl.NumberFormat().format(v) } } } }
        });

        lineChart = new Chart(lineCtx, {
            type: 'line',
            data: { labels, datasets: [{ label: 'Doanh thu (VNĐ)', data: revenues, borderColor: '#e74a3b', backgroundColor: 'rgba(231,74,59,0.3)', fill: true, tension: 0.4 }] },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });

        pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: { labels, datasets: [{ label: 'Số đơn hàng', data: orders, backgroundColor: ['#f6c23e', '#1cc88a', '#36b9cc', '#e74a3b', '#4e73df', '#858796'] }] },
            options: { responsive: true }
        });
    }
})();
</script>
@endsection
