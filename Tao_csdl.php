<?php
    include 'ketnoi.php' ;
    $conn=MoKetNoi();
    if($conn->connect_error)
    {
        echo "không kết nối được MySQL";
    }
   
    $sql="CREATE DATABASE IF NOT EXISTS  TH";
    if(!mysqli_query($conn,$sql))
    {
            echo "không tạo được database ".mysqli_error($conn);
    }
    mysqli_select_db($conn,"TH");

    $LOAI = "CREATE TABLE IF NOT EXISTS LOAI (
        MATL varchar(20) not null primary key,
        TENTL nvarchar(200) not null)";
    $results = mysqli_query($conn,$LOAI)or die (mysqli_error($conn));

    $NHOMSP = "CREATE TABLE IF NOT EXISTS NHOMSP(
        MANHOM varchar(20) not null primary key,
        TENNHOM nvarchar(200) not null,
        MOTA nvarchar(2000))";
    $results = mysqli_query($conn,$NHOMSP) or die(mysqli_error($conn));

    $SANPHAM = "CREATE TABLE IF NOT EXISTS SANPHAM (
        MASP varchar(20) primary key,
        TENSP nvarchar(200) not null,
        THUONGHIEU nvarchar(200) not null,
        MANHOM varchar(20) not null,
        HINH longblob,
        MATL varchar(20) not null,
        SOLUONG int default 12,
        GIA int,
        FOREIGN KEY (MATL) REFERENCES LOAI(MATL))";
    $results = mysqli_query($conn,$SANPHAM)or die (mysqli_error($conn));

    $CHITIETDONHANG="CREATE TABLE IF NOT EXISTS CHITIETDONHANG(
            MADH int(10) NOT NULL,
            MAKH int(10) NOT NULL,
            MASP varchar(20) NOT NULL,
            DONGIA int,
            SOLUONG int,
            GIAMGIA float,
            PRIMARY KEY (MADH,MASP),
            FOREIGN KEY (MASP) REFERENCES SANPHAM(MASP))";
    $results = mysqli_query($conn,$CHITIETDONHANG)or die (mysqli_error($conn));
    
    $NGUOIDUNG = "CREATE TABLE IF NOT EXISTS NGUOIDUNG (
        MAKH INT AUTO_INCREMENT PRIMARY KEY,
        TENDANGNHAP nvarchar(200) NOT NULL,
        MATKHAU varchar(200) NOT NULL,
        SODT int default 0,
        HOTEN nvarchar(200) NOT NULL,
        NGAYSINH nvarchar (200),
        DIACHI nvarchar(200) not null,
        PHANLOAI varchar(10) default 'user')";
    $results = mysqli_query($conn,$NGUOIDUNG)or die (mysqli_error($conn));
    
    $DONHANG="CREATE TABLE IF NOT EXISTS DONHANG(
        MAKH int,
        TENDANGNHAP nvarchar(200) not null,
        MADH int(10) not null,
        DIACHI nvarchar(200),
        SODT int,
        HOTEN nvarchar(200),
        NGAYDAT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        TONGTIEN int,
        THANHTOAN nvarchar(200),
        MADHDD int auto_increment primary key,
        FOREIGN KEY (MAKH) REFERENCES NGUOIDUNG(MAKH),
        FOREIGN KEY (MADH) REFERENCES CHITIETDONHANG(MADH)
        )";
        $results = mysqli_query($conn,$DONHANG)or die (mysqli_error($conn));

    $DataLOAI="INSERT INTO LOAI (MATL,TENTL)". 
            "VALUES ('TW','TRUE WIRELESS'),
            ('SONY','SONY'),
            ('SEN','SENNHEISER')";
    $results = mysqli_query($conn,$DataLOAI) or die (mysqli_error($conn));
    
    $DataNGUOIDUNG="INSERT INTO NGUOIDUNG (MAKH,TENDANGNHAP,MATKHAU,SODT,HOTEN,NGAYSINH,DIACHI,PHANLOAI)". 
                "VALUES ('0','truongquoc220@gmail.com','123','0902475432','Trang Quốc Trường','19-11-2004','21 Tự lặp','admin'),
                        ('2','truongquoc221@gmail.com','123','0902475422','Trang Quốc Trường','19-11-2004','21 Tự lặp','user')";
    $results = mysqli_query($conn,$DataNGUOIDUNG) or die (mysqli_error($conn));

    $DataSANPHAM = "INSERT INTO SANPHAM (MASP, TENSP, THUONGHIEU, HINH, SOLUONG, GIA, MATL)"." VALUES 
    ('TW01', 'JBL Under Armour True Wireless Streak', 'TRUE WIRELESS', 'picture/1.png', 12, 2050000,'TW'),
    ('TW02', 'Fill CC2 True Wireless', 'TRUE WIRELESS', 'picture/2.png', 12, 990000,'TW'),
    ('TW03', 'T5 Klipsch True Wireless', 'TRUE WIRELESS', 'picture/3.png', 12, 2050000,'TW'),
    ('TW04', 'JBL Free II True Wireless', 'TRUE WIRELESS', 'picture/4.png', 12, 2050000,'TW'),
    ('TW05', 'Sennheiser Momentum True Wireless 3', 'TRUE WIRELESS', 'picture/5.png', 12, 2050000,'TW'),
    ('TW06', 'Klipsch T5 II True Wireless Sport', 'TRUE WIRELESS', 'picture/6.png', 12, 2050000,'TW'),
    ('TW07', 'Anker Life Note 3S True Wireless', 'TRUE WIRELESS', 'picture/7.png', 12, 2050000,'TW'),
    ('TW08', 'JLAB Audio JBuds Air True Wireless', 'TRUE WIRELESS', 'picture/8.png', 12, 2050000,'TW'),
    ('TW09', 'Skullcandy Sesh Evo True Wireless', 'TRUE WIRELESS', 'picture/9.png', 12, 2050000,'TW'),
    ('TW10', 'Soul ST-XS2 True Wireless', 'TRUE WIRELESS', 'picture/10.png', 12, 2050000,'TW'),
    ('TW11', 'BC Master True Wireless BC-T01', 'TRUE WIRELESS', 'picture/11.png', 12, 2050000,'TW'),
    ('TW12', 'Jabra Elite 85t True Wireless', 'TRUE WIRELESS', 'picture/12.png', 12, 2050000,'TW'),
    ('TW13', 'Jabra Elite 7 Pro True Wireless', 'TRUE WIRELESS', 'picture/13.png', 12, 2050000,'TW'),
    ('TW14', 'Skullcandy Push Active XT True Wireless', 'TRUE WIRELESS', 'picture/14.png', 12, 2050000,'TW'),
    ('TW15', 'Skullcandy Push Ultra True Wireless EarBuds', 'TRUE WIRELESS', 'picture/15.png', 12, 2050000,'TW'),

    ('SONY01', 'Sony ZX110AP', 'SONY', 'picture/16.png', 12, 2050000,'SONY'),
    ('SONY02', 'Sony EX 650', 'SONY', 'picture/17.png', 12, 2050000,'SONY'),
    ('SONY03', 'Sony WH-XB910N', 'SONY', 'picture/18.png', 12, 2050000,'SONY'),
    ('SONY04', 'Sony WH-1000XM4', 'SONY', 'picture/19.png', 12, 2050000,'SONY'),
    ('SONY05', 'Sony Extra Bass MDR-XB550AP', 'SONY', 'picture/20.png', 12, 2050000,'SONY'),
    ('SONY06', 'Sony C300', 'SONY', 'picture/21.png', 12, 2050000,'SONY'),
    ('SONY07', 'Sony WI-C400 Vòng Cổ', 'SONY', 'picture/22.png', 12, 2050000,'SONY'),
    ('SONY08', 'Sony WF-H800', 'SONY', 'picture/23.png', 12, 2050000,'SONY'),
    ('SONY09', 'Sony WF-C500', 'SONY', 'picture/24.png', 12, 2050000,'SONY'),
    ('SONY10', 'Sony WH-1000XM3', 'SONY', 'picture/25.png', 12, 2050000,'SONY'),

    ('SEN01', 'Sennheiser Momentum True Wireless 3', 'SENNHEISER', 'picture/26.png', 12, 2050000,'SEN'),
    ('SEN02', 'Sennheiser HD 4.30g', 'SENNHEISER', 'picture/27.png', 12, 2050000,'SEN'),
    ('SEN03', 'Sennheiser Momentum 1 cắm dây 3.5 likenew fullbox', 'SENNHEISER', 'picture/28.png', 12, 2050000,'SEN'),
    ('SEN04', 'Sennheiser HD 350BT likenew fullbox', 'SENNHEISER', 'picture/29.png', 12, 2050000,'SEN'),
    ('SEN05', 'Sennheiser HD 450BT nobox', 'SENNHEISER', 'picture/30.png', 12, 2050000,'SEN')

    ";

$results = mysqli_query($conn, $DataSANPHAM) or die(mysqli_error($conn));

    DongKetNoi($conn);
?>