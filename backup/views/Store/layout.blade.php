<?php
    //session_start();
    if (isset($_GET['p']))
        $page = $_GET['p'];
    if (!isset($_SESSION['dathang'])) 
        $_SESSION['dathang']=array();         
    $tongtien = 0;
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Chuyên các sản phẩm áo khoác nam và áo khoác thương hiệu cao cấp. Chất liệu vải cao cấp thoáng mát, tạo cảm giác thoải mái khi mặc">
    <meta name="keywords" content="áo khoác nam, áo thun nam, túi đeo nam, quần lót nam">
    <link rel="alternate" hreflang="vi-vn" href="https://khoac.store/" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cửa hàng áo khoác nam, áo thun và túi đeo nam</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('img/ao-khoac-nam-lg.png')}}" />

    <!-- Css Styles -->

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Thêm thư viện Jquery 3.5.1 cho sự kiện click -->

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class="fa fa-envelope"></i>
                            cskh@khoac.store                   
                    </div>
                    <div class="phone-service">
                        <i class="fa fa-phone"></i>
                        0901.888.712
                    </div>
                </div>
                <div class="ht-right">
                    <a href="dang-nhap/" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    <div class="lan-selector">
                        <select class="language_drop" name="countries" id="countries" style="width:300px;">
                            <option value='yt' data-image="{{asset('img/flag-vie.png')}}" data-imagecss="flag yt"
                                data-title="VietNam">Vie</option>
                            <option value='yu' data-image="img/flag-eng.jpg" data-imagecss="flag yu"
                                data-title="{{asset('English')}}">Eng</option>
                        </select>
                    </div>
                    <div class="top-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="{{URL::to('/')}}"><h2>K̳H̳O̳A̳C̳</h2></a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">Tìm sản phẩm</button>
                            <div class="input-group">
                                <input type="text" placeholder="Gõ từ khóa của bạn">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            
                            <li class="cart-icon">
                                <a href="gio-hang/">
                                    <i class="icon_bag_alt"></i>
                                    <span><?php echo count($_SESSION['dathang']);?></span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                            <?php 
                                                if (count($_SESSION['dathang'])>0){
                                                    for ($i = 0; $i< count($_SESSION['dathang']); $i++) {                                
                                                        $dathang = each($_SESSION['dathang'])[1];
                                                        $tien = $dathang['Gia']*$dathang['SL']; 
                                                        $tongtien += $tien;
                                            ?>
                                                <tr>
                                                    <td class="si-pic"><img src="<?=$dathang['Hinh'];?>" width="100px" height="100px" alt=""></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p><?=number_format($dathang['Gia'],0, ",",".");?> x <?=$dathang['SL'];?></p>
                                                            <h6><?=$dathang['Ten'];?></h6>
                                                        </div>
                                                    </td>                                                   
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5><?=number_format($tongtien,0, ",",".");?> VND</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="gio-hang/" class="primary-btn view-card">Xem giỏ hàng</a>
                                        <a href="thanh-toan/" class="primary-btn checkout-btn">Thanh Toán</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price"><?=number_format($tongtien,0, ",",".");?>đ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="nav-item">
            @include('Store.menu')
        </div>
    </header>
    <!-- Header End -->
    @yield('content')
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="https://<?=$_SERVER['HTTP_HOST'];?>"><h4 style="color:white">K̳H̳O̳A̳C̳</h4></a>
                        </div>                       
                        <ul>
                            <li>Địa chỉ: 220 Đặng Văn Bi, P. Trường Thọ, Thủ Đức, HCM.</li>
                            <li>Phone 1: 0901.888.712</li>
                            <li>Phone 2: 0901.447.369</li>
                            <li>Email: cskh@khoac.store</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Thông tin công ty</h5>
                        <ul>
                            <li><a href="ve-chung-toi/">Về chúng tôi</a></li>
                            <li><a href="cua-hang/">Hệ thống cửa hàng</a></li>
                            <li><a href="lien-he/">Liên hệ</a></li>
                            <li><a href="tuyen-dung/">Tuyển dụng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>Hỗ trợ khách hàng</h5>
                        <ul>
                            <li><a href="chinh-sach-doi-tra/">Chính sách đổi trả</a></li>
                            <li><a href="chinh-sach-bao-hanh/">Chính sách bảo hành</a></li>
                            <li><a href="khach-hang-than-thiet/">Khách hàng thân thiết</a></li>
                            <li><a href="huong-dan-chon-size/">Hướng dẫn chọn size</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Kết nối với chúng tôi</h5>
                        <p>Đăng ký để nhận thông tin về sản phẩm mới và các chương trình giảm giá.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Đăng ký</button>
                        </form><br>                  
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" style="align: center">
                        <div class="copyright-text">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js"')}}"></script>
    <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('js/jquery.dd.min.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    
</body>

</html>

