@extends('Store.layout')
@section('content')
<style>
    .product-details .pd-color .pd-color-choose .cc-item label.Den {background: black;}
    .product-details .pd-color .pd-color-choose .cc-item label.XanhDuong {background: blue;}
    .product-details .pd-color .pd-color-choose .cc-item label.XanhDaTroi {background: SkyBlue;}
    .product-details .pd-color .pd-color-choose .cc-item label.XanhDen {background: MidnightBlue;}

    .product-details .pd-color .pd-color-choose .cc-item label.Trang {background: ghostwhite;}
    .product-details .pd-color .pd-color-choose .cc-item label.Do {background: red;}
    .product-details .pd-color .pd-color-choose .cc-item label.Vang {background: yellow;}
    .product-details .pd-color .pd-color-choose .cc-item label.XanhLa {background: green;}
    .product-details .pd-color .pd-color-choose .cc-item label.XanhLaNhat {background: lightgreen;}

    .product-details .pd-color .pd-color-choose .cc-item label.Xam {background: gray;}
    .product-details .pd-color .pd-color-choose .cc-item label.XamNhat {background: lightgray;}

    .product-details .pd-color .pd-color-choose .cc-item label.Hong {background: pink;}
    .product-details .pd-color .pd-color-choose .cc-item label.Cam {background: orange;}
    .product-details .pd-color .pd-color-choose .cc-item label.Nau {background: brown;}
    .product-details .pd-color .pd-color-choose .cc-item label.Tim {background: violet;}
    .product-details .pd-color .pd-color-choose .cc-item label.XanhDaTroi {background: BlueViolet;}

</style>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-text product-more">
                <a href="{{URL::to('/')}}"><i class="fa fa-home"></i>Home</a>
                <a href="{{URL::to('/')}}">Detail</a>
                <span>{{$chitiet_sp->MaSP}}</span>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details" style="padding-top: 10px">
<div class="container">
    <div class="row">

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-pic-zoom">
                       <img class="product-big-img" src="{{url($DSHinh['urlHinh1'])}}" alt="">
                            <div class="zoom-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                    </div>
                    <?php if(in_array("", $DSHinh, TRUE) or in_array(NULL, $DSHinh, TRUE)){?>
                    <div></div>
                    <?php }else{ ?>
                    <div class="product-thumbs">
                        <div class="product-thumbs-track ps-slider owl-carousel">                            
                                @foreach($DSHinh as $row)
                                    <div class="pt" data-imgbigurl="{{url($row)}}">
                                        <img src="{{url($row)}}" alt="ao-khoac-nam">
                                    </div>
                                @endforeach
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-lg-6">

                    <div class="product-details" style="float: right">
                        <div class="pd-title">
                            <h4>{{$chitiet_sp->TenSP}}</h4>
                            <div class="p-code">Code: {{$chitiet_sp->MaSP}}</div>
                        </div>

                        <div class="pd-desc">
                            <h4>{{number_format($chitiet_sp->GiaBan,0,",",".")}} đ</h4>
                        </div>
                        <form method="POST" id="form_validation" action="{{URL::to('/add-cart')}}">
                        @csrf
                        <div class="pd-color">
                            <h6>Color</h6>
                            <div class="pd-color-choose">
                                <input name="MaSP" type="hidden"  value="{{$chitiet_sp->MaSP}}" />
                                @foreach($DSMau as $row)
                                <div class="cc-item">                               
                                    <input type="radio" id="{{$row->MauSac}}" value="{{$row->MauSac}}" name="MauSac" onclick="ChonMau(this)" @if ($row->MauSac == $chitiet_sp->MauSac) checked @else @endif>
                                    <input type="radio" value="{{$row->MaMau}}" name="MaMau" @if ($row->MaMau==$chitiet_sp->MaMau) checked @else @endif>
                                    <label for="{{$row->MauSac}}" class="{{$row->MauSac}}" @if ($row->MauSac == $chitiet_sp->MauSac) style='outline: black solid 1px;' @else @endif ></label>
                                </div>
                                @endforeach
                            </div>                                          
                        </div>
                        <div class="pd-size-choose">
                            <div class="sc-item">
                                <input type="radio" id="sm-size" value="S" name="Size">
                                <label for="sm-size">s</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="md-size" value="M" name="Size">
                                <label for="md-size">m</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="lg-size" value="L" name="Size">
                                <label for="lg-size">l</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="xl-size" value="XL" name="Size">
                                <label for="xl-size">xl</label>
                            </div>
                        </div>
                        <div class="quantity">
                            <div class="pro-qty">
                                <input  type="number" value="1" name="SL">
                            </div>
                            <button type="submit" class="primary-btn pd-cart" style="border:0px"> Thêm vào giỏ hàng</button>
                        </div>
                        </form>
                        <div class="pd-desc">
                            <b> Mô tả sản phẩm</b><br>
                            {{$chitiet_sp->MoTa}}
                        </div>
                        <div id = 'msg'></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Product Shop Section End -->

<!-- Related Products Section End -->
<div class="related-products spad">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h2>Sản Phẩm Liên Quan</h2>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($sp_lienquan as $row)
        <div class="col-lg-3 col-6">          
            <div class="product-item">              
                <div class="pi-pic">
                    <a href="{{URL::to('detail/'.$row->MaSP)}}"><img src="{{url($row->urlHinh)}}" alt=""></a>
                    <div class="sale">Sale</div>
                    <div class="icon">
                        <i class="icon_heart_alt"></i>
                    </div>                  
                </div>
                <div class="pi-text">
                    <div class="catagory-name">{{$row->TenSP}}</div>
                    <b>{{number_format($row->GiaBan,0,",",".")}}đ</b>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
<script>
function ChonMau(x){
    var MaSP = {!! json_encode($chitiet_sp->MaSP) !!};
    var MauSac = $(x).val();
    $.ajax({
                type: 'POST',
                url: '{{ route('ajax.anh') }}',
                data: {
                   '_token':'{{csrf_token()}}',
                   'MaSP': MaSP,
                   'MauSac': MauSac,
               },
                success: function(data) {
                    var hinh_arr = JSON.parse(data);
                    var i; 
                    var label_class = $(x).val();   
                    //var x1 = x.parentNode.lastChild.nodeValue;
                    $(x).next().prop('checked', true);
                    $('label').removeAttr("style");
                    $('label.'+label_class).css("outline", "1px solid black");
                    $(".product-big-img").attr({src: "http://laravel.khoac/"+hinh_arr[0]});
                    $('.zoomImg').attr({src: "http://laravel.khoac/"+hinh_arr[0]});

                    for (i = 0; i<hinh_arr.length; i++){
                        $('.product-thumbs .pt').eq(i).data('imgbigurl', "http://laravel.khoac/"+hinh_arr[i]);
                        $('.pt').children('img').eq(i).attr("src", "http://laravel.khoac/"+hinh_arr[i]);
                    }
               }
            });
}
</script>
