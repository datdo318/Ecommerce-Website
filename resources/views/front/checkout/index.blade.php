@extends('front.layout.master')

@section('title', 'Check Out')

@section('body')

    <!-- Shopping Cart Section Begin -->
    <div class="checkout-section spad">
        <div class="container">
            <form action="" method="post" class="checkout-form">
                @csrf

                <div class="row">
                    @if (Cart::count() > 0)
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <a href="./account/login" class="content-btn">Đăng nhập</a>
                            </div>
                            <h4>Hóa đơn chi tiết</h4>
                            <div class="row">

                                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id ?? '' }}">

                                <div class="col-lg-12">
                                    <label for="fir">Họ và tên <span>*</span></label>
                                    <input type="text" id="fir" name="first_name" value="{{ Auth::user()->name ?? '' }}" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="cun-name">Công ty</label>
                                    <input type="text" id="cun-name" name="company_name" value="{{ Auth::user()->company_name ?? '' }}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="cun">Quốc gia <span>*</span></label>
                                    <input type="text" id="cun" name="country" value="{{ Auth::user()->country ?? '' }}" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="street">Địa chỉ <span>*</span></label>
                                    <input type="text" id="street" class="street-first" name="street_address" value="{{ Auth::user()->street_address ?? '' }}" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="zip">Mã bưu điện / ZIP <span>*</span></label>
                                    <input type="text" id="zip" name="postcode_zip" value="{{ Auth::user()->postcode_zip ?? '' }}" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="town">Quận huyện / Thành phố<span>*</span></label>
                                    <input type="text" id="town" name="town_city" value="{{ Auth::user()->town_city ?? '' }}" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Địa chỉ Email<span>*</span></label>
                                    <input type="text" id="email" name="email" value="{{ Auth::user()->email ?? '' }}" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="phone">Số điện thoại<span>*</span></label>
                                    <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" required>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="create-item">
                                        <label for="acc-create">
                                            Tạo tài khoản?
                                            <input type="checkbox" id="acc-create">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <input type="text" name="" id="" placeholder="Mã giảm giá">
                            </div>
                            <div class="place-order">
                                <h4>Đơn hàng của bạn</h4>
                                <div class="order-total">
                                    <ul class="order-table">
                                        <li>Sản phẩm <span>Tổng cộng</span></li>

                                        @foreach ($carts as $cart)
                                            <li class="fw-normal">
                                                {{ $cart->name }} x {{ $cart->qty }}
                                                <span>đ{{ number_format($cart->price * $cart->qty, 0, ',', '.') }} </span>
                                            </li>
                                        @endforeach
                                        
                
                                        <li class="fw-normal">Tạm tính <span>đ{{ number_format($subtotal, 0, ',', '.') }}</span></li>
                                        <li class="total-price">Tổng cộng <span>đ{{ number_format($total, 0, ',', '.') }}</span></li>
                                    </ul>
                                    <div class="payment-check">
                                        <div class="pc-item">
                                            <label for="pc-check">
                                                Thanh toán khi nhận hàng
                                                    <input type="radio" name="payment_type" value="pay_later" id="pc-check" checked>
                                                    <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="pc-item">
                                            <label for="pc-paypal">
                                                Thanh toán qua thẻ
                                                    <input type="radio" name="payment_type" value="online_payment" id="pc-paypal">
                                                    <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="order-btn">
                                        <button type="submit" class="site-btn place-btn">Đặt hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <h4>Giỏ hàng của bạn trống.</h4>
                        </div>
                    @endif
                    
                </div>
            </form>
        </div>
    </div>
    <!-- Shopping Cart Section End -->

@endsection