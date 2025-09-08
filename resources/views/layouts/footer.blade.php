<footer class="bg-dark text-light mt-5 pt-4 pb-3 w-100">
    <div class="container-fluid px-5">
        <div class="row">
            {{-- Cột 1: Thông tin shop --}}
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">Laravel Shop</h5>
                <p>Mang đến trải nghiệm mua sắm trực tuyến dễ dàng, nhanh chóng và tiện lợi.</p>
            </div>

            {{-- Cột 2: Liên hệ --}}
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">Liên hệ</h5>
                <ul class="list-unstyled">
                    <li>📍 123 Đường ABC, Quận 1, TP.HCM</li>
                    <li>📞 0123 456 789</li>
                    <li>✉️ support@laravelshop.com</li>
                </ul>
            </div>

            {{-- Cột 3: Liên kết nhanh --}}
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">Liên kết nhanh</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('shop.index') }}" class="text-light text-decoration-none">Trang chủ</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-light text-decoration-none">Sản phẩm</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-light text-decoration-none">Giỏ hàng</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Liên hệ</a></li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center mb-0">© {{ date('Y') }} Laravel Shop. All rights reserved.</p>
    </div>
</footer>
