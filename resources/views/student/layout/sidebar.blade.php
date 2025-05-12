<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        
        <!-- Quizzes -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('student.quizzes.index') }}">
              <i class="fas fa-question-circle me-2"></i>
              <span class="menu-title">My Quizzes</span>
          </a>
        </li>
        
        <!-- Assignments -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('student.assignments.index') }}">
              <i class="fas fa-tasks me-2"></i>
              <span class="menu-title">My Assignments</span>
          </a>
        </li>
  
        

        <!-- Courses (commented out) -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.courses.index') }}">
    <i class="fa-solid fa-book  menu-icon"></i> 
                    <span class="menu-title">My Subjects</span>
            </a>
        </li> 
         
    </ul>
  </nav>