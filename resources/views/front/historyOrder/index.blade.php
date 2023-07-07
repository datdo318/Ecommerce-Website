@extends('front.layout.master')
@section('title', 'History Order')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Lịch sử đơn hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->


    <section class="women-banner spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="history-order">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li><a class="active" href="#tab-1" data-toggle="tab" role="tab">Tất cả</a></li>
                                <li><a href="#tab-2" data-toggle="tab" role="tab">Chờ xử lý</a></li>
                                <li><a href="#tab-3" data-toggle="tab" role="tab">Đang vận chuyển</a></li>
                                <li><a href="#tab-4" data-toggle="tab" role="tab">Hoàn thành</a></li>
                                <li><a href="#tab-5" data-toggle="tab" role="tab">Đã hủy</a></li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    @if ($orders->count() > 0)
                                        @foreach ($orders as $order)
                                            @foreach ($order->orderDetails as $all)
                                            <div class="history-order-content">
                                                <div class="history-order-image">
                                                    <img src="front/img/products/{{ $all->product->productImages[0]->path }}" alt="">
                                                </div>
                                                <div class="history-order-des">
                                                    <div class="history-order-name">
                                                        <h5>{{ $all->product->name }}</h5>
                                                    </div>
                                                    <div class="history-order-tag">
                                                        <p>Phân loại hàng: <span>{{ $all->product->vn_tag }}</span></p>
                                                    </div>
                                                    <div class="history-order-quantity">
                                                        <p>x <span>{{ $all->qty }}</span> </p>
                                                    </div>
                                                </div>
                                                <div class="history-order-price">
                                                    <p>Thành tiền: <span>₫{{ number_format($all->total, 0, ',', '.') }}</span></p>
                                                </div>
                                            </div> 
                                            @endforeach
                                            <div class="history-order-bottom">
                                                @if ($order->status == 1 || $order->status == 2)
                                                    <button type="submit" class="primary-btn">Hủy đơn hàng</button>                                                     
                                                @else
                                                    <button type="submit" class="primary-btn">Liên hệ với người bán</button>                                                                                                     
                                                @endif
                                                <div class="history-order-total">
                                                    <p>Tổng cộng: <span>₫{{ number_format(array_sum(array_column($order->orderDetails->toArray(), 'total')), 0, ',', '.') }}</span></p>
                                                </div>  
                                            </div>                                             
                                        @endforeach
                                   @else
                                        <div class="history-order-empty">
                                            <h2>Chưa có đơn hàng</h2>
                                        </div> 
                                   @endif                                                                   
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    @if ($processing->count() > 0)
                                        @foreach ($processing as $order)                                            
                                            <form action="/historyorder/{{ $order->id }}" method="GET">
                                                @csrf
                                                @foreach ($order->orderDetails as $all)
                                                    <div class="history-order-content">
                                                        <div class="history-order-image">
                                                            <img src="front/img/products/{{ $all->product->productImages[0]->path }}" alt="">
                                                        </div>
                                                        <div class="history-order-des">
                                                            <div class="history-order-name">
                                                                <h5>{{ $all->product->name }}</h5>
                                                            </div>
                                                            <div class="history-order-tag">
                                                                <p>Phân loại hàng: <span>{{ $all->product->vn_tag }}</span></p>
                                                            </div>
                                                            <div class="history-order-quantity">
                                                                <p>x <span>{{ $all->qty }}</span> </p>
                                                            </div>
                                                        </div>
                                                        <div class="history-order-price">
                                                            <p>Giá tiền: <span>₫{{ number_format($all->total, 0, ',', '.') }}</span></p>
                                                        </div>
                                                    </div> 
                                                @endforeach
                                                <div class="history-order-bottom">
                                                    <button type="submit" class="primary-btn">Hủy đơn hàng</button>  
                                                    <div class="history-order-total">
                                                        <p>Tổng cộng: <span>₫{{ number_format(array_sum(array_column($order->orderDetails->toArray(), 'total')), 0, ',', '.') }}</span></p>
                                                    </div>  
                                                </div>                                                 
                                            </form>                                            
                                        @endforeach
                                   @else
                                        <div class="history-order-empty">
                                            <h2>Chưa có đơn hàng</h2>
                                        </div> 
                                   @endif                                          
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    @if ($shipping->count() > 0)
                                        @foreach ($shipping as $order)
                                            <div class="history-order-content">
                                                <div class="history-order-image">
                                                    <img src="front/img/products/{{ $order->orderDetails[0]->product->productImages[0]->path }}" alt="">
                                                </div>
                                                <div class="history-order-des">
                                                    <div class="history-order-name">
                                                        <h5>{{ $order->orderDetails[0]->product->name }}</h5>
                                                    </div>
                                                    <div class="history-order-tag">
                                                        <p>Phân loại hàng: <span>{{ $order->orderDetails[0]->product->vn_tag }}</span></p>
                                                    </div>
                                                    <div class="history-order-quantity">
                                                        <p>x <span>{{ $order->orderDetails[0]->qty }}</span> </p>
                                                    </div>
                                                </div>
                                                <div class="history-order-price">
                                                    <p>Thành tiền: <span>₫{{ number_format(array_sum(array_column($order->orderDetails->toArray(), 'total')), 0, ',', '.') }}</span></p>
                                                </div>
                                            </div> 
                                            <button type="submit" class="primary-btn">Hủy đơn hàng</button>     
                                        @endforeach
                                    @else
                                        <div class="history-order-empty">
                                            <h2>Chưa có đơn hàng</h2>
                                        </div> 
                                    @endif                 
                                </div>
                                <div class="tab-pane fade" id="tab-4" role="tabpanel">
                                    @if ($receiveOrders->count() > 0)
                                        @foreach ($receiveOrders as $order)
                                            <div class="history-order-content">
                                                <div class="history-order-image">
                                                    <img src="front/img/products/{{ $order->orderDetails[0]->product->productImages[0]->path }}" alt="">
                                                </div>
                                                <div class="history-order-des">
                                                    <div class="history-order-name">
                                                        <h5>{{ $order->orderDetails[0]->product->name }}</h5>
                                                    </div>
                                                    <div class="history-order-tag">
                                                        <p>Phân loại hàng: <span>{{ $order->orderDetails[0]->product->vn_tag }}</span></p>
                                                    </div>
                                                    <div class="history-order-quantity">
                                                        <p>x <span>{{ $order->orderDetails[0]->qty }}</span> </p>
                                                    </div>
                                                </div>
                                                <div class="history-order-price">
                                                    <p>Thành tiền: <span>₫{{ number_format(array_sum(array_column($order->orderDetails->toArray(), 'total')), 0, ',', '.') }}</span></p>
                                                </div>
                                            </div>                                                  
                                        @endforeach
                                    @else
                                        <div class="history-order-empty">
                                            <h2>Chưa có đơn hàng</h2>
                                        </div> 
                                    @endif         
                                </div>
                                <div class="tab-pane fade" id="tab-5" role="tabpanel">
                                    @if ($cancel->count() > 0)
                                        @foreach ($cancel as $order)
                                            <div class="history-order-content">
                                                <div class="history-order-image">
                                                    <img src="front/img/products/{{ $order->orderDetails[0]->product->productImages[0]->path }}" alt="">
                                                </div>
                                                <div class="history-order-des">
                                                    <div class="history-order-name">
                                                        <h5>{{ $order->orderDetails[0]->product->name }}</h5>
                                                    </div>
                                                    <div class="history-order-tag">
                                                        <p>Phân loại hàng: <span>{{ $order->orderDetails[0]->product->vn_tag }}</span></p>
                                                    </div>
                                                    <div class="history-order-quantity">
                                                        <p>x <span>{{ $order->orderDetails[0]->qty }}</span> </p>
                                                    </div>
                                                </div>
                                                <div class="history-order-price">
                                                    <p>Thành tiền: <span>₫{{ number_format(array_sum(array_column($order->orderDetails->toArray(), 'total')), 0, ',', '.') }}</span></p>
                                                </div>
                                            </div> 
                                            <a style="color: white;margin-left: 30px" href="./shop/product/{{ $order->orderDetails[0]->product->id }}" class="primary-btn">Mua lại</a>     
                                        @endforeach
                                    @else
                                        <div class="history-order-empty">
                                            <h2>Chưa có đơn hàng</h2>
                                        </div> 
                                    @endif                 
                                </div>
                            </div>
                        </div>
                    </div>                  
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection