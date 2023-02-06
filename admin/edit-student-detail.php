<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $stuname = $_POST['stuname'];
    $stuemail = $_POST['stuemail'];
    $stuclass = $_POST['stuclass'];
    $dob = $_POST['dob'];
    $stuid = $_POST['stuid'];
    $connum = $_POST['connum'];
    $address = $_POST['address'];
    $eid = intval($_GET['editid']);
    $sql = "update tblstudent set StudentName=:stuname,StudentEmail=:stuemail,StudentClass=:stuclass,DOB=:dob,StuID=:stuid,ContactNumber=:connum,Address=:address where ID=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':stuname', $stuname, PDO::PARAM_STR);
    $query->bindParam(':stuemail', $stuemail, PDO::PARAM_STR);
    $query->bindParam(':stuclass', $stuclass, PDO::PARAM_STR);
    $query->bindParam(':dob', $dob, PDO::PARAM_STR);
    $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
    $query->bindParam(':connum', $connum, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Cập nhập thành công")</script>';
  }

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <title>Student Management System|| Update Students</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />

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
              <h3 class="page-title"> Cập nhật thông tin sinh viên </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Tổng quan</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Cập nhật thông tin sinh viên</li>
                </ol>
              </nav>
            </div>
            <div class="row">

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Cập nhật thông tin sinh viên</h4>

                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                      <?php
                      $eid = intval($_GET['editid']);
                      $sql = "SELECT * from tblstudent where ID=$eid";

                      $query = $dbh->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);

                      $cnt = 1;
                      if ($query->rowCount() > 0) {
                        foreach ($results as $row) { ?>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Tên sinh viên</label>
                                <input type="text" name="stuname" value="<?php echo htmlentities($row->StudentName); ?>" class="form-control" required='true'>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Mã sinh viên</label>
                                <input type="text" name="stuid" value="<?php echo htmlentities($row->StuID); ?>" class="form-control" required='true'>
                              </div>
                            </div>
                            
                            <?php
                            $sql_lh = "SELECT tenlop from tbl_lophoc where id=$row->StudentClass";
                            $query_lh = $dbh->prepare($sql_lh);
                            $query_lh->execute();
                            $results_lh = $query_lh->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputEmail3">Lớp học</label>
                                <select name="stuclass" class="form-control">

                                  <option selected value="<?php echo htmlentities($row->id); ?>">
                                    <?php echo htmlentities($results_lh[0]->tenlop); ?>
                                  </option>
                                  <?php
                                  $sql2 = "SELECT * from tbl_lophoc";
                                  $query2 = $dbh->prepare($sql2);
                                  $query2->execute();
                                  $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                  foreach ($result2 as $row1) {
                                  ?>
                                    <option value="<?php echo htmlentities($row1->id); ?>"><?php echo htmlentities($row1->tenlop); ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Ngày sinh</label>
                                <input type="date" name="dob" value="<?php echo htmlentities($row->DOB); ?>" class="form-control" required='true'>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Email</label>
                                <input type="text" name="stuemail" value="<?php echo htmlentities($row->StudentEmail); ?>" class="form-control" required='true'>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Số điện thoại</label>
                                <input type="text" name="connum" value="<?php echo htmlentities($row->ContactNumber); ?>" class="form-control" required='true' maxlength="10" pattern="[0-9]+">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Địa chỉ</label>
                                <input type="text" name="address" value="<?php echo htmlentities($row->Address); ?>" class="form-control" required='true'>
                              </div>
                            </div>
                          </div>

                          <button type="submit" class="btn btn-primary mr-2" name="submit">Cập nhật</button>
                      <?php $cnt = $cnt + 1;
                        }
                      } ?>
                      

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