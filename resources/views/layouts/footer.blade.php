<footer class="bg-white text-dark mt-5 pt-5 pb-4 w-100 border-top shadow-sm">
    <div class="container px-4">
        <div class="row gy-4">

            {{-- Cột 1: Giới thiệu --}}
            <div class="col-md-3">
                <h5 class="fw-bold text-primary mb-3">Laravel Shop</h5>
                <p class="text-muted small">
                    Chúng tôi cung cấp các sản phẩm chất lượng với dịch vụ uy tín.  
                    Email hỗ trợ: <a href="mailto:support@laravelshop.com" class="text-decoration-none text-primary">support@laravelshop.com</a>
                </p>
                <ul class="list-unstyled text-muted small mb-0">
                    <li>👉 Giới thiệu về chúng tôi</li>
                    <li>🌈 Thông tin cần biết</li>
                </ul>
            </div>

            {{-- Cột 2: Liên hệ --}}
            <div class="col-md-3">
                <h5 class="fw-bold text-primary mb-3">Liên hệ</h5>
                <ul class="list-unstyled text-muted small mb-0">
                    <li class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i>Hotline CSKH: 0123 456 789</li>
                    <li class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i>Bán Sỉ: 0909 123 456 (Zalo)</li>
                    <li class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i>Bán Lẻ: 0911 222 333 (Zalo)</li>
                    <li><i class="bi bi-geo-alt-fill text-primary me-2"></i>123 Đường ABC, Quận 1, TP.HCM</li>
                </ul>
            </div>

            {{-- Cột 3: Kết nối cộng đồng --}}
            <div class="col-md-3">
                <h5 class="fw-bold text-primary mb-3">Kết nối cộng đồng</h5>
                <div class="d-flex flex-wrap gap-2">
                    <a href="#" class="social-link bg-primary text-white px-3 py-1 rounded">Facebook</a>
                    <a href="#" class="social-link bg-warning text-dark px-3 py-1 rounded">Tiktok</a>
                    <a href="#" class="social-link bg-info text-white px-3 py-1 rounded">Zalo</a>
                    <a href="#" class="social-link bg-danger text-white px-3 py-1 rounded">Youtube</a>
                    <a href="#" class="social-link bg-pink text-white px-3 py-1 rounded">Instagram</a>
                </div>
            </div>

            {{-- Cột 4: Hỗ trợ khách hàng --}}
            <div class="col-md-3">
                <h5 class="fw-bold text-primary mb-3">Hỗ trợ khách hàng</h5>
                <ul class="list-unstyled text-muted small mb-0">
                    <li class="mb-2">🔒 Chính sách bảo mật</li>
                    <li class="mb-2">🚚 Chính sách vận chuyển</li>
                    <li class="mb-2">🛠 Chính sách bảo hành</li>
                    <li class="mb-2">💳 Chính sách thanh toán</li>
                    <li>🎁 Chính sách bán hàng</li>
                </ul>
            </div>

        </div>

        <hr class="mt-4">
        <p class="text-center small mb-0 text-muted">
            © {{ date('Y') }} Laravel Shop. Bản quyền thuộc về Laravel Shop.
        </p>
    </div>
</footer>

<style>
.social-link {
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
}
.social-link:hover {
    opacity: 0.85;
    text-decoration: none;
    transform: translateY(-2px);
}
.bg-pink {
    background-color: #e83e8c;
}
/* Responsive: thu gọn padding cho mobile */
@media (max-width: 768px) {
    .social-link {
        font-size: 13px;
        padding: 0.35rem 0.75rem;
    }
}
</style>
