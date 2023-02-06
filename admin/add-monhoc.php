<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $tenmon = $_POST['cname'];
    $sotc = $_POST['sotc'];
    $khoa = $_POST['khoa'];
    $ghichu = $_POST['ghichu'];
    $sql = "insert into tbl_monhoc(tenmon,sotc,khoa,ghichu)values(:tenmon,:sotc,:khoa,:ghichu)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':tenmon', $tenmon, PDO::PARAM_STR);
    $query->bindParam(':sotc', $sotc, PDO::PARAM_INT);
    $query->bindParam(':khoa', $khoa, PDO::PARAM_INT);
    $query->bindParam(':ghichu', $ghichu, PDO::PARAM_STR);
    $query->execute();
    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
      echo '<script>alert("Thêm thành công.")</script>';
      echo "<script>window.location.href ='add-monhoc.php'</script>";
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
              <h3 class="page-title"> Thêm môn học </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Thêm môn học</li>
                </ol>
              </nav>
            </div>
            <div class="row">

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Thêm môn học</h4>
                    <form class="forms-sample" method="post">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Tên môn học</label>
                            <input type="text" name="cname" value="" class="form-control" required='true'>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="exampleInputName1">Số tín chỉ</label>
                            <input type="text" name="sotc" value="" class="form-control" required='true'>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="exampleInputEmail3">Khoa</label>
                            <select name="khoa" class="form-control" required='true'>
                              <option value="">Chọn khoa</option>
                              <?php
                              $sql2 = "SELECT * from tbl_khoa ";
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