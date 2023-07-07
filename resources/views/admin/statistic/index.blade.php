@extends('admin.layout.master')

@section('title', 'Statistic')

@section('body')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="container-fluid">
            <p class="title_statistic">Thống kê đơn hàng doanh số</p>
                <form action="" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                        </div>
                        <div class="col-md-2">
                            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                        </div>
        
                        <div class="col-md-2">
                            <p>Lọc theo:
                                <select class="dashboard-filter form-control">
                                    <option>--Chọn--</option>
                                    <option value="7ngay">7 ngày qua</option>
                                    <option value="thangtruoc">tháng trước</option>
                                    <option value="thangnay">tháng này</option>
                                    <option value="365ngayqua">365 ngày qua</option>
                                </select>
                            </p>
                        </div>
        
                        <div class="col-md-12">
                            <div id="myfirstchart" style="height: 250px;"></div>
                        </div>
                    </div>
                    
                </form>
            <div class="row">
                
            </div>

            <div class="row">

            </div>

            <div class="row">
                
            </div>
        </div>
    </div>
    <!-- End Main -->

@endsection