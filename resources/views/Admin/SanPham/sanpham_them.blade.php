@extends('Admin.index')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<style>
.form-group {margin-bottom:15px;}
.form-group .form-line {border-bottom:none}
.form-group .form-control {padding:3px; border:1px solid #999;}
.form-group .form-line.abc {padding-top:5px;}
.form-group .form-control{ background: #337ab7; 
              border-radius: 6px; color:yellow; font-size:14px;letter-spacing:1px}
.form-group .form-control::placeholder {color:white}
#form_validation .col-md-4  {margin-bottom:0px;}

</style>
<div class="row clearfix">
    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" style="margin:auto; float:none">
        <div class="card">
            <div class="header">
                <h2><u>Thêm Sản Phẩm Mới</u></h2>
                <b>Dữ liệu sau khi thêm sẽ hiển thị ở phần trưng bày</b>
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
                <form action="{{route('sanpham.store')}}" id="form_validation" method="POST" >   
                    @csrf
                    <div class="row cleafix">                   
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"> 
                            <div class="form-line">
                                <select class="form-control show-tick" name="MaLH" id="MaLH">
                                    <option value="0">-- Chọn Menu cấp 1 --</option>
                                    @foreach ($loaihang as $row)
                                        <option value="{{ $row->MaLH }}">{{ $row->TenLH }}</option>
                                    @endforeach
                                </select>
                            </div>                         
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"> 
                            <div class="form-line">
                                <select class="form-control show-tick" name="MaPL" id="MaPL">
                                    <option value="0">-- Chọn Menu cấp 2 --</option>
                                    <option value="cc"</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6"> 
                            <input type="text" class="form-control" id="MaSP" name="MaSP" placeholder="Mã sản phẩm">
                        </div>
                       <div class="col-lg-4 col-md-3 col-sm-6 col-xs-6"> 
                            <div class="form-line">
                                <input type="text" name="TenSP" class="form-control" placeholder="Nhập tên sản phẩm">
                            </div>
                        </div>
                    </div><br>

                    <div class="row clearfix">                                                           
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                           <select class="form-control show-tick" name="MauSac" id="MauSac">
                                <option value="0">-- Màu Trưng Bày --</option>
                                <option value="Den">Đen</option>
                                <option value="Trang">Trắng</option>
                                <option value="XanhDuong">Xanh dương</option>
                                <option value="XanhDaTroi">Xanh da trời</option>
                                <option value="XanhDen">Xanh đen</option>
                                <option value="Do">Đỏ</option>
                                <option value="vang">Vàng</option>
                                <option value="XanhLa">Xanh lá</option>
                                <option value="XanhLaNhat">Xanh lá nhạt</option>
                                <option value="Xam">Xám</option>
                                <option value="XamNhat">Xám nhạt</option>
                                <option value="Hong">Hồng</option>
                                <option value="Cam">Cam</option>
                                <option value="Nau">Nâu</option>
                                <option value="Tim">Tím</option>
                                <option value="TimNhat">Tím nhạt</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <select class="form-control show-tick" name="TinhTrang">
                                <option value="0">-- Tình Trạng --</option>
                                <option value="Het">Hết hàng</option>
                                <option value="Sale">Giảm giá</option>
                                <option value="BT">Bình thường</option>
                            </select>
                        </div> 
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <div class="form-line">
                                <input type="number" class="form-control" min="10000" name="GiaBan" placeholder="Giá bán"> 
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <input type="number" class="form-control" name="ThuTu" min="1" max="16" placeholder="Thứ tự hiển thị"> 
                        </div> 
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <select class="form-control show-tick" name="NCC">
                                <option value="0">-- NCC --</option>
                                <option value="Khong">Không có</option>
                            </select>
                        </div>
                    </div><br> 
                    
                    <div class="row clearfix"> 
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-line">
                                <input type="date" value="<?php echo date('Y-m-d') ;?>" class="form-control" name="NCN" placeholder="Ngày đăng ảnh" required>
                            </div>
                        </div>                                    
                        <div class="col-md-3 col-xs-6">
                            <div class="form-group form-float">
                                <input type="radio" name="AnHien" id="AH0" value="0">
                                <label for="AH0">Ẩn</label>
                                <input type="radio" name="AnHien" id="AH1" value="1" checked>
                                <label for="AH1" class="m-l-20">Hiện</label>
                            </div>
                        </div>
                    </div> 
                    <div class="row clearfix"> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-line">
                                <div class="controls">
                                    <input type="file" id="fileInput"/>
                                    <input type="hidden" name="urlHinh" id="urlHinh" value=""/>
                                    <img src="" class="Hinh" height="200" alt="Image...">
                                </div>  
                            </div>                              
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="MoTa" cols="30" rows="10" class="form-control" placeholder="Nội dung tin"></textarea>
                                </div>
                            </div>
                        </div>                      
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">THÊM SẢN PHẨM</button>
                </form>             
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(e) {   
	$("#MaLH").change(function(){
		var MaLH = $(this).val();
                $.ajax({
                type: 'POST',
                url: '{{ route('lay.maphanloai') }}',
                data: {
                   '_token':'{{csrf_token()}}',
                   'MaLH': MaLH,
               },
                success: function(data) {
                    $("#MaPL").html(data);
               }
            });
	});
    });

    <!-- Hàm tự động tạo Mã sản phẩm -->
    $(document).ready(function() {   
	$("#MaPL").change(function(){  
            var MaPL=$(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('tao.masanpham') }}',
                data: {
                   '_token':'{{csrf_token()}}',
                   'MaPL': MaPL,
               },
                success: function(data) {
                    $("#MaSP").val(data);
               }
            });       
        });
    });   
    
    $(document).ready(function(){
        $("#fileInput").change(function(event) {        
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $(".Hinh").attr('src',tmppath);   
            $("#urlHinh").val(this.files[0].name);
            //var file = this.files[0];
            //var reader = new FileReader();
            //reader.addEventListener('load', function(){
                //document.querySelector('img.urlHinh').src = reader.result;
                //document.querySelector('img.urlHinh').src = URL.createObjectURL(selectedFile);
            //}); 
            //if (file) {
            //    reader.readAsDataURL(file);
            //}
        });
    });
</script>
    
<!-- Chèn tool Datetimepicker vào class datepicker -->
<link href="{{asset('admin/admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />
<script src="{{asset('admin/plugins/autosize/autosize.js')}}"></script>
<script src="{{asset('admin/plugins/momentjs/moment.js')}}"></script>


<!-- Bước 1: Chèn tool Ckeditor vào textarea.
     Bước 2: Cấu hình đường dẫn file ảnh của tool Ckfinder cho tool Ckeditor -->
<script src="{{asset('admin/plugins/ckeditor/ckeditor.js')}}"></script> <!--Có thể chèn trực tiếp từ net-->
<script>
$(document).ready(function(e) {        
    CKEDITOR.replace('MoTa',{language:'vi', skin:'kama',
        filebrowserImageBrowseUrl:'plugins/ckfinder/ckfinder.html?Type=Images',
	filebrowserImageUploadUrl : 'plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
});
    CKEDITOR.config.height = 300;   
});
</script>
@endpush