
@extends('front.layout.master')

@section('title', 'Tin tức')

@section('body')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="blog.html">Tin tức</a>
                        <span>Chi tiết</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Blog Details Section Begin -->
    <div class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-inner">
                        <div class="blog-detail-title">
                            <h2>{{ $blog->title }}</h2>
                            <p>{{ $blog->category }} <span>- {{ date('M d, Y', strtotime($blog->created_at)) }}</span></p>
                        </div>
                        <div class="blog-large-pic">
                            <img src="front/img/blog/{{ $blog->image ?? '' }}" alt="">
                        </div>
                        <div class="blog-detail-desc">
                            <p>{!! $blog->content !!}</p>
                        </div>
                        {{-- <div class="blog-more">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="img/daocatba.jpg" alt="">
                                </div>
                                <div class="col-sm-4">
                                    <img src="img/daohondau.jpg" alt="">                                
                                </div>
                                <div class="col-sm-4">
                                    <img src="img/doson.jpg" alt="">                                
                                </div>
                            </div>
                        </div> --}}
                        <div class="tag-share">
                            <div class="details-tag">
                                <ul>
                                    <li><i class="fa fa-tags"></i></li>
                                    <li>{{ $blog->category }}</li>
                                </ul>
                            </div>
                            <div class="blog-share">
                                <span>Chia sẻ:</span>
                                <div class="social-links">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-post">
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <a href="blog/{{ $preBlog->id }}" class="prev-blog">
                                        <div class="pb-pic">
                                            <i class="ti-arrow-left"></i>
                                            <img src="front/img/blog/{{ $preBlog->image ?? '' }}" alt="">
                                        </div>
                                        <div class="pb-text">
                                            <span>Bài đăng trước:</span>
                                            <h5>{{ $preBlog->title }}</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-5 col-md-6 offset-lg-2">
                                    <a href="blog/{{ $nextBlog->id }}" class="next-blog">
                                        <div class="nb-pic">
                                            <img src="front/img/blog/{{ $nextBlog->image ?? '' }}" alt="">
                                            <i class="ti-arrow-right"></i>
                                        </div>
                                        <div class="nb-text">
                                            <span>Bài đăng tiếp theo:</span>
                                            <h5>{{ $nextBlog->title }}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="posted-by">
                            <div class="pb-pic">
                                <img src="img/blog/post-by.png" alt="">
                            </div>
                            <div class="pb-text">
                                <a href="#">
                                    <h5>Yến Hải</h5>
                                </a>
                                <p>Khu du lịch Cát Bà Hải Phòng là nơi hòa quyện giữa rừng và biển, tạo nên một phong cảnh có một không hai.</p>
                            </div>
                        </div> --}}
                        <div class="leave-comment">
                            <h4>Bình luận</h4>
                            <form action="#" class="comment-form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <textarea placeholder="Nhập bình luận"></textarea>
                                        <button type="submit" class="site-btn">Gửi bình luận</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Details Section End -->

@endsection 