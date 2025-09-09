<footer class="bg-white text-dark mt-5 pt-5 pb-3 w-100 border-top">
    <div class="container px-4">
        <div class="row gy-4">
            {{-- Cột 1: Thông tin shop --}}
            <div class="col-md-4">
                <h5 class="fw-bold text-primary mb-3">Laravel Shop</h5>
                <p class="text-muted">
                    Mang đến trải nghiệm mua sắm trực tuyến <br>
                    dễ dàng, nhanh chóng và tiện lợi.
                </p>
            </div>

            {{-- Cột 2: Liên hệ --}}
            <div class="col-md-4">
                <h5 class="fw-bold text-primary mb-3">Liên hệ</h5>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i>123 Đường ABC, Quận 1, TP.HCM</li>
                    <li class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i>0123 456 789</li>
                    <li><i class="bi bi-envelope-fill text-primary me-2"></i>support@laravelshop.com</li>
                </ul>
            </div>

            {{-- Cột 3: Liên kết nhanh --}}
            <div class="col-md-4">
                <h5 class="fw-bold text-primary mb-3">Liên kết nhanh</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('shop.index') }}" class="footer-link">Trang chủ</a></li>
                    <li class="mb-2"><a href="{{ route('products.index') }}" class="footer-link">Sản phẩm</a></li>
                    <li class="mb-2"><a href="{{ route('cart.index') }}" class="footer-link">Giỏ hàng</a></li>
                    <li><a href="#" class="footer-link">Liên hệ</a></li>
                </ul>
            </div>
        </div>
        <hr class="mt-4">
        <p class="text-center small mb-0 text-muted">© {{ date('Y') }} Laravel Shop. All rights reserved.</p>
    </div>
</footer>

<style>
    .footer-link {
        color: #0d6efd;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .footer-link:hover {
        text-decoration: underline;
        color: #0a58ca; /* xanh đậm hơn khi hover */
    }
</style>
