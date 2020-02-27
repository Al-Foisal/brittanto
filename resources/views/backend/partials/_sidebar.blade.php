<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->is('/dashboard') ? 'active' : '' }}" >
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        
        {{-- for student menu --}}
        <li class="nav-item {{ request()->is('/coaching-students/*') ? 'active' : '' }}" >
            <a class="nav-link" href="{{ route('coaching-students.index') }}">
                <i class="material-icons md-18">people</i>
                <span class="menu-title">Students</span>
            </a>
        </li>
        

        {{-- for employees  menu --}}
        <li class="nav-item {{ request()->is('/coaching-employees') ? 'active' : '' }}" >
            <a class="nav-link" href="{{ route('coaching-employees.index') }}">
                <i class="material-icons md-18">supervisor_account</i>
                <span class="menu-title">Employees</span>
            </a>
        </li>


        {{-- for owners  menu --}}
        <li class="nav-item {{ request()->is('/coaching-owners') ? 'active' : '' }}" >
            <a class="nav-link" href="{{ route('coaching-owners.index') }}">
                <i class="material-icons md-18">person</i>
                <span class="menu-title">Owners</span>
            </a>
        </li>


        {{-- for batch  menu --}}
        <li class="nav-item {{-- {{ request()->is('/coaching-sections/*') ? 'active' : '' }} --}}" >
            <a class="nav-link" href="{{ route('coaching-sections.index') }}">
                <i class="material-icons md-18">event_note</i>
                <span class="menu-title">Batch</span>
            </a>
        </li>

        {{-- for batch  exam --}}
        <li class="nav-item {{-- {{ request()->is('/coaching-sections/*') ? 'active' : '' }} --}}" >
            <a class="nav-link" href="{{ route('coaching-exam-titles.index') }}">
                <i class="material-icons md-18">event_note</i>
                <span class="menu-title">Exam Area</span>
            </a>
        </li>

        {{-- for money receipt  menu --}}
        <li class="nav-item {{ request()->is('/coaching-proceeds/*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#proceed" aria-expanded="false" aria-controls="proceed">
                <i class="material-icons md-18">attach_money</i>
                <span class="menu-title"> Money Recept</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="proceed">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('coaching-proceeds.index') }}">Receipt Format</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('coaching-proceeds.create') }}">Make Receipt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('proceed.show') }}">Receipt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('proceed.paid') }}">Paid Receipt</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- for salary  menu --}}

        {{-- for voucher  menu --}}
        <li class="nav-item {{-- {{ request()->is('/coaching-proceeds/*') ? 'active' : '' }} --}}">
            <a class="nav-link" data-toggle="collapse" href="#voucher" aria-expanded="false" aria-controls="voucher">
                <i class="material-icons md-18">attach_money</i>
                <span class="menu-title"> Finance </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="voucher">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('voucher.show') }}">Voucher</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cost.sheet') }}">Cost Sheet</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('ES') }}"> Edu. Solutions </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('popular-courses.index') }}"> Courses </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('upcoming-events.index') }}"> Events </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('notice-boards.index') }}"> Notice Board </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('mission-and-visions.index') }}"> Mission and Vision </a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('docs') }}" target="_blank">
                <i class="ti-write menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>

