@extends('Store.layout')
@section('content')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        <div class="single-hero-items set-bg" data-setbg="img/slideshow_1.webp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <span>Áo thun</span>
                        <h1>Ưu đãi HOT</h1>
                        <p>Nhiều mẫu áo thun đa dạng, hợp xu hướng.</p>                        
                    </div>
                </div>

            </div>
        </div>
        <div class="single-hero-items set-bg" data-setbg="img/slideshow_2.webp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <span>Áo khoác</span>
                        <h1>Chất vải tốt</h1>
                         <p>Mang đến cảm giác thoải mái nhất khi vận động, chất vải bền bỉ với thời gian</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
<!-- Deal Of The Week Section Begin-->
<section class="deal-of-week set-bg spad" data-setbg="img/ao-khoac-nam-giam-gia.jpg">
    <div class="container">
        <div class="col-lg-6 text-center">
            <div class="section-title">
                <h2>Sản phẩm giảm giá <span style="color: #00E676 ">30%</span></h2>
                <div class="product-price">
                    350.000đ
                    <span>/ áo</span>
                </div>
            </div>
            <div class="countdown-timer" id="countdown">
                <div class="cd-item">
                    <span>56</span>
                    <p>Days</p>
                </div>
                <div class="cd-item">
                    <span>12</span>
                    <p>Hrs</p>
                </div>
                <div class="cd-item">
                    <span>40</span>
                    <p>Mins</p>
                </div>
                <div class="cd-item">
                    <span>52</span>
                    <p>Secs</p>
                </div>
            </div>
            <a href="#" class="primary-btn">Đặt hàng ngay!</a>
        </div>
    </div>
</section>
<!-- Deal Of The Week Section End -->
<section class="man-banner spad">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 style="text-align: center">Sản phẩm mới</h3>
            <div class="product-slider owl-carousel">
                @foreach($sanphammoi as $row)
                <div class="product-item">
                    <div class="pi-pic">
                    <a href="{{URL::to('detail/'.$row->MaSP)}}">
                        <img src="{{ $row->urlHinh }}" alt="{{ $row->TenSP }}">
                    </a>
                        <div class="sale">Sale</div>
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            <li class="w-icon active"><a href="capnhatGH.php?action=add&MaSP=MaSP&MaMau=MaMau&MauSac=MauSac"><i class="icon_bag_alt"></i></a></li>
                            <li class="quick-view"><a href="TenLH_KhongDau/TenPL_KhongDau-MaSP">+ Quick View</a></li>
                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">{{ $row->TenSP }}</div>
                        <b><?=number_format($row->GiaBan,0,",","."); ?>đ</b>
                    </div>
                </div>                     
                @endforeach
            </div>
        </div>
    </div>
</div>
</section>
  <!-- Instagram Section Begin -->
    <div class="instagram-photo">
        <div class="insta-item set-bg" data-setbg="img/home-1.webp">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/home-2.webp">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/home-3.webp">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/home-4.webp">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/home-5.webp">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/home-6.webp">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
    </div>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            
            <div class="benefit-items">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="img/icon-1.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Miễn phí giao hàng</h6>
                                <p>Cho đơn hàng trên 500k</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="img/icon-2.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Thời gian giao hàng</h6>
                                <p>Nhanh chóng trong 48h</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="img/icon-3.png" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Thanh toán</h6>
                                <p>Khi nhận hàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection