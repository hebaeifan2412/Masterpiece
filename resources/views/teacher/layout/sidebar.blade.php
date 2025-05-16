<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('teacher.dashboard') }}">
            <i class="fa-solid fa-house menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        
        <!-- Quizzes -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('teacher.quizzes.index') }}">
              <i class="fas fa-question-circle  menu-icon"></i>
              <span class="menu-title">Quizzes</span>
          </a>
        </li>
        
        <!-- Courses -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('teacher.classes.index') }}">
              <i class="fa-solid fa-door-open   menu-icon"></i>
              <span class="menu-title">Classes</span>
          </a>
        </li>
    
        <!-- Student Marks -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.marks.index') ? 'active' : '' }}" href="{{ route('teacher.marks.index') }}">
               <i class="fas fa-chart-bar menu-icon"></i>
              <span class="menu-title">Student Marks</span>
          </a>
        </li>
  
        <!-- Assignment -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('teacher.assignments.index') }}">
              <i class="fas fa-tasks  menu-icon"></i>
              <span class="menu-title">Assignments</span>
          </a>
        </li>
    </ul>
  </nav>