@extends('admin.layout.master')

@section('title', 'Order')

@section('body')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Order
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body display_data">

                        <div class="table-responsive">
                            <h2 class="text-center">Danh sách sản phẩm đã đặt</h2>
                            <hr>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Giá</th>
                                        <th class="text-center">Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($order->orderDetails as $orderDetail)
                                        <tr>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img style="height: 60px;"
                                                                    data-toggle="tooltip" title="Image"
                                                                    data-placement="bottom"
                                                                    src="front/img/products/{{ $orderDetail->product->productImages[0]->path }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $orderDetail->product->name }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ $orderDetail->qty }}
                                            </td>
                                            <td class="text-center">đ{{ number_format($orderDetail->amount, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                đ{{ number_format($orderDetail->total, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                   

                                </tbody>
                            </table>
                        </div>



                        <h2 class="text-center mt-5">Thông tin đơn hàng</h2>
                        <hr>
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">
                                Tên người đặt
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->first_name . ' ' . $order->last_name }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->email }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="phone" class="col-md-3 text-md-right col-form-label">Số điện thoại</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->phone }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="company_name" class="col-md-3 text-md-right col-form-label">
                                Công ty
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->company_name }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="street_address" class="col-md-3 text-md-right col-form-label">
                                Địa chỉ</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->street_address }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="town_city" class="col-md-3 text-md-right col-form-label">
                                Thành phố</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->town_city }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="country"
                                class="col-md-3 text-md-right col-form-label">Quốc gia</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->country }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="postcode_zip" class="col-md-3 text-md-right col-form-label">
                                Mã bưu điện</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->postcode_zip }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="payment_type" class="col-md-3 text-md-right col-form-label">Hình thức thanh toán</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->payment_type }}</p>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="status" class="col-md-3 text-md-right col-form-label">Trạng thái</label>
                            <div class="col-md-9 col-xl-8">
                                <div class="badge badge-dark mt-2">
                                    {{ \App\Utilities\Constant::$order_status[$order->status]}}
                                </div>
                            </div>
                        </div>

                        <form action="admin/order/{{ $order->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="position-relative row form-group">
                                <label for="status_order" class="col-md-3 text-md-right col-form-label">Cập nhật trạng thái đơn hàng</label>
                                <div class="col-md-5 col-xl-4">
                                    <select required name="status_order" id="status_order" class="form-control">
                                        
                                        <option value="">-- Trạng thái --</option>
                                        <option value="1">
                                            Đã thanh toán
                                        </option>
                                        <option value="2">
                                            Chờ xác nhận
                                        </option>
                                        <option value="3">
                                            Đang vận chuyển
                                        </option> 
                                        <option value="4">
                                            Đã nhận được hàng
                                        </option>   
                                        <option value="5">
                                            Đã hủy đơn hàng
                                        </option>                                      
                                    </select>
                                </div>
                                {{-- <input type="hidden" name="order_id" value="{{ $order->id }}"> --}}
                                <div class="col-md-3 col-xl-2">
                                    <button type="submit"
                                        class="btn-shadow btn-hover-shine btn btn-primary">
                                        <span class="btn-icon-wrapper pr-2 opacity-8">
                                            <i class="fa fa-download fa-w-20"></i>
                                        </span>
                                        <span>Lưu lại</span>
                                    </button>
                                </div>
                            </div>                
                        </form>

                        <div class="position-relative row form-group">
                            <label for="description"
                                class="col-md-3 text-md-right col-form-label">Mô tả</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{ $order->description }}</p>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-md-9 col-xl-8 offset-md-2">
                                <a href="/admin/order/print-order/{{ $order->id }}"
                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-download fa-w-20"></i>
                                    </span>
                                    <span>In đơn hàng</span>
                                </a>
                            </div>
                            
                            {{-- <a href="/admin/order/print-order">In đơn hàng</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->

@endsection