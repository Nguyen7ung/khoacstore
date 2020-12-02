<?php 
    require_once "goc.php";
    class sanpham extends goc {
 
// --------------------------------- menu.php ----------------------------------
    function TenLoaiHang1 () { 
        $sql="SELECT * FROM loaihang where AnHien=1 ORDER BY ThuTu ASC";
        $kq = $this->db->query($sql);
        if(!$kq)
            die ('Lỗi trong hàm'.__FUNCTION__.' '.$this->db->error);
        return $kq;
    }
    
    function TenLoaiHang2 ($MaLH) { 
        $sql="SELECT * FROM phanloaihang WHERE MaLH = '$MaLH' and AnHien=1 ORDER BY ThuTu ASC";
        $kq = $this->db->query($sql);
        if(!$kq)
            die ('Lỗi trong hàm'.__FUNCTION__.' '.$this->db->error);
        return $kq;
    }
    
// ----------------------------- Phần Breadcrumb -------------------------------
    function LayTenLoai($MaPL) {
        $sql="SELECT TenPL FROM phanloaihang WHERE MaPL = '$MaPL'"; 
        $kq = $this->db->query($sql);
        if(!$kq)
            die ('Lỗi trong hàm'.__FUNCTION__.' '.$this->db->error);
        if ($kq->num_rows<=0) 
            return ""; 
        $row = $kq->fetch_row(); 
        $ten= $row [0]; 
        return $ten;
    }
// ----------------------- Phần Sản Phẩm Mới (index.php) -----------------------   
    function SanPhamMoi (){
            $sql = "SELECT TenLH_KhongDau, TenPL_KhongDau, sp.MaSP, urlHinh, TenSP, MaMau, sp.MauSac, GiaBan FROM loaihang as lh, phanloaihang as plh, sanpham as sp, ctsanpham as ctsp
                    WHERE sp.MaPL=plh.MaPL and plh.MaLH=lh.MaLH and sp.MaSP = ctsp.MaSP and sp.MauSac=ctsp.MauSac and sp.AnHien=1 ORDER BY sp.NgayCapNhat DESC LIMIT 0, 8";
            $kq = $this->db->query($sql);
            if(!$kq)
                die ($this->db->error);
            return $kq;                    
    }
// ------------------------------ loaisanpham.php ------------------------------
    function loaisanpham ($MaPL, $TrangHienTai, &$TongSoSP) { 
        $SoSP = $TrangHienTai*16;
        $sql="SELECT TenPL_KhongDau, sp.MaSP, TenSP, urlHinh, GiaBan, TinhTrang FROM phanloaihang as plh, sanpham as sp 
            WHERE plh.MaLH='$MaPL' and plh.MaPL = sp.MaPL and sp.AnHien=1 ORDER BY sp.ThuTu ASC LIMIT 0, $SoSP";
        $kq = $this->db->query($sql);
        
        // Đếm số record, 2 câu lệnh sql phải giống nhau phần From và Where 
        $sql = "SELECT count(sp.MaSP) FROM phanloaihang as plh, sanpham as sp WHERE plh.MaLH='$MaPL' and plh.MaPL = sp.MaPL and sp.AnHien=1";
        $rs = $this->db->query($sql);
        $row_rs = $rs->fetch_row();
        $TongSoSP = $row_rs[0];
        
        if(!$kq)
            die ('Lỗi trong hàm'.__FUNCTION__.' '.$this->db->error);
        return $kq;
    }
// --------------------------- sanphamtrongloai.php ----------------------------
    function SanPhamTrongLoai ($MaPL,  $TrangHienTai, &$TongSoSP){
        $SoSP = $TrangHienTai*16;
        $sql="SELECT urlHinh, sp.MaSP, TenSP, GiaBan, TinhTrang FROM sanpham as sp WHERE MaPL = '$MaPL' and AnHien=1 ORDER BY ThuTu ASC LIMIT 0, $SoSP";
        $kq = $this->db->query($sql) ;
        
        $sql = "SELECT count(sp.MaSP) FROM sanpham as sp WHERE MaPL = '$MaPL' and AnHien=1";
        $rs = $this->db->query($sql);
        $row_rs = $rs->fetch_row();
        $TongSoSP = $row_rs[0];
        
        if(!$kq) 
            die( $this-> db->error);
        return $kq; 
    }
// ----------------------------- chitietsanpham.php ----------------------------
    function ChiTietSanPham ($MaSP){
       $sql="SELECT * FROM sanpham as sp, ctsanpham as ctsp WHERE sp.MaSP = '$MaSP' and sp.MaSP=ctsp.MaSP and sp.MauSac=ctsp.MauSac";
        $kq = $this->db->query($sql) ;
        if(!$kq) 
            die( $this-> db-> error);
        return $kq; 
    }
 
    function HinhSanPham ($MaSP, $MauSac){
        $sql="SELECT urlHinh1, urlHinh2, urlHinh3, urlHinh4 FROM ctsanpham WHERE MaSP = '$MaSP' and MauSac='$MauSac'";
        $kq = $this->db->query($sql);
        if(!$kq) 
            die( $this-> db-> error);
        return $kq; 
    }
    
    
    function MauSanPham ($MaSP){
       $sql="SELECT MaSP, MaMau, MauSac FROM ctsanpham WHERE MaSP = '$MaSP'";
        $kq = $this->db->query($sql) ;
        if(!$kq) 
            die( $this-> db-> error);
        return $kq; 
    }
    function LayMaLoai($TenPL_KhongDau){
        //$Ten_KhongDau = trim(strip_tags($_GET['Ten_KhongDau']));
        $TenPL_KhongDau = $this->db->escape_string($TenPL_KhongDau);
        $sql="select MaPL from phanloaihang where TenPL_KhongDau='$TenPL_KhongDau'";
        $kq = $this->db->query($sql);
        if(!$kq) 
            die( $this-> db->error);
        $row_kq = $kq->fetch_assoc();
        $MaPL= $row_kq['MaPL'];
        return $MaPL;
    }
    
    function SanPhamLienQuan($MaSP, $MaPL){
        $sql = "SELECT TenPL_KhongDau, sp.MaSP, urlHinh, TenSP, GiaBan FROM phanloaihang as plh, sanpham as sp
                    WHERE plh.MaPL=$MaPL and sp.MaPL=$MaPL and sp.MaSP<>'$MaSP' and sp.AnHien=1 LIMIT 0, 4";        
        $kq = $this->db->query($sql);
        if(!$kq)
            die ($this->db->error);
       return $kq;
    }
// ------------------------------- giohang.php ---------------------------------
    function CapNhatGioHang ($action, $MaSP, $MaMau, $MauSac, $Size, $SL) {
        if (!isset($_SESSION['dathang'])) 
            $_SESSION['dathang']=array();                               
        if ($action=="add") {
            $MaDH = $MaSP. $MaMau. $Size;
            $sql="SELECT urlHinh1, TenSP, GiaBan FROM sanpham as sp, ctsanpham as ctsp WHERE sp.MaSP='$MaSP' and sp.MaSP=ctsp.MaSP and ctsp.MaMau=$MaMau";
            $kq = $this->db->query($sql); 
            if (!$kq) 
                die( $this-> db->error); 
            $row = $kq->fetch_assoc();
            $soluong = $_SESSION['dathang'][$MaDH]['SL'] +=$SL;
            //$_SESSION['dathang'][$idDT] = array(array($idDT, $row['TenDT'], $row['Gia']));
            $_SESSION['dathang'][$MaDH] = array('ID'=>$MaSP,'Hinh'=>$row['urlHinh1'], 'Ten'=>$row['TenSP'], 'MauSac'=>$MauSac, 'Size'=>$Size, 'SL'=>$soluong,'Gia'=>$row['GiaBan']);
        }     

        if ($action=="remove") {
            unset($_SESSION['dathang'][$_GET['MaDH']]);
        }

        if ($action=="update") {           
            $capnhat = $_POST['capnhat'];               
            for ($i=0; $i<count($capnhat); $i++) {
                $mang = each($capnhat);
                $ID = $mang[0]; $SL = $mang[1][0];
                $_SESSION['dathang'][$ID]['SL'] = $SL;                   
            }
        }                              
    }
// ------------------------------- dathang.php ---------------------------------
    function LuuDonHang () {           
        $hoten=$this->db->escape_string(trim(strip_tags($_SESSION['dathang']['KH']['Ten'])));
        $diachi = $this->db->escape_string(trim(strip_tags($_SESSION['dathang']['KH']['DiaChi'])));
        $dienthoai = $_SESSION['dathang']['KH']['DT'];
        $email = $this->db->escape_string(trim(strip_tags($_SESSION['dathang']['KH']['Email'])));
        $ghichu = $this->db->escape_string(trim(strip_tags($_SESSION['dathang']['KH']['GC'])));
        $httt = $_SESSION['dathang']['KH']['HTTT'];       
        $tongtien = 0;
        reset($_SESSION['dathang']);  
        for ($i = 0; $i< count($_SESSION['dathang'])-1; $i++){                        
            $dathang = each($_SESSION['dathang'])[1];
            $tongtien += $dathang['Gia']*$dathang['SL'];
        }
        //lưu dữ liệu vào table HoaDon
        $sql="INSERT INTO hoadon SET Ngay=now(), HTTT='$httt', TongTien=$tongtien, GhiChu='$ghichu', KetQua=0"; 
        $this->db->query($sql);
        
        //lưu dữ liệu vào table KhachHang
        $sql="SELECT MaHD FROM hoadon ORDER BY MaHD DESC LIMIT 0, 1"; 
        $kq = $this->db->query($sql);
        $row = $kq->fetch_row(); 
        $MaHD = $row[0];
        $sql="INSERT INTO khachhang SET TenKH = '$hoten', DTNguoinhan = '$dienthoai', DiaChi = '$diachi', Email='$email', MaHD=$MaHD"; 
        $this->db->query($sql);
        
        // Luu dữ liệu vào table CTDonHang 
        reset($_SESSION['dathang']);  
        for ($i = 0; $i<count($_SESSION['dathang'])-1; $i++) {
            $dathang = each($_SESSION['dathang'])[1];              
            $MaSP = $dathang['ID'];
            $TenSP = $dathang['Ten'];
            $urlHinh = $dathang['Hinh'];
            $MauSac = $dathang['MauSac']; 
            $Size = $dathang['Size']; 
            $SoLuong = $dathang['SL']; 
            $Gia = $dathang['Gia']; 
            $sql ="INSERT INTO cthoadon (MaHD, MaSP, TenSP, urlHinh, MauSac, Size, SoLuong, Gia, TongTien) VALUES ($MaHD, '$MaSP', '$TenSP', '$urlHinh', '$MauSac', '$Size', $SoLuong, $Gia, $SoLuong*$Gia)"; 
            $this->db->query($sql);                      
        }
    }//function LuuDonHang                
    
}
?>

  