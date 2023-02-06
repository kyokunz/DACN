<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $kname = $_POST['kname'];
    $ghichu = $_POST['ghichu'];
    $eid = intval($_GET['editid']);

    $sql = "update tbl_khoa set tenkhoa=:kname, ghichu=:ghichu where id=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':kname', $kname, PDO::PARAM_STR);
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
              <h3 class="page-title"> Cập nhật thông tin khoa </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Tổng quan</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Cập nhật thông tin khoa</li>
                </ol>
              </nav>
            </div>
            <div class="row">

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Cập nhật thông tin khoa</h4>

                    <form class="forms-sample" method="post">
                      <?php
                      $eid = intval($_GET['editid']);
                      $sql = "SELECT * from tbl_khoa where id=$eid";

                      $query = $dbh->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);

                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($results as $row) {               ?>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Tên khoa</label>
                                <input type="text" name="kname" value="<?php echo htmlentities($row->tenkhoa); ?>" class="form-control" required='true'>
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