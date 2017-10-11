<?php
$mode = $_SESSION['admin_mode'];
if($mode === 'teacher') {
  echo '


  <ul id="main-menu" class="gui-controls">

    <!-- BEGIN DASHBOARD -->
    <li>
      <a href="index.php" >
        <div class="gui-icon"><i class="md md-home"></i></div>
        <span class="title">Dashboard</span>
      </a>
    </li><!--end /menu-li -->
    <!-- END DASHBOARD -->


  </ul><!--end .main-menu -->
  <!-- END MAIN MENU -->

  <div class="menubar-foot-panel">
    <small class="no-linebreak hidden-folded">
      <span class="opacity-75">Copyright &copy; 2017</span> <strong>Hilger Higher Learning</strong>
    </small>
  </div>
  </div><!--end .menubar-scroll-panel-->
  </div><!--end #menubar-->

  ';

} elseif ($mode === 'admin') {
  echo '


  <ul id="main-menu" class="gui-controls">

    <!-- BEGIN DASHBOARD -->
    <li>
      <a href="index.php" >
        <div class="gui-icon"><i class="md md-home"></i></div>
        <span class="title">Dashboard</span>
      </a>
    </li><!--end /menu-li -->
    <!-- END DASHBOARD -->
    <li>
      <a href="addStudent.php" >
        <div class="gui-icon"><i class="md md-edit"></i></div>
        <span class="title">Add Students</span>
      </a>
    </li><!--end /menu-li -->
    <li>
      <a href="deleteStudents.php" >
        <div class="gui-icon"><i class="md md-delete"></i></div>
        <span class="title">Delete Students</span>
      </a>
    </li><!--end /menu-li -->

  </ul><!--end .main-menu -->
  <!-- END MAIN MENU -->

  <div class="menubar-foot-panel">
    <small class="no-linebreak hidden-folded">
      <span class="opacity-75">Copyright &copy; 2017</span> <strong>Hilger Higher Learning</strong>
    </small>
  </div>
  </div><!--end .menubar-scroll-panel-->
  </div><!--end #menubar-->

  ';
}



 ?>
