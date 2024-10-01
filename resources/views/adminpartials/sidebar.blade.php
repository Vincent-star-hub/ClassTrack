<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('img/classtrack_logo.png') }}" alt="ClassTrack Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light"><b>Class</b>Track</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Manage Classes Section -->
                <li class="nav-header">CLASS AND SECTIONS</li>
                <li class="nav-item">
                    <a href="{{ route('classes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>Manage Classes</p>
                    </a>
                </li>

                <!-- Manage Sections Section -->
                <li class="nav-item">
                    <a href="{{ route('sections.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>Manage Sections</p>
                    </a>
                </li>

                <!-- Manage Admins Section -->
                <li class="nav-header">ADMINS</li>
                <li class="nav-item">
                    <a href="{{ route('admin.admins.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Manage Admins</p>
                    </a>
                </li>

                <!-- Manage Teachers Section -->
                <li class="nav-header">TEACHERS</li>
                <li class="nav-item">
                    <a href="{{ route('admin.teachers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Manage Teachers</p>
                    </a>
                </li>

                <!-- Manage Students Section -->
                <li class="nav-header">STUDENTS</li>
                <li class="nav-item">
                    <a href="{{ route('students.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Manage Students</p>
                    </a>
                </li>

                <!-- Manage Session & Term Section -->
                <li class="nav-header">SESSION & TERM</li>
                <li class="nav-item">
                    <a href="{{ route('sessionterm.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Manage Session & Term</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>