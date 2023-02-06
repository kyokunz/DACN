 <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
          <a class="navbar-brand brand-logo" href="dashboard.php">
            <strong style="color: white;">SMS</strong>
          </a>
         
        </div>
        <?php
         $uid= $_SESSION['sturecmsuid'];
$sql="SELECT * from tblstudent where ID=:uid";

$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Chào mừng <?php  echo htmlentities($row->StudentName);?></h5>
          <ul class="navbar-nav navbar-nav-right ml-auto">
           
        
      
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">

                <img class="img-xs rounded-circle ml-2" src="../admin/images/<?php echo $row->Image; ?>" alt="Profile image"> <span class="font-weight-normal"> <?php  echo htmlentities($row->StudentName);?> </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="../admin/images/<?php echo $row->Image; ?>" width="200" height="200" alt="Profile image">

                  <p class="mb-1 mt-3"><?php  echo htmlentities($row->StudentName);?></p>
                  <p class="font-weight-light text-muted mb-0"><?php  echo htmlentities($row->StudentEmail);?></p><?php $cnt=$cnt+1;}} ?>
                </div>
                <a class="dropdown-item" href="student-profile.php"><i class="dropdown-item-icon icon-user text-primary"></i> Thông tin cá nhân</a>
                <a class="dropdown-item" href="change-password.php"><i class="dropdown-item-icon icon-energy text-primary"></i> Cài đặt</a>
                <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon icon-power text-primary"></i>Đăng xuất</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>