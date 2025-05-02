<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
  
        <!-- Users -->    
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users.index') }}" aria-expanded="false" aria-controls="teachers">
              <i class="fas fa-users menu-icon"></i>
              <span class="menu-title">Users</span>
          </a>
        </li>
       
        <!-- Teachers -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.teacher_profiles.index') }}">
              <i class="fas fa-chalkboard-teacher menu-icon"></i>
              <span class="menu-title">Teachers</span>
          </a>
        </li>

         <!-- Students -->
         <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.students.index') }}">
                <i class="fas fa-user-graduate menu-icon"></i>
                <span class="menu-title">Students</span>
            </a>
          </li>
    
     
        <!-- Subjects -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.subjects.index') }}">
              <i class="fas fa-book-open menu-icon"></i>
              <span class="menu-title">Subjects</span>
          </a>
        </li>
  
        <!-- Grades -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.grades.index') }}">
              <i class="fas fa-layer-group menu-icon"></i>
              <span class="menu-title">Grades</span>
          </a>
        </li>
  
        <!-- Classes -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.class_profiles.index') }}">
              <i class="fas fa-school menu-icon"></i>
              <span class="menu-title">Classes</span>
          </a>
        </li>
  
       
        <!-- Courses -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.courses.index') }}">
              <i class="fas fa-book menu-icon"></i>
              <span class="menu-title">Courses</span>
          </a>
        </li>
    </ul>
  </nav>