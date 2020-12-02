@extends('Store.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{URL::to('/')}}"><i class="fa fa-home"></i>Home</a>
                    <span>{{$breadcrumb}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad" style="padding-top: 10px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-6">
                            <p> 1 của 10 kết quả</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-6">                                                   
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <div class="row">
                    @foreach($sp_trongloai as $row)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product-item">
                                <div class="pi-pic">
                                    <a href="{{URL::to('detail/'.$row->MaSP)}}">
                                        <img src="{{asset($row->urlHinh)}}" alt="{{$row->TenSP}}">
                                    </a>
                                    @if ($row->TinhTrang!="")
                                    <div class="sale pp-sale gia">
                                        {{($row->TinhTrang=="Het")?"Tạm hết":"Sale"}}
                                    </div>
                                   @else
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                   @endif
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">{{$row->TenSP}}</div>
                                    <b>{{number_format(($row->GiaBan),0,",",".")}}đ</b>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="loading-more">
                    <a href="">
                        {{$sp_trongloai->links()}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection