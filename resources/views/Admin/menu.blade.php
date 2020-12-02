<ul class="list">
    <li class="header">Chuyên Mục</li>
    <li class="active">
        <a href="index.php">
            <i class="material-icons">home</i>
            <span>Trang Chủ</span>
        </a>
    </li>
    <li>
        <a href="thoat.php">
            <i class="material-icons">text_fields</i>
            <span>Thoát</span>
        </a>
    </li>


    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">view_list</i>
            <span>Quản Trị Phân Loại</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="index.php?p=phanloai_ds">Danh sách Phân Loại</a>
            </li>
            <li>
                <a href="index.php?p=phanloai_them">Thêm Phân Loại</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">view_list</i>
            <span>Quản Trị Sản Phẩm</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="{{URL::to('quantri/sanpham/create')}}">Thêm Sản Phẩm</a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <span>Danh Sách Sản Phẩm</span>
                </a>
                <ul class="ml-menu">
                    @php
                        $menu1 = $Menu->menu1();
                        $menu2 = $Menu->menu2();
                    @endphp
                    @foreach($menu1 as $row1)
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle"><span><b>{{ $row1->TenLH }}</b></span></a>
                        <ul class="ml-menu">
                        @php
                            $menu1_2 = $menu2->where('MaLH', '=', $row1->MaLH)
                        @endphp
                        @foreach($menu1_2 as $row2)
                            <li><a href="{{route('sanpham.show', $row2->MaPL)}}">{{ $row2->TenPL }}</a></li>
                        @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </li>
 <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">view_list</i>
            <span>Quản Trị Hóa Đơn</span>
        </a>             
        <ul class="ml-menu">
            <li>
                <a href="index.php?p=hoadon_ds">Hóa Đơn Hiện Có</a>
            </li>
            <li>
                <a href="index.php?p=hoadon_tao">Tạo Hóa Đơn Mới</a>
            </li>
        </ul>
    </li>

    <li>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">view_list</i>
            <span>Quản Trị Thành Viên</span>
        </a>
        <ul class="ml-menu">
            <li>
                <a href="index.php">Danh Sách Thành Viên</a>
            </li>
            <li>
                <a href="index.php">Thêm Thành Viên Mới</a>
            </li>
        </ul>
    </li>
</ul>
