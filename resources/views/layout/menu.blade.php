<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo">

            <span class="app-brand-logo demo">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#bdbdbd" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M14 7l6 0" />
                  <path d="M17 4l0 6" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Admin</span>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

        <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-home"></i>
                    <div data-i18n="dashboard">Dashboard</div>
                </a>
            </li>
            <!-- Dashboards -->

            <!-- List of Employees -->
            <li class="menu-item">
                <a href="{{ route('employees.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-users-group"></i>
                    <div data-i18n="list of employees">List of Employees</div>
                </a>
            </li>
            <!-- List of Employees -->



            <!-- Work Schedules -->
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-calendar-time"></i>
                    <div data-i18n="work schedules">Work Schedules</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('rostertemplate.index') }}" class="menu-link">
                            <div data-i18n="roster">Roster Template</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('roster.index') }}" class="menu-link">
                            <div data-i18n="roster">Roster</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Work Schedules -->


            <!-- Check-In/Check-Out -->
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-clock"></i>
                    <div data-i18n="CheckIn & CheckOut">CheckIn & CheckOut</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('checkincheckout.index') }}" class="menu-link">
                            <div data-i18n="CheckIn & CheckOut">CheckIn & CheckOut</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                            <div data-i18n="Request Approved">Request Approval</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Check-In/Check-Out -->

            <!-- Calculate Salaries -->
            <li class="menu-item">
                <a href="{{ route('calculatesalary.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calculator"></i>
                    <div data-i18n="calculate salaries">Calculate Salaries</div>
                </a>
            </li>
            <!-- Calculate Salaries -->

            <!-- master -->
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-settings icon"></i>
                    <div data-i18n="master">Master</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('branch.index') }}" class="menu-link">
                            <div data-i18n="branch">Branch</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('department.index') }}" class="menu-link">
                            <div data-i18n="department">Department</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- master -->

            {{-- End OAT --}}


        </ul>

</aside>
