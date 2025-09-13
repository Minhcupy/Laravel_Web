<footer class="enhanced-footer">
    <div class="footer-main">
        <div class="container px-4">
            <div class="row gy-5">

                {{-- Cột 1: Giới thiệu công ty --}}
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <div class="footer-logo mb-4">
                            <img src="{{ asset('img/Logoweb.png') }}" alt="Laravel Shop" class="footer-logo-img">
                            <h4 class="footer-brand-name">Laravel Shop</h4>
                        </div>
                        <p class="footer-description">
                            Chúng tôi chuyên cung cấp các sản phẩm thể thao chất lượng cao với dịch vụ uy tín,
                            đem đến trải nghiệm mua sắm tốt nhất cho khách hàng.
                        </p>
                        <div class="footer-stats">
                            <div class="stat-item">
                                <i class="bi bi-people-fill"></i>
                                <span>1000+ Khách hàng hài lòng</span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-award-fill"></i>
                                <span>5+ Năm kinh nghiệm</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cột 2: Thông tin liên hệ --}}
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">
                            <i class="bi bi-telephone-fill me-2"></i>
                            Thông tin liên hệ
                        </h5>
                        <div class="contact-list">
                            <div class="contact-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <div class="contact-details">
                                    <strong>Địa chỉ:</strong>
                                    <p>123 Đường ABC, Quận 1, TP.HCM</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill"></i>
                                <div class="contact-details">
                                    <strong>Hotline CSKH:</strong>
                                    <p><a href="tel:0123456789">0123 456 789</a></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill"></i>
                                <div class="contact-details">
                                    <strong>Email:</strong>
                                    <p><a href="mailto:support@laravelshop.com">support@laravelshop.com</a></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-clock-fill"></i>
                                <div class="contact-details">
                                    <strong>Giờ làm việc:</strong>
                                    <p>8:00 - 22:00 (Tất cả các ngày)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cột 3: Danh mục sản phẩm --}}
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">
                            <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                            Danh mục sản phẩm
                        </h5>
                        <ul class="footer-links">
                            <li><a href="#">Vợt cầu lông Yonex</a></li>
                            <li><a href="#">Vợt cầu lông Victor</a></li>
                            <li><a href="#">Vợt cầu lông Lining</a></li>
                            <li><a href="#">Giày cầu lông</a></li>
                            <li><a href="#">Áo quần thể thao</a></li>
                            <li><a href="#">Phụ kiện cầu lông</a></li>
                            <li><a href="#">Túi vợt cầu lông</a></li>
                            <li><a href="#">Cước đan vợt</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Cột 4: Chính sách & Dịch vụ --}}
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h5 class="footer-title">
                            <i class="bi bi-shield-check-fill me-2"></i>
                            Chính sách & Dịch vụ
                        </h5>
                        <ul class="footer-links">
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Chính sách vận chuyển</a></li>
                            <li><a href="#">Chính sách bảo hành</a></li>
                            <li><a href="#">Chính sách đổi trả</a></li>
                            <li><a href="#">Hướng dẫn thanh toán</a></li>
                            <li><a href="#">Hướng dẫn mua hàng</a></li>
                            <li><a href="#">Tuyển dụng</a></li>
                            <li><a href="#">Liên hệ hợp tác</a></li>
                        </ul>

                        <div class="payment-methods mt-4">
                            <h6 class="payment-title">Phương thức thanh toán:</h6>
                            <div class="payment-icons">
                                <img src="{{ asset('img/payment/cod.png') }}" alt="COD" class="payment-icon">
                                <img src="{{ asset('img/payment/vnpay.png') }}" alt="VNPay" class="payment-icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Social Media & Newsletter --}}
    <div class="footer-social">
        <div class="container px-4">
            <div class="row align-items-center gy-4">
                <div class="col-md-6">
                    <h5 class="social-title">Kết nối với chúng tôi</h5>
                    <div class="social-links">
                        <a href="#" class="social-link facebook">
                            <i class="bi bi-facebook"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="#" class="social-link youtube">
                            <i class="bi bi-youtube"></i>
                            <span>YouTube</span>
                        </a>
                        <a href="#" class="social-link instagram">
                            <i class="bi bi-instagram"></i>
                            <span>Instagram</span>
                        </a>
                        <a href="#" class="social-link tiktok">
                            <i class="bi bi-tiktok"></i>
                            <span>TikTok</span>
                        </a>
                        <a href="#" class="social-link zalo">
                            <i class="bi bi-chat-dots-fill"></i>
                            <span>Zalo</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="newsletter">
                        <h5 class="newsletter-title">Đăng ký nhận tin khuyến mãi</h5>
                        <form class="newsletter-form">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Nhập email của bạn..." required>
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-send-fill me-1"></i>
                                    Đăng ký
                                </button>
                            </div>
                        </form>
                        <p class="newsletter-note">
                            * Nhận thông báo về sản phẩm mới và ưu đãi đặc biệt
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="footer-bottom">
        <div class="container px-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright-text">
                        © {{ date('Y') }} MIMI Shop. Bản quyền thuộc về Minhcupy.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-badges">
                        <img src="{{ asset('img/payment/verifi_store.png') }}" alt="Verified Store" class="badge-img">
                        <img src="{{ asset('img/payment/trust_shop.jpg') }}" alt="Trusted Shop" class="badge-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Enhanced Footer Styles */
    .enhanced-footer {
        background: #1e2a78;
        /* xanh navy đậm */
        color: white;
        margin-top: auto;
        position: relative;
        overflow: hidden;
    }

    .enhanced-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.03)"/><circle cx="20" cy="80" r="0.5" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .footer-main {
        position: relative;
        z-index: 2;
        padding: 4rem 0 2rem;
    }

    .footer-section {
        height: 100%;
    }

    .footer-title {
        color: #ffd700;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, #ffd700, transparent);
    }

    /* Logo Section */
    .footer-logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .footer-logo-img {
        height: 35px;
        width: auto;
        filter: brightness(1.2);
    }

    .footer-brand-name {
        color: #ffd700;
        font-weight: 800;
        margin: 0;
        font-size: 1.3rem;
    }

    .footer-description {
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .footer-stats {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
    }

    .stat-item i {
        color: #ffd700;
        font-size: 1rem;
    }

    /* Contact Section */
    .contact-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .contact-item i {
        color: #ffd700;
        font-size: 1.1rem;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .contact-details strong {
        color: rgba(255, 255, 255, 0.95);
        font-size: 0.9rem;
        display: block;
        margin-bottom: 4px;
    }

    .contact-details p {
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .contact-details a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .contact-details a:hover {
        color: #ffd700;
    }

    /* Footer Links */
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .footer-links li {
        position: relative;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.9rem;
        line-height: 1.4;
        transition: all 0.3s ease;
        display: block;
        padding: 4px 0;
        position: relative;
    }

    .footer-links a::before {
        content: '▶';
        position: absolute;
        left: -15px;
        color: #ffd700;
        font-size: 0.7rem;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
    }

    .footer-links a:hover {
        color: #ffd700;
        padding-left: 15px;
    }

    .footer-links a:hover::before {
        opacity: 1;
        transform: translateX(0);
    }

    /* Payment Methods */
    .payment-methods {
        margin-top: 1.5rem;
    }

    .payment-title {
        color: rgba(255, 255, 255, 0.95);
        font-size: 0.9rem;
        margin-bottom: 0.8rem;
        font-weight: 600;
    }

    .payment-icons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .payment-icon {
        height: 25px;
        width: auto;
        border-radius: 4px;
        transition: transform 0.3s ease;
    }

    .payment-icon:hover {
        transform: scale(1.1);
    }

    /* Social Section */
    .footer-social {
        background: rgba(0, 0, 0, 0.2);
        padding: 2rem 0;
        position: relative;
        z-index: 2;
    }

    .social-title {
        color: #ffd700;
        font-weight: 700;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .social-links {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .social-link {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .social-link i {
        font-size: 1.1rem;
    }

    .social-link.facebook {
        background: #1877f2;
        color: white;
    }

    .social-link.youtube {
        background: #ff0000;
        color: white;
    }

    .social-link.instagram {
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        color: white;
    }

    .social-link.tiktok {
        background: #000;
        color: white;
    }

    .social-link.zalo {
        background: #0088ff;
        color: white;
    }

    .social-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        border-color: rgba(255, 255, 255, 0.3);
    }

    /* Newsletter */
    .newsletter-title {
        color: #ffd700;
        font-weight: 700;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .newsletter-form .input-group {
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .newsletter-form .form-control {
        border: none;
        padding: 12px 20px;
        background: rgba(255, 255, 255, 0.95);
    }

    .newsletter-form .form-control:focus {
        box-shadow: none;
        background: white;
    }

    .newsletter-form .btn {
        border: none;
        padding: 12px 20px;
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #333;
        font-weight: 600;
    }

    .newsletter-form .btn:hover {
        background: linear-gradient(135deg, #ffed4e, #ffd700);
        transform: translateY(-1px);
    }

    .newsletter-note {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.8rem;
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    /* Footer Bottom */
    .footer-bottom {
        background: rgba(0, 0, 0, 0.3);
        padding: 1.5rem 0;
        position: relative;
        z-index: 2;
    }

    .copyright-text {
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        font-size: 0.9rem;
    }

    .footer-badges {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .badge-img {
        height: 30px;
        width: auto;
        border-radius: 4px;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .badge-img:hover {
        opacity: 1;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-main {
            padding: 3rem 0 2rem;
        }

        .social-links {
            justify-content: center;
        }

        .footer-badges {
            justify-content: center;
            margin-top: 1rem;
        }

        .newsletter-form .input-group {
            flex-direction: column;
        }

        .newsletter-form .form-control {
            border-radius: 25px;
            margin-bottom: 10px;
        }

        .newsletter-form .btn {
            border-radius: 25px;
        }

        .payment-icons {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .social-links {
            gap: 0.5rem;
        }

        .social-link {
            font-size: 0.8rem;
            padding: 6px 12px;
        }

        .footer-stats {
            align-items: center;
            text-align: center;
        }
    }
</style>