<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('img/classtrack_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light"><b>Class</b>Track</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">STUDENTS</li>
                <li class="nav-item">
                    <a href="{{ route('teacher.student') }}" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>My Students</p>
                    </a>
                </li>
                <li class="nav-header">ATTENDANCE</li>
                <li class="nav-item">
                    <a href="{{ route('attendance.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Manage Attendance</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendance.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-pencil-alt"></i>
                        <p>Record Attendance</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendance.view') }}" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>All Student Attendance</p>
                    </a>
                </li>
                <li class="nav-header">REPORT</li>
                <li class="nav-item">
                    <a href="{{ route('attendance.todayReport') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-csv"></i>
                        <p>Today's Report (csv)</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>