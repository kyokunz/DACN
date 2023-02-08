<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  // Code for deletion
  if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = "delete from tbl_ketqua where id=:rid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_INT);
    $query->execute();
    echo "<script>alert('Xóa thành công');</script>";
    echo "<script>window.location.href = 'manage-diem.php'</script>";
  }
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <title>Student Management System|||Manage Students</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->

  </head>

  <body>
    <?php
      function convert_point_to_text($point){
        if($point < 4.0 ){
          echo 'F';
        } elseif ($point >= 4.0 & $point <= 4.9 ){
          echo 'D+';
        } elseif ($point >= 5.0 & $point <= 5.4 ){
          echo 'D';
        } elseif ($point >= 5.5 & $point <= 6.4 ){
          echo 'C';
        } elseif ($point >= 6.5 & $point <= 6.9 ){
          echo 'C+';
        }elseif ($point >= 7.0 & $point <= 7.9 ){
          echo 'B';
        }elseif ($point >= 8.0 & $point <= 8.4 ){
          echo 'B+';
        } elseif ($point >= 8.5 & $point <= 10 ){
          echo 'A';
        } else{
          echo 'Điểm không hợp lệ';
        }
      }
    ?>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include_once('includes/header.php'); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Quản lý điểm </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Tổng quan</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Quản lý điểm</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                      <h4 class="card-title mb-sm-0">Quản lý điểm</h4>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="font-weight-bold">STT</th>
                            <th class="font-weight-bold">Tên sinh viên</th>
                            <th class="font-weight-bold">Mã sinh viên</th>
                            <th class="font-weight-bold">Môn học</th>
                            <th class="font-weight-bold">Số tín chỉ</th>
                            <th class="font-weight-bold">Điểm</th>
                            <th class="font-weight-bold">Điểm chữ</th>
                            <th class="font-weight-bold">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (isset($_GET['pageno'])) {
                            $pageno = $_GET['pageno'];
                          } else {
                            $pageno = 1;
                          }
                          // Formula for pagination
                          $no_of_records_per_page = 15;
                          $offset = ($pageno - 1) * $no_of_records_per_page;
                          $ret = "SELECT ID FROM tblstudent";
                          $query1 = $dbh->prepare($ret);
                          $query1->execute();
                          $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                          $total_rows = $query1->rowCount();
                          $total_pages = ceil($total_rows / $no_of_records_per_page);
                          $sql = "SELECT sv.StudentName, sv.StuID, mh.tenmon, mh.sotc, kq.diem, kq.id FROM tbl_ketqua as kq inner join tblstudent as sv on sv.ID = kq.masv
                          inner join tbl_monhoc as mh on mh.id = kq.mamon
                           LIMIT $offset, $no_of_records_per_page";
                          $query = $dbh->prepare($sql);
                          $query->execute();
                          $results = $query->fetchAll(PDO::FETCH_OBJ);

                          $cnt = 1;
                          if ($query->rowCount() > 0) {
                            foreach ($results as $row) {               ?>
                              <tr>

                                <td><?php echo htmlentities($cnt); ?></td>
                                <td><?php echo htmlentities($row->StudentName); ?></td>
                                <td><?php echo htmlentities($row->StuID); ?></td>
                                <td><?php echo htmlentities($row->tenmon); ?></td>
                                <td class="text-center"><?php echo htmlentities($row->sotc); ?></td>
                                <td class="text-center"><?php echo htmlentities($row->diem); ?></td>
                                <td class="text-center"><?php convert_point_to_text($row->diem); ?></td>
                                <td>
                                  <div>
                                    <a class="btn btn-sm btn-danger" href="manage-diem.php?delid=<?php echo ($row->id); ?>" onclick="return confirm('Bạn có chắc muốn xóa ?');"> <i class="icon-trash"></i></a>
                                  </div>
                                </td>
                              </tr><?php $cnt = $cnt + 1;
                                  }
                                } ?>
                        </tbody>
                      </table>
                    </div>

                    <div>
                      <nav class="d-flex justify-content-center mt-4" aria-label="...">
                        <ul class="pagination">
                          <li class="page-item"><a class="page-link" href="?pageno=1"><strong>Đầu</strong></a></li>
                          <li class="page-item <?php if ($pageno <= 1) {
                                                  echo 'disabled';
                                                } ?>">
                            <a class="page-link" href="<?php if ($pageno <= 1) {
                                                          echo '#';
                                                        } else {
                                                          echo "?pageno=" . ($pageno - 1);
                                                        } ?>"><strong>Trước</strong></a>
                          </li>
                          <li class="page-item <?php if ($pageno >= $total_pages) {
                                                  echo 'disabled';
                                                } ?>">
                            <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                                                          echo '#';
                                                        } else {
                                                          echo "?pageno=" . ($pageno + 1);
                                                        } ?>"><strong>Sau</strong></a>
                          </li>
                          <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>"><strong>Cuối</strong></a></li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include_once('includes/footer.php'); ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <script src="./js/dashboard.js"></script>>
  </body>

  </html><?php }  ?>