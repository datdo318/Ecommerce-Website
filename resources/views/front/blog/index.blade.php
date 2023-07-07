
@extends('front.layout.master')

@section('title', 'Tin tức')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Tin tức</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                    <div class="blog-sidebar">
                        <div class="search-form">
                            <h4>Search</h4>
                            <form action="#">
                                <input type="text" placeholder="Tìm kiếm...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="blog-catagory">
                            <h4>Danh mục</h4>
                            <ul>
                                <li><a href="">Du lịch</a></li>
                                <li><a href="">Hiện đại</a></li>
                            </ul>
                        </div>
                        <div class="recent-post">
                            <h4>Bài viết gần đây</h4>
                            <div class="recent-blog">
                                @foreach ($recentPosts as $recentPost)
                                <a href="blog/{{ $recentPost->id }}" class="rb-item">
                                    <div class="rb-pic">
                                        <img src="front/img/blog/{{ $recentPost->image ?? '' }}" alt="">
                                    </div>
                                    <div class="rb-text">
                                        <h6>{{ $recentPost->title }}</h6>
                                        <p> {{$recentPost->user->name}} <span>- {{ date('M d, Y', strtotime($recentPost->created_at)) }}</span></p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-lg-6 col-sm-6">
                                <div class="blog-item">
                                    <div class="bi-pic">
                                        <img src="front/img/blog/{{ $blog->image ?? '' }}" alt="">
                                    </div>
                                    <div class="bi-text">
                                        <a href="blog/{{ $blog->id }}">
                                            <h4>{{ $blog->title }}</h4>
                                        </a>
                                        <p>{{ $blog->category }} <span>- {{ date('M d, Y', strtotime($blog->created_at)) }}</span></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection 