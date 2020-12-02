@extends('Admin.index')
@section('content')
<style>
    div.dataTables_wrapper div.dataTables_filter input.form-control
    {
        border: 1px solid #999;
        height: 23px;
    }
    div.dataTables_wrapper div.dataTables_length select.form-control
    {
        border: 1px solid #999;
        height: 23px;
    }
</style>
<div class="container-fluid">
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2><u>Danh Sách Sản Phẩm Trưng Bày</u></h2>
                    <b>Cột "Mã Sản Phẩm" được hiển thị ở trang trưng bày, cột "Mô Tả" hiển thị ở trang chi tiết</b>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Ảnh Trưng Bày</th>                                                                            
                                    <th>Mã Sản Phẩm</th>                                                                            
                                    <th>Mô Tả</th>
                                    <th style="text-align: center">Thuộc Tính Khác</th>
                                    <th>Cập Nhật/Xóa</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($sanpham as $row)
                                <tr>
                                    <td>
                                        <img src="{{url('/'.$row->urlHinh)}}" width="100px" height="106px">
                                    </td>
                                    <td>
                                        <p>Mã: {{$row->MaSP}} </p>
                                        <p>Tên:{{$row->TenSP}}</p>
                                        <p>Màu trưng bày:{{$row->MauSac}}</p>
                                        <p>Giá bán: {{$row->GiaBan}}</p>
                                        <p>Tình trạng: {{$row->TinhTrang}}</p>
                                    </td>                                                                                     
                                    <td><?= $row['MoTa']; ?></td>
                                    <td>
                                        <p>Thứ tự: {{$row->ThuTu}}</p>
                                        <p>Đang: @if ($row['AnHien']==0) "Ẩn" @else "Hiện" @endif</p>
                                        <p>NCC: {{$row->MaNCC}}</p>
                                        <p><i>Ngày đăng: {{$row->NgayCapNhat}}</i></p>
                                    </td>                                           
                                    <td>
                                    <p>
                                        <form action="{{route('sanpham.destroy', $row->MaSP)}}" id="form_validation" method="POST" >                                             
                                            @csrf @method('DELETE')
                                            <a href="{{route('sanpham.edit', $row->MaSP)}}" class = "btn bg-blue waves-effect">Sửa</a>
                                            <input type="submit" class = "btn bg-blue waves-effect" value="Xóa" />
                                        </form>
                                    </p>
                                    <p>
                                        <a href="index.php?p=ctsanpham_ds&MaSP=<?=$row['MaSP']?>" class = "btn bg-red waves-effect">Xem Chi Tiết</a>
                                    </p>
                                    </td>                                         
                                </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JQuery DataTable Css -->
<!-- JQuery DataTable Css -->
<link href="{{asset('admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- JQuery DataTable Css -->
<link href="{{asset('admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
<!-- Custom Js -->
<script src="js/pages/tables/jquery-datatable.js"></script>
@endsection