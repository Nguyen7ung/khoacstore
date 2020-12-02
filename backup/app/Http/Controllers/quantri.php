
application/x-httpd-php quantri.php ( C++ source, UTF-8 Unicode text, with CRLF line terminators )
<?php
require "goc.php";
class quantrisanpham extends goc  {
    
    public $result_query=null;

     function changeTitle($str)
    {
        $str = $this->stripUnicode($str);
        $str = $this->stripSpecial($str);
        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
        return $str;
    }
    // Hàm xử lý chuỗi
    function stripSpecial($str)
    {
        $arr = array(",", "$", "!", "?", "&", "'", '"', "+");
        $str = str_replace($arr, "", $str);
        $str = trim($str);
        while (strpos($str, "  ") > 0) $str = str_replace("  ", " ", $str);
        $str = str_replace(" ", "-", $str);
        return $str;
    }
    // Hàm xử lý chuỗi
    function stripUnicode($str)
    {
        if (!$str) return false;
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ', 'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị', 'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ', 'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        );
        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }
        return $str;
    }
    
    // Hàm lấy thông tin user từ table users
    function thongtinuser ($u, $p){
        $u = $this->db->escape_string($u);
        $p = $this->db->escape_string($p);
        $p = md5($p);
        $sql = "select * from quantri where TenDangNhap='$u' and MatKhau ='$p'";
        $kq = $this->db->query($sql);
        return $kq;
    }
    // Hàm kiểm tra quyền và trạng thái đặng nhập thành công hay không
    function checkLogin(){
        if(isset($_SESSION['login_id'])==FALSE){
            $_SESSION['error'] = 'Bạn chưa đăng nhập!';
            $_SESSION['back'] = $_SERVER['REQUEST_URI'];
            header('location: login.php');
            exit();
        } else {
            if ($_SESSION['login_level']>2){
                $_SESSION['error'] = 'Bạn không có quyền xem trang này!';
                $_SESSION['back'] = $_SERVER['REQUEST_URI'];
                header('location: login.php');
                exit();
            }         
        }
    }
    
    function CheckPhanQuyen(){
        if ($_SESSION['login_level']>=2)
            return FALSE;
        else
            return TRUE;
    }
    // --------------------------------- menu.php ----------------------------------
    function TenLoaiHang1 () { 
        $sql="SELECT * FROM loaihang where AnHien=1 ORDER BY ThuTu ASC";
        $kq = $this->db->query($sql);
        if(!$kq)
            die ('Lỗi trong hàm'.__FUNCTION__.' '.$this->db->error);
        return $kq;
    }
    
    function TenLoaiHang2 ($MaLH) { 
        $sql="SELECT * FROM phanloaihang WHERE MaLH = '$MaLH' ORDER BY ThuTu ASC";
        $kq = $this->db->query($sql);
        if(!$kq)
            die ('Lỗi trong hàm'.__FUNCTION__.' '.$this->db->error);
        return $kq;
    }
    
    // ---------------------------- PHÂN LOẠI HÀNG -------------------------- //

    // Hàm hiển thị danh sách ở table phanloaihang (phanloai_ds.php)
    function ListTheLoai(){
        $sql = "select * from phanloaihang";
        $kq = $this->db->query($sql);
        if (!$kq)
            die($this->db->error);
        return $kq;
    }
    
    // Hàm hiển thị danh sách ở table loaihang (phanloai_them.php)
    function ListLoaiHang(){
        $sql = "select MaLH, TenLH from loaihang";
        $kq = $this->db->query($sql);
        if (!$kq)
            die($this->db->error);
        return $kq;
    }
    
    // Hàm thêm dữ liệu vào table phanloaihang (phanloai_them.php)
    function PhanLoai_Them($MaLH, $TenPL, $TenPL_KhongDau, $ThuTu)
    {
        $TenPL = $this->db->escape_string(trim(strip_tags($TenPL)));
        $TenPL_KD = $this->db->escape_string(trim(strip_tags($TenPL_KD)));
        //if ($TenTL_KD == "") $TenTL_KD = $this->changeTitle($TenPL);
        
        $sql = "INSERT INTO phanloaihang SET MaLH='$MaLH', TenPL='$TenPL', TenPL_KhongDau='$TenPL_KhongDau', ThuTu=$ThuTu";
        $kq = $this->db->query($sql);
        if (!$kq) die($this->db->error);
    }
    
    // Hàm lấy dữ liệu từ table phanloaihang để sửa (phanloai_sua.php)
    function PhanLoai_ChiTiet($MaPL){
        $sql="SELECT * FROM phanloaihang WHERE MaPL='$MaPL'";
        $kq=$this->db->query($sql);
        if(!$kq) die($this->db->error);
        return $kq;
    }
    
    // Hàm sửa dữ liệu table phanloaihang (phanloai_sua.php)
    function PhanLoai_Sua($MaLH, $MaPL, $TenPL, $TenPL_KhongDau, $ThuTu)
    {
        $TenPL = $this->db->escape_string(trim(strip_tags($TenPL)));
        $TenPL_KhongDau = $this->db->escape_string(trim(strip_tags($TenPL_KhongDau)));
        $sql = "UPDATE phanloaihang SET TenPL='$TenPL', TenPL_KhongDau = '$TenPL_KhongDau', ThuTu=$ThuTu where MaLH='$MaLH' and MaPL=$MaPL";
        $kq = $this->db->query($sql);
        if (!$kq) 
            die($this->db->error);
    }
  
    // Hàm xóa dữ liệu của table phanloaihang (phanloai_xoa.php)
    function PhanLoai_Xoa($MaLH, $MaPL)
    {
        settype($MaLH, "string");
        $sql = "DELETE from phanloaihang where MaLH='$MaLH' and MaPL=$MaPL";
        $kq = $this->db->query($sql);
        if (!$kq) 
            die($this->db->error);
    }   
    
// -------------------------------- SẢN PHẨM -------------------------------- //

    // Hàm hiển thị danh sách của table sanpham (sanpham_ds.php)
    function DanhSachSPTheoLoai($MaLH){
        $sql = "select MaSP, TenSP, urlHinh, MauSac, MoTa, GiaBan, sp.MaPL, MaNCC, plh.TenPL from sanpham as sp, phanloaihang as plh where plh.MaLH='$MaLH' and plh.MaPL=sp.MaPL";
        $kq = $this->db->query($sql);
        if (!$kq)
            die($this->db->error);
        return $kq;
    }
    
    function DanhSachSPTheoPhanLoai($MaPL){
        $sql = "select * from sanpham  where MaPL='$MaPL'";
        $kq = $this->db->query($sql);
        if (!$kq)
            die($this->db->error);
        return $kq;
    }
     
    // Hàm lấy MaSP cuối cùng trong table sanpham (sanpham_taomasp.php)
     function MaSPCuoiCung($MaPL){
        $sql="SELECT SUBSTRING(MaSP, 1, 2) as MaSanPham, SUBSTRING(MaSP, 3, 3) as SoSanPham FROM sanpham "
                . "WHERE MaPL=$MaPL ORDER BY SoSanPham DESC LIMIT 0, 1";
        $kq = $this->db->query($sql) ;
        if(!$kq) 
            die( $this-> db->error);
        $row_rs = $kq->fetch_row();  
        return $row_rs; 
    }
        
    // Hàm lấy MaPL khi chọn MaLH (sanpham_laymapl.php)
     function SanPham_LayMaPL ($MaLH){
        $sql="SELECT MaPL, TenPL from phanloaihang where MaLH = '$MaLH'";
        $kq = $this->db->query($sql) ;
        if(!$kq) 
            die( $this-> db->error);
        return $kq; 
    }
    // Hàm thêm dữ liệu vào table sanpham (sanpham_them.php)
    function SanPham_Them($MaPL, $MaSP, $TenSP, $urlHinh, $MauSac, $TinhTrang, $GiaBan, $ThuTu, $NCC , $NCN, $AnHien, $MoTa){        
        $MaSP = $this->db->escape_string(trim(strip_tags($MaSP)));
        $TenSP = $this->db->escape_string(trim(strip_tags($TenSP)));
        $MauSac = $this->db->escape_string(trim(strip_tags($MauSac)));
        $MoTa = $this->db->escape_string($MoTa);
        settype($GiaBan,"int");
        
        $sql="INSERT INTO sanpham SET MaPL=$MaPL, MaSP='$MaSP', TenSP='$TenSP', urlHinh='$urlHinh', MauSac='$MauSac', TinhTrang='$TinhTrang', GiaBan=$GiaBan,
            ThuTu=$ThuTu, MaNCC='$NCC', NgayCapNhat='$NCN', AnHien=$AnHien, MoTa='$MoTa'";   
        $this->db->query($sql) ;
        if(!$kq) {
            echo '<script type="text/javascript">';
            echo 'alert("';echo $this->db->error.'");'; 
            echo '</script>';   
            return;
        }
        $sql = "select MauSac from ctsanpham where MaSP='$MaSP' and MauSac='$MauSac'";   
        $this->db->query($sql) ;
        $sql="INSERT INTO ctsanpham SET MaSP='$MaSP', urlHinh1='$urlHinh', MauSac='$MauSac'";   
        $this->db->query($sql) ;
    }
    
    // Hàm xóa dữ liệu của table sanpham (sanpham_xoa.php)
    function SanPham_Xoa($MaSP, $MauSac){
        $sql="DELETE FROM sanpham WHERE MaSP='$MaSP'";
	    $this->db->query($sql) ;
    }

    // Hàm hiển thị dữ liệu sản phẩm trước khi sửa (sanpham_sua.php)
    function SanPham_Hien($MaSP){
        $sql="SELECT * FROM sanpham WHERE MaSP='$MaSP'";
        $kq = $this->db->query($sql) ;
        if (!$kq) {
            die($this->db->error);
        }
        return $kq; 
     }
    // Hàm sửa dữ liệu table sanpham (sanpham_sua.php)
    function SanPham_Sua($MaPL, $MaSP, $TenSP, $urlHinh, $GiaBan, $MauSac, $TinhTrang, $NCN, $ThuTu, $MaNCC, $AnHien, $MoTa){
        $TenSP = $this->db->escape_string(trim(strip_tags($TenSP)));
        $MoTa = $this->db->escape_string($MoTa);
        settype($GiaBan,"int");
        $arr = explode ("/", $NCN);
        if (count($arr)==3){
            $NCN = $arr[2]."-".$arr[1]."-".$arr[0];
        }else {
            $NCN = date("Y-m-d");
        }
        // Lấy giá trị mã sản phẩm và màu sắc để cập nhật cho table ctsanpham
        $sql="SELECT MauSac FROM sanpham WHERE MaSP='$MaSP'";
        $kq = $this->db->query($sql) ; 
        $kq = $kq->fetch_row(); 
        $MauCu = $kq[0];

        // Cập nhật dữ liệu table sanpham
        $sql="UPDATE sanpham SET MaPL=$MaPL, TenSP='$TenSP', urlHinh='$urlHinh', GiaBan=$GiaBan, MauSac='$MauSac', TinhTrang='$TinhTrang', NgayCapNhat='$NCN',
            ThuTu='$ThuTu', MaNCC='$MaNCC', AnHien=$AnHien, MoTa='$MoTa' WHERE MaSP='$MaSP'";
        $this->db->query($sql) ;  
        
        // Cập nhật dữ liệu table ctsanpham
        $sql="UPDATE ctsanpham SET urlHinh1='$urlHinh', MauSac='$MauSac' WHERE MaSP='$MaSP' and MauSac='$MauCu'";
        $this->db->query($sql) ;  
    }
    // ------------------------ CHI TIẾT SẢN PHẨM --------------------------- //
    
    // Hàm hiển thị tất cả dữ liệu của table ctsanpham (ctsanpham_ds.php)
    function DanhSachCTSP($MaSP){
        $sql = "select * from ctsanpham where MaSP='$MaSP'";
        $kq = $this->db->query($sql);
        if (!$kq) {
            die($this->db->error);
        }
        return $kq;
    }
   
    function DanhSachCTSP2 ($MaSP, $MauSac){
        $sql = "select * from ctsanpham2 where MaSP='$MaSP' and MauSac='$MauSac'";
        $kq = $this->db->query($sql);
        if (!$kq) {
            die($this->db->error);
        }
        return $kq;
    }
    
    function CTSanPham_Them($MaSP, $MauSac, $Size, $SLNhap, $GiaNhap, $NgayNhap){        
        $MaSP = $this->db->escape_string(trim(strip_tags($MaSP)));
        settype($GiaNhap,"int");
        $arr = explode ("/", $NgayNhap);
        if (count($arr)==3){
            $NgayNhap = $arr[2]."-".$arr[1]."-".$arr[0];
        }else {
            $NgayNhap = date("Y-m-d");
        }
        $sql="INSERT INTO ctsanpham2 SET MaSP='$MaSP', MauSac='$MauSac', Size='$Size', SoLuongNhap=$SLNhap, GiaNhap=$GiaNhap, TongTien=$SLNhap*$GiaNhap, NgayNhapHang='$NgayNhap', SoLuongTon=$SLNhap";   
        $kq= $this->db->query($sql) ;
        if(!$kq) {
            echo '<script type="text/javascript">';
            echo 'alert("';echo $this->db->error.'");'; 
            echo '</script>';   
            return;
        }
        $sql = "select MauSac from ctsanpham where MaSP='$MaSP' and MauSac='$MauSac'";   
        $kq= $this->db->query($sql) ;
        if(mysqli_num_rows($kq)>0){
            return;
        } else {
            $sql="INSERT INTO ctsanpham SET MaSP='$MaSP', MauSac='$MauSac'";   
            $kq= $this->db->query($sql) ;
        }

    }
    
    // Hàm nhận dữ liệu ctsanpham để sửa (sanpham_sua.php)
    function CTSanPham_Hien($MaSP, $MaMau){
        $sql="SELECT * FROM ctsanpham WHERE MaSP='$MaSP' and MaMau='$MaMau'";
        $kq = $this->db->query($sql) ;
        if (!$kq) {
            die($this->db->error);
        }
        return $kq; 
     }
    
    // Hàm sửa dữ liệu của table ctsanpham (ctsanpham_sua.php)
    function CTSanPham_Sua($MaSP, $MaMau, $urlHinh1, $urlHinh2, $urlHinh3, $urlHinh4){
        $MaSP = $this->db->escape_string(trim(strip_tags($MaSP)));
        $arr = explode ("/", $NgayCN);
        if (count($arr)==3){
            $NgayCN = $arr[2]."-".$arr[1]."-".$arr[0];
        }else {
            $NgayCN = date("Y-m-d");
        }
        settype($GiaNhap,"int");
        $sql="UPDATE ctsanpham SET urlHinh1='$urlHinh1', urlHinh2='$urlHinh2', urlHinh3='$urlHinh3', urlHinh4='$urlHinh4' WHERE MaSP='$MaSP' and MaMau=$MaMau";
         
        $kq= $this->db->query($sql) ;
        if (!$kq) {
            die($this->db->error);
        }
    }
    
    // Hàm sửa dữ liệu của table ctsanpham (ctsanpham_sua.php)
    function CTSanPham_Sua2($MaSP, $MauSac, $SizeMoi, $SizeCu, $GiaNhap, $SLNhap){
        $MaSP = $this->db->escape_string(trim(strip_tags($MaSP)));
        settype($GiaNhap,"int");
        
        $sql="UPDATE ctsanpham2 SET Size='$SizeMoi', GiaNhap=$GiaNhap, SoLuongNhap=$SLNhap, SoLuongTon=$SLNhap, TongTien=$GiaNhap*$SLNhap 
           WHERE MaSP='$MaSP' and MauSac='$MauSac' and Size='$SizeCu'";
        $this->db->query($sql) ;
    }
    
    // Hàm xóa dữ liệu của table ctsanpham (ctsanpham_xoa.php)
    function CTSanPham_Xoa($MaSP, $MauSac){
        $sql="DELETE FROM ctsanpham WHERE MaSP='$MaSP' and MauSac='$MauSac'";
	    $this->db->query($sql) ;
	    $sql="DELETE FROM ctsanpham2 WHERE MaSP='$MaSP' and MauSac='$MauSac'";
	    $this->db->query($sql) ;

    }
    
    // Hàm xóa dữ liệu của table ctsanpham (ctsanpham_xoa.php)
    function CTSanPham2_Xoa($MaSP, $MauSac, $Size){
        $sql="DELETE FROM ctsanpham2 WHERE MaSP='$MaSP' and MauSac='$MauSac' and Size = '$Size'";
	    $this->db->query($sql) ;
    }
    
    // Hàm hiển thị tất cả dữ liệu của table ctsanpham (ctsanpham_tim.php)
    function DSHangTonKho(){
        $sql = "select ct2.MaSP, ct2.MauSac, Size, SoLuongNhap, SoLuongTon, urlHinh1, NgayNhapHang from ctsanpham as ct1, ctsanpham2 as ct2 where ct2.MaSP=ct1.MaSP and ct2.MauSac=ct1.MauSac";
        $kq = $this->db->query($sql);
        if (!$kq) {
            die($this->db->error);
        }
        return $kq;
    }
    
    public function select ($sql=NULL){   
        $this->result_query = $this->db->query($sql);   
        return $this->result_query;
    }
    
    public function closedb (){   
        mysqli_close($this->db);
    }
    
    // ------------------------ Danh Sách Hóa Đơn --------------------------- //
    
    // Hàm hiển thị tất cả dữ liệu của table hoadon (hoadon_ds.php)
    function DSHoaDon(){
        $sql = "select * from hoadon, khachhang where hoadon.MaHD=khachhang.MaHD";
        $kq = $this->db->query($sql);
        if (!$kq) {
            die($this->db->error);
        }
        return $kq;
    }
    
    // Hàm xóa dữ liệu của table hoadon (hoadon_xoa.php)
    function HoaDon_Xoa($MaHD){
        $sql="DELETE FROM hoadon WHERE MaHD=$MaHD";
	    $this->db->query($sql) ;
	    $sql="DELETE FROM cthoadon WHERE MaHD=$MaHD";
	    $this->db->query($sql) ;
    }
    
    // Hàm sửa dữ liệu table hoadon (hoadon_sua.php)
    function HoaDon_Sua ($MaHD, $TenKH, $DTNguoiNhan, $Email, $DiaChi){
        $TenKH = $this->db->escape_string(trim(strip_tags($TenKH)));
        $DiaChi = $this->db->escape_string($DiaChi);
        $TinhTrang = $this->db->escape_string($TinhTrang);
        $sql="UPDATE khachhang SET TenKH='$TenKH', DTNguoiNhan=$DTNguoiNhan, Email='$Email', DiaChi='$DiaChi' WHERE MaHD=$MaHD";
        $this->db->query($sql) ;            
    }
    
    // -------------------- Danh Sách Chi Tiết Hóa Đơn ---------------------- //

    // Hàm hiển thị tất cả dữ liệu của table cthoadon (cthoadon_ds.php)
    function DSHoaDonCT($MaHD){
        $sql = "select * from cthoadon where MaHD=$MaHD order by MaCTHD";
        $kq = $this->db->query($sql);
        if (!$kq)
            die($this->db->error);
        return $kq;
    }
     
    // Hàm hiển thị tất cả dữ liệu của table cthoadon (cthoadon_xoa.php)
    function CTHoaDon_Xoa($MaHD, $MaCTHD){
        $sql="DELETE FROM cthoadon WHERE MaHD=$MaHD and MaCTHD=$MaCTHD";
	    $this->db->query($sql) ;
    }
    
    // Hàm tìm tên sản phẩm (hoadon_timtensp.php)
    function LayTenVaGia ($MaSP){
        $sql = "select TenSP, GiaBan from sanpham where MaSP='$MaSP'";
        $kq = $this->db->query($sql);
        if (!$kq)
            die($this->db->error);
        $row_rs = $kq->fetch_row();  
        return $row_rs; 
    }
    // --------------------------- hoadon_luu.php --------------------------- //

     function LuuDonHang ($donhang) {           
        $hoten=$this->db->escape_string(trim(strip_tags($donhang[0][0])));
        $diachi = $this->db->escape_string(trim(strip_tags($donhang[0][1])));
        $dienthoai = $donhang[0][2];
        $email = $donhang[0][3];
        $tongtien = 0;
        for ($i = 1; $i<count($donhang); $i++){   
            $tongtien += $donhang[$i][4]*$donhang[$i][5];
        }
        
        //lưu dữ liệu vào table HoaDon
        $sql="INSERT INTO hoadon SET Ngay=now(), HTTT='$httt', TongTien=$tongtien, KetQua=0"; 
        $kq = $this->db->query($sql);
        if(!$kq) {
            return "Phát sinh lỗi: ". $this->db->error;
        }else{
            //lưu dữ liệu vào table KhachHang
            $sql="SELECT MaHD FROM hoadon ORDER BY MaHD DESC LIMIT 0, 1"; 
            $kq = $this->db->query($sql);
            $row = $kq->fetch_row(); 
            $MaHD = $row[0];
            $sql="INSERT INTO khachhang SET TenKH = '$hoten', DTNguoinhan = '$dienthoai', DiaChi = '$diachi', Email='$email', MaHD=$MaHD"; 
            $kq = $this->db->query($sql);
            if(!$kq)
                return "Phát sinh lỗi: ". $this->db->error;
                
            // Luu dữ liệu vào table CTDonHang 
            for ($i = 1; $i<count($donhang); $i++){  
                $MaSP = $donhang[$i][0];
                $TenSP = $donhang[$i][1];
                $MauSac = $donhang[$i][2];
                $Size = $donhang[$i][3];
                $SL = $donhang[$i][4];
                $Gia = $donhang[$i][5];
                $sql ="INSERT INTO cthoadon (MaHD, MaSP, TenSP, urlHinh, MauSac, Size, SoLuong, Gia, TongTien) VALUES ($MaHD, '$MaSP', '$TenSP', ' ', '$MauSac', '$Size', $SL, $Gia, $SL*$Gia)"; 
                $kq = $this->db->query($sql);
                if(!$kq)
                    return "Phát sinh lỗi: ". $this->db->error;
            }
            return $MaHD;
         }
    } 
    
    
}//class quantri