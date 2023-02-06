<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $tenkhoa = $_POST['cname'];
    $ghichu = $_POST['ghichu'];
    $sql = "insert into tbl_khoa(tenkhoa,ghichu)values(:tenkhoa,:ghichu)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':tenkhoa', $tenkhoa, PDO::PARAM_STR);
    $query->bindParam(':ghichu', $ghichu, PDO::PARAM_STR);
    $query->execute();
    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
      echo '<script>alert("Khoa đã được thêm thành công.")</script>';
      echo "<script>window.location.href ='add-khoa.php'</script>";
    } else {
      echo '<script>alert("Thêm thất bại! Vui lòng thử lại sau")</script>';
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
              <h3 class="page-title"> Thêm khoa </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Thêm khoa</li>
                </ol>
              </nav>
            </div>
            <div class="row">

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Thêm khoa</h4>
                    <form class="forms-sample" method="post">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Tên khoa</label>
                            <input type="text" name="cname" value="" class="form-control" required='true'>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Ghi chú</label>
                            <input type="text" name="ghichu" value="" class="form-control">
                          </div>
                        </div>
                      </div>

                      
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Thêm</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include_once('includes/footer.php'); ?>
        </div>
      </div>
    </div>
    <?php include('footer.php') ?>
    <?php }  ?>