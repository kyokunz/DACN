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
    $sql = "delete from tbl_lophoc where id=:rid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_INT);
    $query->execute();
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'manage-class.php'</script>";
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
              <h3 class="page-title"> Quản lý lớp học </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Tổng quan</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Quản lý lớp học</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                      <h4 class="card-title mb-sm-0">Quản lý lớp học</h4>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="font-weight-bold">STT</th>
                            <th class="font-weight-bold">Tên Lớp</th>
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
                          $ret = "SELECT id FROM tbl_lophoc";
                          $query1 = $dbh->prepare($ret);
                          $query1->execute();
                          $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                          $total_rows = $query1->rowCount();
                          $total_pages = ceil($total_rows / $no_of_records_per_page);
                          $sql = "SELECT lh.id, lh.tenlop, kh.tenkhoa from tbl_lophoc as lh inner join tbl_khoa as kh on kh.id = lh.khoa LIMIT $offset, $no_of_records_per_page";
                          $query = $dbh->prepare($sql);
                          $query->execute();
                          $results = $query->fetchAll(PDO::FETCH_OBJ);

                          $cnt = 1;
                          if ($query->rowCount() > 0) {
                            foreach ($results as $row) { ?>
                              <tr>
                                <td><?php echo htmlentities($cnt); ?></td>
                                <td><?php echo htmlentities($row->tenlop); ?></td>
                                <td><?php echo htmlentities($row->tenkhoa); ?></td>
                                <td>
                                  <div>
                                    <a class="btn btn-info btn-sm mr-2" href="edit-class-detail.php?editid=<?php echo htmlentities($row->id); ?>">
                                      <i class="icon-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger" href="manage-class.php?delid=<?php echo ($row->id); ?>" onclick="return confirm('Bạn có chắc muốn xóa ?');"> <i class="icon-trash"></i></a>
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
          <?php include_once('includes/footer.php'); ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
    </div>
    <?php include('footer.php') ?>
  <?php }  ?>