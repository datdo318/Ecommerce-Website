@extends('front.layout.master')

@section('title', 'Cart')

@section('body')
    <!-- Shopping Cart Section Begin -->
    <div class="shopping-cart spad">
        <div class="container">
            <div class="row">

                @if (Cart::count() > 0)
                    <div class="col-lg-12">
                        <div class="cart-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th class="p-name">Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng cộng</th>    
                                        <th><i onclick="confirm('Bạn có chắc chắn muốn xóa chứ?') === true ? destroyCart() : ''" 
                                        style="cursor: pointer;" class="ti-close"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr data-rowId="{{ $cart->rowId }}">
                                            <td class="cart-pic first-row"><img src="front/img/products/{{ $cart->options->images[0]->path }}" alt=""></td>
                                            <td class="cart-title first-row">
                                                <h5>{{ $cart->name }}</h5>
                                            </td>
                                            <td class="p-price first-row">đ{{ number_format($cart->price, 0, ',', '.') }}</td>
                                            <td class="qua-col first-row">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" value="{{ $cart->qty }}" data-rowid="{{ $cart->rowId }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="total-price first-row">đ{{ number_format($cart->price * $cart->qty, 0, ',', '.') }}</td>
                                            <td class="close-td first-row">
                                                <i onclick="removeCart('{{ $cart->rowId }}')" class="ti-close"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                    

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="cart-buttons">
                                    <a href="#" class="primary-btn continue-shop up-cart">Tiếp tục mua hàng</a>
                                    {{-- <a href="#" class="primary-btn up-cart">Cập nhật giỏ hàng</a> --}}
                                </div>
                                {{-- <div class="discount-coupon">
                                    <h6>Mã giảm giá</h6>
                                    <form action="#" class="coupon-form">
                                        <input type="text" placeholder="Nhập mã">
                                        <button type="submit" class="site-btn coupon-btn">Áp dụng</button>
                                    </form>
                                </div> --}}
                            </div>
                            <div class="col-lg-4 offset-lg-4">
                                <div class="proceed-checkout">
                                    <ul>
                                        <li class="subtotal">Tổng phụ <span>đ{{ number_format($subtotal, 0, ',', '.') }}</span></li>
                                        <li class="cart-total">Tổng cộng <span>đ{{ number_format($total, 0, ',', '.') }}</span></li>
                                    </ul>
                                    <a href="./checkout" class="proceed-btn">Thanh toán</a>
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
        </div>
    </div>
    <!-- Shopping Cart Section End -->

@endsection