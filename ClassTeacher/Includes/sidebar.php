 <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center bg-gradient-primary justify-content-center" href="index.php">
        <div class="sidebar-brand-icon" >
          <img src="img/logo/sideBarLeftIcon.png">
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 13px;">Online Attendance System</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li> 
      <hr class="sidebar-divider">


      <div class="sidebar-heading">
        Profile 
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="fas fa-user"></i>
          <span>Manage Profile</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Profile</h6>
            <a class="collapse-item" href="profile.php">Profile</a>
            <!-- <a class="collapse-item" href="#">Member List</a> -->
          </div>
        </div>
      </li>



      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Subjects
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapassests"
          aria-expanded="true" aria-controls="collapseBootstrapassests">
          <i class="fas fa-book"></i>
          <span> Subjects</span>
        </a>
        <div id="collapseBootstrapassests" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Manage Teachers</h6> -->
            <!-- <a class="collapse-item" href="rTeacher.php">Add Teacher</a> -->
            <a class="collapse-item" href="class.php">View Subjects</a>
            <!-- <a class="collapse-item" href="createClassTeacher.php">Create Class Teachers</a>
            <a class="collapse-item" href="createClassTeacher.php">Create Class Teachers</a> -->
             <!-- <a class="collapse-item" href="createClassTeacher.php">Create Class Teachers</a> -->
              <!-- <a class="collapse-item" href="assetsCategoryList.php">Assets Category List</a>
             <a class="collapse-item" href="createAssets.php">Create Assets</a> -->
          </div>
        </div>
      </li>



      <hr class="sidebar-divider">



      <div class="sidebar-heading">
        Students
      </div>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2"
          aria-expanded="true" aria-controls="collapseBootstrap2">
          <i class="fas fa-users"></i>
          <span>Manage Students</span>
        </a>
        <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Students</h6>
            <a class="collapse-item" href="viewStudents.php">View Students</a>
            <!-- <a class="collapse-item" href="#">Assets Type</a> -->
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
      Attendance
      </div>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrapcon"
          aria-expanded="true" aria-controls="collapseBootstrapcon">
          <i class="fa fa-calendar-alt"></i>
          <span>Manage Attendance</span>
        </a>
        <div id="collapseBootstrapcon" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Attendance</h6>
            <a class="collapse-item" href="attendance.php">Take Attendance</a>
            <a class="collapse-item" href="viewAttendance.php">View Subject Attendance</a>
            <a class="collapse-item" href="viewStudentAttendance.php">View Student Attendance</a>
            <a class="collapse-item" href="report.php">Today's Report (xls)</a>
            <!-- <a class="collapse-item" href="addMemberToContLevel.php ">Add Member to Level</a> -->
          </div>
        </div>
      </li>
      

     
      <!-- <li class="nav-item">
        <a class="nav-link" href="forms.html">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Forms</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tables</h6>
            <a class="collapse-item" href="simple-tables.html">Simple Tables</a>
            <a class="collapse-item" href="datatables.html">DataTables</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ui-colors.html">
          <i class="fas fa-fw fa-palette"></i>
          <span>UI Colors</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Examples
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true"
          aria-controls="collapsePage">
          <i class="fas fa-fw fa-columns"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Example Pages</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span>
        </a>
      </li> -->
      <hr class="sidebar-divider">
      
    </ul>