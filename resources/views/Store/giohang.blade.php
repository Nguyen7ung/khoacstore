@extends('Store.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Home</a>
                    <span>Giỏ hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<?php
    //if ($tongtien==0){
    //    echo "<br><br><h3 style='text-align: center'>Giỏ hàng hiện chưa có sản phẩm nào!</h3><br>";
   // }else{ 
?>
<section class="shopping-cart spad" style="padding-top: 10px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="capnhatGH.php?action=update">
                    <div class="cart-table">
                        <table id="table">
                            <thead>
                                <tr>
                                    <th>Hình</th>
                                    <th class="p-name">Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tiền</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>                               
                                <?php
                                /*
                                    if (isset($_SESSION['dathang'])){
                                        reset($_SESSION['dathang']);
                                        $tongtien = 0;
                                        for ($i = 0; $i< count($_SESSION['dathang']); $i++) {                                
                                            $DSDonHang = each($_SESSION['dathang']);
                                            $MaDH = $DSDonHang['key'];
                                            $dathang = $DSDonHang[1];
                                            //$dathang = each($_SESSION['dathang'])[1];
                                            $tien = $dathang['Gia']*$dathang['SL']; 
                                            $tongtien += $tien;*/
                                ?> 
                                @if(Session::has('donhang'))
                                    @foreach ($arr_donhang as $key => $value)
                                    <tr>
                                        <td class="cart-pic first-row"><img src="{{url($arr_donhang[$key][0]->urlHinh1)}}" width="100px" height="100px" alt="ao-khoac-nam"></td>
                                        <td class="cart-title first-row">
                                            <h5>{{$arr_donhang[$key][0]->TenSP}} / {{$arr_donhang[$key][0]->Size}}</h5>
                                        </td>
                                        <td class="p-price first-row">{{number_format($arr_donhang[$key][0]->GiaBan,0, ",",".")}} VND</td>
                                        <td class="qua-col first-row">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input  type="number" value="{{$arr_donhang[$key][0]->SL}}" name="capnhat[<?php //$MaDH;?>][]" onchange="soluongmoi(this)">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total-price first-row"><?php //number_format($tien,0, ",",".");?> VND</td>
                                        <td class="close-td first-row">
                                            <a href="{{URL::to('/delete-cart/'.$key)}}"><i class="ti-close"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                <?php// } } ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="#" class="primary-btn continue-shop">Mua sắm tiếp</a>
                                <button class="primary-btn up-cart">Cập nhật giỏ hàng</button>
                            </div>
                            <div class="discount-coupon">
                                <h6>Mã giảm giá</h6>
                                <form class="coupon-form">
                                    <input type="text" placeholder="Nhập mã">
                                    <button type="submit" class="coupon-btn">Xác nhận mã</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Phí vận chuyển <span>0 VND</span></li>
                                    <li class="cart-total">Tổng tiền <span id="tongtien"><?php // number_format($tongtien,0, ",",".");?> VND</span></li>
                                </ul>
                                <a href="thanh-toan/" class="proceed-btn">Thanh Toán</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php // } ?>
<!-- Shopping Cart Section End -->
<script>
var table =  document.getElementById("table");
var ID;
function soluong (x){
    alert(x.closest('tr').rowIndex);
}
function soluongmoi(x){
    var row = x.closest('tr').rowIndex;
    var gia =  table.rows[row].cells[2].innerHTML;
    var tien = $(x).val() * parseInt(gia.replace(/\./g,''), 10);
    table.rows[row].cells[4].innerHTML = (new Intl.NumberFormat().format(tien)) + " VND";
    var i, tongtien=0;
    for(i=1; i<table.rows.length; i++)
        tongtien += parseInt(table.rows[i].cells[4].innerHTML.replace(/\./g,''), 10);
    document.getElementById("tongtien").innerHTML = (new Intl.NumberFormat().format(tongtien)) + " VND";
}

$(document).ready(function() {   
    $(".pro-qty").on("click", function(){
        var row = this.closest('tr').rowIndex;
        var sl = $('.pro-qty').children('input').eq(row-1).val();
        var gia =  table.rows[row].cells[2].innerHTML;
        var tien = sl * parseInt(gia.replace(/\./g,''), 10);
        table.rows[row].cells[4].innerHTML = (new Intl.NumberFormat().format(tien)) + " VND";
        var i, tongtien=0;
        for(i=1; i<table.rows.length; i++)
            tongtien += parseInt(table.rows[i].cells[4].innerHTML.replace(/\./g,''), 10);
        document.getElementById("tongtien").innerHTML = (new Intl.NumberFormat().format(tongtien)) + " VND";
    });
});

</script>
@endsection