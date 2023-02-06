<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="profile-image">
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
                  <img class="img-xs rounded-circle" src="../admin/images/<?php echo $row->Image; ?>" alt="profile image">
                </form>
          <?php $cnt = $cnt + 1;
            }
          } ?>
          <!-- <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="profile image"> -->
          <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
          <?php
          $uid = $_SESSION['sturecmsuid'];
          $sql = "SELECT * from tblstudent where ID=:uid";

          $query = $dbh->prepare($sql);
          $query->bindParam(':uid', $uid, PDO::PARAM_STR);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);

          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $row) {               ?>
              <p class="profile-name"><?php echo htmlentities($row->StudentName); ?></p>
              <p class="designation"><?php echo htmlentities($row->StudentEmail); ?></p><?php $cnt = $cnt + 1;
                                                                                      }
                                                                                    } ?>
        </div>
      </a>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">User</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="dashboard.php">
        <span class="menu-title">Thông tin cá nhân</span>
        <i class="icon-screen-desktop menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="diem.php">
        <span class="menu-title">Điểm</span>
        <i class="icon-book-open menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>