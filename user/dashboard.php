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

    <title>Student Management System || Dashboard</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <link rel="stylesheet" href="./css/style.css">

  </head>

  <body>
    <div class="container-scroller">
      <?php include_once('includes/header.php'); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <?php include_once('includes/sidebar.php'); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Thông tin cá nhân </h3>
            </div>
            <div class="row">

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">

                    <table border="1" class="table table-bordered mg-b-0">
                      <?php
                      $sid = $_SESSION['sturecmsstuid'];
                      $sql = "SELECT * from tblstudent sv inner join tbl_lophoc as lh  on lh.id=sv.StudentClass
                      inner join tbl_khoa as kh on kh.id = lh.khoa
                       where sv.StuID=:sid";

                      $query = $dbh->prepare($sql);
                      $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($results as $row) {               ?>
                          <form>
                            <div>
                              <h3 class="text-center">Thông tin cá nhân</h3>
                            </div>
                            <div class="row">
                              <div class="col-md-6 my-3">
                                <div class="form-group">
                                  <label>Tên sinh viên: </label>
                                  <input type="text" value="<?php echo $row->StudentName; ?>" readonly class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6 my-3">
                                <div class="form-group">
                                  <label class="d-block">Ảnh cá nhân: </label>
                                  <img width="100" height="120" style="object-fit: cover;" src="../admin/images/<?php echo $row->Image; ?>" alt="img" />
                                </div>
                              </div>

                              <div class="col-md-6 my-3">
                                <div class="form-group">
                                  <label>Mã sinh viên: </label>
                                  <input type="text" value="<?php echo $row->StuID; ?>" readonly class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6 my-3">
                                <div class="form-group">
                                  <label>Ngày sinh: </label>
                                  <input type="text" value="<?php echo $row->DOB; ?>" readonly class="form-control">
                                </div>
                              </div>

                              <?php
                                $sql_lh = "SELECT tenlop from tbl_lophoc where id=$row->StudentClass";
                                $query_lh = $dbh->prepare($sql_lh);
                                $query_lh->execute();
                                $results_lh = $query_lh->fetchAll(PDO::FETCH_OBJ);
                              ?>

                              <div class="col-md-6 my-3">
                                <div class="form-group">
                                  <label>Lớp học: </label>
                                  <input type="text" value="<?php echo $results[0]->tenlop; ?>" readonly class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6 my-3">
                                <div class="form-group">
                                  <label>Khoa: </label>
                                  <input type="text" value="<?php echo $row->tenkhoa; ?>" readonly class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6 my-3">
                                <div class="form-group">
                                  <label>Email: </label>
                                  <input type="text" value="<?php echo $row->StudentEmail; ?>" readonly class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6 my-3">
                                <div class="form-group">
                                  <label>Số điện thoại: </label>
                                  <input type="text" value="<?php echo $row->ContactNumber; ?>" readonly class="form-control">
                                </div>
                              </div>

                              <div class="col-md-6 my-3">
                                <div class="form-group">
                                  <label>Địa chỉ: </label>
                                  <input type="text" value="<?php echo $row->Address; ?>" readonly class="form-control">
                                </div>
                              </div>
                            </div>
                          </form>
                      <?php $cnt = $cnt + 1;
                        }
                      } ?>
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