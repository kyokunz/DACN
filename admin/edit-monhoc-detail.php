<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $mname = $_POST['mname'];
    $khoa = $_POST['khoa'];
    $ghichu = $_POST['ghichu'];
    $eid = intval($_GET['editid']);

    $sql = "update tbl_monhoc set tenmon=:mname,sotc:=sotc ,khoa=:khoa, ghichu=:ghichu where id=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':mname', $mname, PDO::PARAM_STR);
    $query->bindParam(':khoa', $khoa, PDO::PARAM_INT);
    $query->bindParam(':ghichu', $ghichu, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Cập nhật thành công")</script>';
  }

?>
  <?php include('header.php') ?>

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
              <h3 class="page-title"> Cập nhật thông tin môn học </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Tổng quan</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Cập nhật thông tin môn học</li>
                </ol>
              </nav>
            </div>
            <div class="row">

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Cập nhật thông tin môn học</h4>

                    <form class="forms-sample" method="post">
                      <?php
                      $eid = intval($_GET['editid']);
                      $sql = "SELECT * from tbl_monhoc where id=$eid";

                      $query = $dbh->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);

                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($results as $row) {               ?>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Tên môn</label>
                                <input type="text" name="mname" value="<?php echo htmlentities($row->tenmon); ?>" class="form-control" required='true'>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Số tín chỉ</label>
                                <input type="text" name="sotc" value="<?php echo htmlentities($row->sotc); ?>" class="form-control" required='true'>
                              </div>
                            </div>
                            <?php
                            $sql_khoa = "SELECT tenkhoa from tbl_khoa where id=$row->khoa";
                            $query_khoa = $dbh->prepare($sql_khoa);
                            $query_khoa->execute();
                            $results_khoa = $query_khoa->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputEmail3">Khoa</label>
                                <select name="khoa" class="form-control" required='true'>

                                  <option selected value="<?php echo htmlentities($row->id); ?>">
                                    <?php echo htmlentities($results_khoa[0]->tenkhoa); ?>
                                  </option>
                                  <?php
                                  $sql2 = "SELECT * from tbl_khoa";
                                  $query2 = $dbh->prepare($sql2);
                                  $query2->execute();
                                  $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                  foreach ($result2 as $row1) {
                                  ?>
                                    <option value="<?php echo htmlentities($row1->id); ?>"><?php echo htmlentities($row1->tenkhoa); ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Ghi chú</label>
                                <input type="text" name="ghichu" value="<?php echo htmlentities($row->ghichu); ?>" class="form-control">
                              </div>
                            </div>
                          </div>

                      <?php $cnt = $cnt + 1;
                        }
                      } ?>
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Cập nhật</button>

                    </form>
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
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>

  </html><?php }  ?>