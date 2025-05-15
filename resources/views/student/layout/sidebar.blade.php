<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.dashboard') }}">
            <i class="fa-solid fa-house menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        
        <!-- Quizzes -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('student.quizzes.index') }}">
              <i class="fas fa-question-circle menu-icon"></i>
              <span class="menu-title">My Quizzes</span>
          </a>
        </li>
        
        <!-- Assignments -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('student.assignments.index') }}">
              <i class="fas fa-tasks menu-icon"></i>
              <span class="menu-title">My Assignments</span>
          </a>
        </li>
  
        

        <!-- Subjects (commented out) -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student.Subjects.index') }}">
    <i class="fa-solid fa-book  menu-icon"></i> 
                    <span class="menu-title">My Subjects</span>
            </a>
        </li> 
         
    </ul>
  </nav>