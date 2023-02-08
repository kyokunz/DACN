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
    $sql = "delete from tblstudent where ID=:rid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Xóa thành công');</script>";
    echo "<script>window.location.href = 'manage-students.php'</script>";
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
              <h3 class="page-title"> Quản lý sinh viên </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Tổng quan</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Quản lý sinh viên</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                      <h4 class="card-title mb-sm-0">Quản lý sinh viên</h4>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="font-weight-bold">STT</th>
                            <th class="font-weight-bold">Ảnh</th>
                            <th class="font-weight-bold">Tên sinh viên</th>
                            <th class="font-weight-bold">Mã sinh viên</th>
                            <th class="font-weight-bold">Ngày sinh</th>
                            <th class="font-weight-bold">Lớp</th>
                            <th class="font-weight-bold">Khoa</th>
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
                          $sql = "SELECT sv.StudentName, sv.StuID, sv.DOB, lh.tenlop,kh.tenkhoa, sv.Image, sv.ID from tblstudent as sv 
                          inner join tbl_lophoc as lh on lh.id = sv.StudentClass
                          inner join tbl_khoa as kh on kh.id = lh.khoa
                           LIMIT $offset, $no_of_records_per_page";
                          $query = $dbh->prepare($sql);
                          $query->execute();
                          $results = $query->fetchAll(PDO::FETCH_OBJ);

                          $cnt = 1;
                          if ($query->rowCount() > 0) {
                            foreach ($results as $row) {               ?>
                              <tr>

                                <td><?php echo htmlentities($cnt); ?></td>
                                <td><img style="height: 60px; width: 60px;" src="./images/<?php echo htmlentities($row->Image); ?>" /></td>
                                <td><?php echo htmlentities($row->StudentName); ?></td>
                                <td><?php echo htmlentities($row->StuID); ?></td>
                                <td><?php echo htmlentities($row->DOB); ?></td>
                                <td><?php echo htmlentities($row->tenlop); ?></td>
                                <td><?php echo htmlentities($row->tenkhoa); ?></td>
                                <td>
                                  <div><a class="btn btn-sm btn-info mr-2" href="edit-student-detail.php?editid=<?php echo htmlentities($row->ID); ?>"><i class="icon-eye"></i></a>
                                    <a class="btn btn-sm btn-danger" href="manage-students.php?delid=<?php echo ($row->ID); ?>" onclick="return confirm('Bạn có chắc muốn xóa ?');"> <i class="icon-trash"></i></a>
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
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>

  </html><?php }  ?>