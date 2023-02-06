<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="profile-image">
          <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="profile image">
          <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
          <?php
          $aid = $_SESSION['sturecmsaid'];
          $sql = "SELECT * from tbl_nguoidung where id=:aid";

          $query = $dbh->prepare($sql);
          $query->bindParam(':aid', $aid, PDO::PARAM_STR);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);

          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $row) {               ?>
              <p class="profile-name"><?php echo htmlentities($row->name); ?></p>
              <p class="designation"><?php echo htmlentities($row->email); ?></p><?php $cnt = $cnt + 1;
                                                                                }
                                                                              } ?>
        </div>

      </a>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Admin</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="dashboard.php">
        <span class="menu-title">Tổng quan</span>
        <i class="icon-screen-desktop menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Lớp học</span>
        <i class="icon-layers menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="add-class.php">Thêm lớp học</a></li>
          <li class="nav-item"> <a class="nav-link" href="manage-class.php">Quản lý lớp học</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
        <span class="menu-title">Sinh viên</span>
        <i class="icon-people menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic1">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="add-students.php">Thêm sinh viên</a></li>
          <li class="nav-item"> <a class="nav-link" href="manage-students.php">Quản lý sinh viên</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#khoa" aria-expanded="false" aria-controls="khoa">
        <span class="menu-title">Khoa</span>
        <i class="icon-doc menu-icon"></i>
      </a>
      <div class="collapse" id="khoa">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="add-khoa.php"> Thêm khoa </a></li>
          <li class="nav-item"> <a class="nav-link" href="manage-khoa.php"> Quản lý khoa </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ql-mon" aria-expanded="false" aria-controls="ql-mon">
        <span class="menu-title">Môn học</span>
        <i class="icon-doc menu-icon"></i>
      </a>
      <div class="collapse" id="ql-mon">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="add-monhoc.php"> Thêm môn học </a></li>
          <li class="nav-item"> <a class="nav-link" href="manage-monhoc.php"> Quản lý môn học </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ql-diem" aria-expanded="false" aria-controls="ql-diem">
        <span class="menu-title">Quản lý điểm</span>
        <i class="icon-layers menu-icon"></i>
      </a>
      <div class="collapse" id="ql-diem">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="add-diem.php">Thêm điểm</a></li>
          <li class="nav-item"> <a class="nav-link" href="manage-diem.php">Quản lý điểm sinh viên</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>