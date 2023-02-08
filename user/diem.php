<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid'] == 0)) {
  header('location:logout.php');
} else {

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <title>Student Management System || View point</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <link rel="stylesheet" href="./css/style.css">

  </head>

  <body>
    <?php
    function convert_point_to_text($point)
    {
      if ($point < 4.0) {
        echo 'F';
      } elseif ($point >= 4.0 & $point <= 4.9) {
        echo 'D';
      } elseif ($point >= 5.0 & $point <= 5.4) {
        echo 'D+';
      } elseif ($point >= 5.5 & $point <= 6.4) {
        echo 'C';
      } elseif ($point >= 6.5 & $point <= 6.9) {
        echo 'C+';
      } elseif ($point >= 7.0 & $point <= 7.9) {
        echo 'B';
      } elseif ($point >= 8.0 & $point <= 8.4) {
        echo 'B+';
      } elseif ($point >= 8.5 & $point <= 10) {
        echo 'A';
      } else {
        echo 'Điểm không hợp lệ';
      }
    }

    function check_valid($point){
      if($point >= 4.0){
      echo "Đạt";
      } else{
        echo "Chưa Đạt";
      }
    }

    function check_rank($point){
      if($point < 4.0){
      echo "Kém";
      } elseif ($point >= 4.0 & $point <= 4.9) {
        echo 'Yếu';
      } elseif ($point >= 5.0 & $point <= 6.9) {
        echo 'Trung bình';
      } elseif ($point >= 7.0 & $point <= 7.9) {
        echo 'Khá';
      } elseif ($point >= 8.0 & $point <= 8.9) {
        echo 'Giỏi';
      } elseif ($point >= 9.0 & $point <= 10.0) {
        echo 'Xuất sắc';
      } else{
        echo "Điểm không hợp lệ";
      }
    }
    ?>
    <div class="container-scroller">
      <?php include_once('includes/header.php'); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <?php include_once('includes/sidebar.php'); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Điểm </h3>
            </div>
            <div class="row">

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">

                    <table border="2" class="table table-bordered mg-b-0">
                      <thead>
                        <tr>
                          <th scope="col" style="font-weight: 700;">Môn học</th>
                          <th scope="col" style="font-weight: 700; width: 50px">Số tín chỉ</th>
                          <th scope="col" style="font-weight: 700;">Điểm</th>
                          <th scope="col" style="font-weight: 700;">Điểm chữ</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sid = $_SESSION['sturecmsstuid'];
                        $sql = "SELECT * from tblstudent sv
                        inner join tbl_ketqua as kq  on kq.masv=sv.ID
                        inner join tbl_monhoc as mh on mh.id = kq.mamon
                        where sv.stuID=:sid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;

                        if ($query->rowCount() > 0) {
                          foreach ($results as $row) { ?>
                            <tr>
                              <td><?php echo $row->tenmon; ?></td>
                              <td><?php echo $row->sotc; ?></td>
                              <td><?php echo $row->diem; ?></td>
                              <td><?php convert_point_to_text($row->diem); ?></td>
                              <td><?php check_valid($row->diem); ?></td>
                            </tr>
                        <?php $cnt = $cnt + 1;
                          }
                        } ?>
                      </tbody>
                      <tfoot>
                        
                        <tr>
                          <?php
                          $sql_count_mh = "SELECT count(mh.id) as tongmon from tblstudent sv
                          inner join tbl_ketqua as kq  on kq.masv=sv.ID
                          inner join tbl_monhoc as mh on mh.id = kq.mamon
                          where sv.stuID=$sid";
                          $query_count_mh = $dbh->prepare($sql_count_mh);
                          $query_count_mh->execute();
                          $results_count_mh = $query_count_mh->fetchAll(PDO::FETCH_OBJ);
                           ?>
                          <td scope="col" colspan="4" style="font-weight: 700;">Tổng số môn đã học:</td>
                          <td scope="col"><?php echo $results_count_mh[0]->tongmon ?> môn</td>
                        </tr>
                        <tr>
                        <?php
                          $sql_sum_tc = "SELECT sum(mh.sotc) as tongtc from tblstudent sv
                          inner join tbl_ketqua as kq  on kq.masv=sv.ID
                          inner join tbl_monhoc as mh on mh.id = kq.mamon
                          where sv.stuID=$sid";
                          $query_sum_tc = $dbh->prepare($sql_sum_tc);
                          $query_sum_tc->execute();
                          $results_sum_tc = $query_sum_tc->fetchAll(PDO::FETCH_OBJ);
                        ?>
                          <td scope="col" colspan="4" style="font-weight: 700;">Tổng số tín chỉ:</td>
                          <td scope="col"><?php echo $results_sum_tc[0]->tongtc ?> tín chỉ</td>
                        </tr>
                        <tr>
                          <?php $tongsotc = $results_sum_tc[0]->tongtc;
                          $tong = 0;
                          foreach ($results as $row) { 
                            $diemmon = $row->diem;
                            $tcmon = $row->sotc;
                            $tong += $diemmon * $tcmon;
                          } ?>
                            
                          <td scope="col" colspan="4" style="font-weight: 700;">Điểm trung bình:</td>
                          <td scope="col">
                          <?php 
                          $diemtb = number_format((float)($tong / $tongsotc) , 2, '.', ''); 
                          echo $diemtb;
                          ?> 
                          </td>
                        </tr>
                        <tr>
                          <td scope="col" colspan="4" style="font-weight: 700;">Xếp loại:</td>
                          <td scope="col"><?php echo check_rank($diemtb) ?></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include_once('includes/footer.php'); ?>
          <!-- partial -->
        </div>
        <?php include_once('includes/footer.php'); ?>
      </div>
    </div>
    </div>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>

  </html><?php }  ?>