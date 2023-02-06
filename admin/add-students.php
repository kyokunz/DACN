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
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $stuid = $_POST['stuid'];
    $connum = $_POST['connum'];
    $address = $_POST['address'];
    $uname = $_POST['uname'];
    $password = md5($_POST['password']);
    $image = $_FILES["image"]["name"];
    $ret = "select UserName from tblstudent where UserName=:uname || StuID=:stuid";
    $query = $dbh->prepare($ret);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() == 0) {
      $extension = substr($image, strlen($image) - 4, strlen($image));
      $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
      if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Ảnh sai format. Chỉ nhận đuôi jpg / jpeg/ png /gif');</script>";
      } else {
        $image = md5($image) . time() . $extension;
        move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $image);
        $sql = "insert into tblstudent(StudentName,StudentEmail,StudentClass,Gender,DOB,StuID,ContactNumber,Address,UserName,Password,Image)values(:stuname,:stuemail,:stuclass,:gender,:dob,:stuid,:connum,:address,:uname,:password,:image)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':stuname', $stuname, PDO::PARAM_STR);
        $query->bindParam(':stuemail', $stuemail, PDO::PARAM_STR);
        $query->bindParam(':stuclass', $stuclass, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
        $query->bindParam(':connum', $connum, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':uname', $uname, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->execute();
        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
          echo '<script>alert("Thêm thành công")</script>';
          echo "<script>window.location.href ='add-students.php'</script>";
        } else {
          echo '<script>alert("Thêm thất bại! Vui lòng thử lại sau")</script>';
        }
      }
    } else {
      echo "<script>alert('Mã sinh viên hoặc tài khoản đã tồn tại');</script>";
    }
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
              <h3 class="page-title"> Thêm sinh viên </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Thêm sinh viên</li>
                </ol>
              </nav>
            </div>
            <div class="row">

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Thêm sinh viên</h4>

                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Tên sinh viên</label>
                            <input type="text" name="stuname" value="" class="form-control" required='true'>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Mã sinh viên</label>
                            <input type="text" name="stuid" value="" class="form-control" required='true'>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Email</label>
                            <input type="text" name="stuemail" value="" class="form-control" required='true'>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputEmail3">Lớp học</label>
                            <select name="stuclass" class="form-control" required='true'>
                              <option value="">Chọn lớp</option>
                              <?php

                              $sql2 = "SELECT * from  tbl_lophoc ";
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
                            <label for="exampleInputName1">Giới tính</label>
                            <select name="gender" value="" class="form-control" required='true'>
                              <option value="">Chọn giới tính</option>
                              <option value="Nam">Nam</option>
                              <option value="Nữ">Nữ</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Ngày sinh</label>
                            <input type="date" name="dob" value="" class="form-control" required='true'>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Ảnh cá nhân</label>
                            <input type="file" name="image" value="" class="form-control" required='true'>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Điện thoại</label>
                            <input type="text" name="connum" value="" class="form-control" required='true' maxlength="10" pattern="[0-9]+">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Địa chỉ</label>
                            <textarea name="address" class="form-control" required='true'></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Tài khoản</label>
                            <input type="text" name="uname" value="" class="form-control" required='true'>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Mật khẩu</label>
                            <input type="Password" name="password" value="" class="form-control" required='true'>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-primary mr-2" name="submit">Thêm</button>
                        </div>
                      </div>
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