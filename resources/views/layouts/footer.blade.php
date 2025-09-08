<footer class="text-light mt-5 pt-4 pb-3 w-100" style="background: linear-gradient(135deg, #1e88e5, #42a5f5);">
    <div class="container-fluid px-5">
        <div class="row">
            {{-- Cột 1: Thông tin shop --}}
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold"><i class="bi bi-trophy me-2"></i>VợtPro Shop</h5>
                <p>Chuyên cung cấp vợt cầu lông chất lượng cao từ các thương hiệu hàng đầu thế giới. Mang đến trải nghiệm chơi cầu lông tuyệt vời nhất.</p>
            </div>

            {{-- Cột 2: Liên hệ --}}
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">Liên hệ</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-geo-alt me-2"></i>123 Đường Cầu Lông, Quận 1, TP.HCM</li>
                    <li><i class="bi bi-phone me-2"></i>0123 456 789</li>
                    <li><i class="bi bi-envelope me-2"></i>support@votpro.com</li>
                    <li><i class="bi bi-clock me-2"></i>8:00 - 22:00 (Tất cả các ngày)</li>
                </ul>
            </div>

            {{-- Cột 3: Liên kết nhanh --}}
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">Thương hiệu nổi bật</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('shop.index') }}" class="text-light text-decoration-none hover-link">🏸 Yonex</a></li>
                    <li><a href="{{ route('shop.index') }}" class="text-light text-decoration-none hover-link">🏸 Victor</a></li>
                    <li><a href="{{ route('shop.index') }}" class="text-light text-decoration-none hover-link">🏸 Mizuno</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-light text-decoration-none hover-link">🛒 Giỏ hàng</a></li>
                </ul>
            </div>
        </div>
        <hr class="border-light">
        <p class="text-center mb-0">© {{ date('Y') }} VợtPro Shop - Vợt Cầu Lông Chuyên Nghiệp. All rights reserved.</p>
    </div>

    <style>
        .hover-link:hover {
            color: #ffeb3b !important;
            transition: color 0.3s ease;
        }
    </style>
</footer>
