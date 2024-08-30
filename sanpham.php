<?php include 'dautrang.php' ?>
        <nav>
            <ul id="main-menu">
                <li><a href="trangchu.php">Trang chủ</a></li>
                <?php include 'menuchinh.php'?>
            </ul>
        </nav>
        <header class="second"><span><a href="trangchu.php">&emsp;Trang Chủ</a>&ensp;/&ensp;<a href="danhmuc.php">Danh Mục</a>&ensp;/&ensp;
        <?php 
            include 'ketnoi.php';
            $conn=MoKetNoi();
            mysqli_select_db($conn,"TH");	   
            if(isset($_GET['Masanpham']))
            {
                $sanpham = $_GET['Masanpham'];
                $truyvan="SELECT * FROM SANPHAM WHERE MASP = '".$sanpham."'";
                $ketqua = mysqli_query($conn, $truyvan) or die(mysqli_error($conn));
                $dong = mysqli_fetch_array($ketqua);
                echo '<span>'.$dong['TENSP'].'</span>';
            }
        ?>
        </span></header>
        <article class = "article-products"> 
            <table class="products">
                <?php	
                //error_reporting(0);
                if(isset($_GET['Masanpham']))
                {
                    $sanpham = $_GET['Masanpham'];
                    $truyvan="SELECT * FROM SANPHAM WHERE MASP = '".$sanpham."'";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                    $dong=mysqli_fetch_array($ketqua);
                    echo "
                        <tr> <td rowspan='5'> <img class='o' src='".$dong['HINH']."'></td> </tr>
                        <tr><td>
                        <span class='sp1'>". $dong['TENSP'] ." <br></span>
                        <span class='sp2'>".number_format($dong['GIA'])." đồng<br> </span>
                        <span class='sp3'>Thương hiệu  :   ".$dong['THUONGHIEU']."</span>
                        </td> </tr><br> <br>";
                }
            ?>    
            </table>
            <form action="" method="post">
            <table class="size_shoes"> 
            <?php 
                //error_reporting(0);
                if(isset($_GET['Masanpham']))
                {
                    
                    $sanpham = $_GET['Masanpham'];
                    $makh = $_SESSION['makhachhang'];  
                    if (!isset($_SESSION['makhachhang'])) {
                        $_SESSION['makhachhang'] = uniqid();
                    } 
                    $truyvan="SELECT * FROM SANPHAM WHERE MASP = '".$sanpham."'";
                    $ketqua = mysqli_query($conn,$truyvan) or die(mysqli_error($conn));
                    $dong=mysqli_fetch_array($ketqua);
                    $mahd = 00000 . $makh; 
                }
                
                if(isset($_SESSION['tendangnhap']) && isset($_SESSION['loainguoidung']))
                {
                    if($_SESSION['loainguoidung']=='user')
                    {
                        echo "<button class='sp5' name='btnThemGioHang'> Thêm vào giỏ hàng </button>";
                        $n=sizeof($_SESSION['DSMaMua']);
                        if(isset($_POST['btnThemGioHang']))
                        {   
                            if($n==0)
                            {
                                array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                array_push($_SESSION['DSSL'],1);
                                echo "<script>alert('Bạn đã thêm " . $dong['TENSP'] . " vào giỏ hàng. Vui lòng vào giỏ hàng để kiểm tra sản phẩm đã thêm');</script>";
                                echo "<script>window.location = window.location;</script>";
                                $truyvan1 = "SELECT * FROM SANPHAM AS S,CHITIETDONHANG AS CTDH, NGUOIDUNG AS ND WHERE ND.MAKH = CTDH.MAKH AND S.MASP = CTDH.MASP AND CTDH.MASP = '".$sanpham."'";
                                for ($i = 0; $i < $n+1; $i++) {
                                    $dong1 = mysqli_fetch_array($ketqua);
                                    $truyvan1 = "INSERT INTO CHITIETDONHANG (MADH, MAKH, MASP, DONGIA, SOLUONG)
                                                VALUES ('" . ($mahd) . "','$makh', '" . $sanpham . "', '" . $dong1['GIA'] . "', '" . 1 . "')";
                                    $ketqua_insert = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                                }
                                }
                            else
                            {
                                $kt=0;
                                $i=0;
                                while($kt==0 && $i<$n)
                                {
                                    if(strcmp($_SESSION['DSMaMua'][$i],$dong['MASP'])==0)
                                    {    
                                        $kt=1; 
                                    }
                                    else
                                        $i++;
                                }
                                if($kt==0)
                                {
                                    array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                        array_push($_SESSION['DSSL'],1);
                                        echo "<script>alert('Bạn đã thêm " . $dong['TENSP'] . " vào giỏ hàng. Vui lòng vào giỏ hàng để kiểm tra sản phẩm đã thêm');</script>";
                                    echo "<script>window.location = window.location;</script>";
                                    $truyvan1 = "SELECT * FROM SANPHAM AS S,CHITIETDONHANG AS CTDH, NGUOIDUNG AS ND WHERE ND.MAKH = CTDH.MAKH AND S.MASP = CTDH.MASP AND CTDH.MASP = '".$sanpham."'";
                                    for ($i = 0; $i < $n+1; $i++) {
                                        $dong1 = mysqli_fetch_array($ketqua);
                                        $truyvan1 = "INSERT INTO CHITIETDONHANG (MADH, MAKH, MASP, DONGIA, SOLUONG)
                                                    VALUES ('" . ($mahd) . "','$makh', '" . $sanpham . "', '" . $dong1['GIA'] . "', '" . 1 . "')";
                                        $ketqua_insert = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                                    }   
                                }
                                else
                                {
                                    echo "<p class='sp6'> Đã có ".$dong['TENSP']. " trong giỏ hàng. Vui lòng vào giỏ hàng để kiểm tra sản phẩm đã thêm </p>";
                                }
                            }
                        }
                        }
                    }
                
                else
                {
                echo "<button class='sp5' name='btnThemGioHang'> Thêm vào giỏ hàng </button>";
                    $n=sizeof($_SESSION['DSMaMua']);
                        if(isset($_POST['btnThemGioHang']))
                        {
                            if($n==0)
                            {
                                $madh = 00000 . $makh + 1;
                                array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                array_push($_SESSION['DSSL'],1);
                                echo "<script>alert('Bạn đã thêm " . $dong['TENSP'] . " vào giỏ hàng. Vui lòng vào giỏ hàng để kiểm tra sản phẩm đã thêm');</script>";
                                echo "<script>window.location = window.location;</script>";
                                $truyvan1 = "SELECT * FROM SANPHAM AS S,CHITIETDONHANG AS CTDH, NGUOIDUNG AS ND WHERE ND.MAKH = CTDH.MAKH AND S.MASP = CTDH.MASP AND CTDH.MASP = '".$sanpham."'";
                                for ($i = 0; $i < $n+1; $i++) {
                                    $dong1 = mysqli_fetch_array($ketqua);
                                    $truyvan1 = "INSERT INTO CHITIETDONHANG (MADH, MASP, DONGIA, SOLUONG)
                                                VALUES ('" . ($madh) . "', '" . $sanpham . "', '" . $dong1['GIA'] . "', '" . 1 . "')";
                                    $ketqua_insert = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                                }
                            }
                            else
                            {
                                $kt=0;
                                $i=0;
                                while($kt==0 && $i<$n)
                                {
                                    if(strcmp($_SESSION['DSMaMua'][$i],$dong['MASP'])==0)
                                        $kt=1; 
                                    else
                                        $i++;
                                }
                                if($kt==0)
                                {
                                $madh = 00000 . $makh + 1;
                                array_push($_SESSION['DSMaMua'],$dong['MASP']);
                                array_push($_SESSION['DSSL'],1);
                                echo "<script>alert('Bạn đã thêm " . $dong['TENSP'] . " vào giỏ hàng. Vui lòng vào giỏ hàng để kiểm tra sản phẩm đã thêm');</script>";
                                echo "<script>window.location = window.location;</script>";
                                $truyvan1 = "SELECT * FROM SANPHAM AS S,CHITIETDONHANG AS CTDH, NGUOIDUNG AS ND WHERE ND.MAKH = CTDH.MAKH AND S.MASP = CTDH.MASP AND CTDH.MASP = '".$sanpham."'";
                                for ($i = 0; $i < $n+1; $i++) {
                                    $dong1 = mysqli_fetch_array($ketqua);
                                    $truyvan1 = "INSERT INTO CHITIETDONHANG (MADH, MAKH, MASP, DONGIA, SOLUONG)
                                                VALUES ('" . ($madh) . "','$makh', '" . $sanpham . "', '" . $dong1['GIA'] . "', '" . 1 . "')";
                                    $ketqua_insert = mysqli_query($conn, $truyvan1) or die(mysqli_error($conn));
                                }
                                }   
                                else
                                {
                                    echo "<p class='sp6'> Đã có ".$dong['TENSP']. " trong giỏ hàng. Vui lòng chọn thêm sản phẩm khác </p>";
                                }

                            }
                        }
                        
            }
            ?>
            </table>
        </form>
        </article>
        <?php include 'dangkythongbao.php' ?>
    <?php include 'cuoitrang.php' ?>
    </body>
    </html>