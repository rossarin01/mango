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
            <span class="app-brand-text demo menu-text fw-bold">Emp</span>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

        <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
                <a href="{{ route('empprofile.roster') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calendar"></i>
                    <div data-i18n="dashboard">Roster</div>
                </a>
            </li>
            <!-- Dashboards -->

            <li class="menu-item">
                <a href="{{ route('empprofile.profile') }}" class="menu-link">
                    <i class="ti ti-user-check me-2 ti-sm"></i>
                    <div data-i18n="dashboard">Profile</div>
                </a>
            </li>

            <!-- List of Employees -->
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"
                        stroke="currentColor" stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-clock-hour-1" style="margin-right:5px;">moneytime
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M12 7v5" /><path d="M12 12l2 -3"  />
                    </svg>
                    <div data-i18n="list of employees">CheckIn & CheckOut</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('empprofile.checkincheckout') }}" class="menu-link">
                            <div data-i18n="roster">CheckIn & CheckOut</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                            <div data-i18n="roster">History Request</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- List of Employees -->

            <!-- Calculate Salaries -->
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link">
                    {{-- <i class="menu-icon tf-icons ti ti-calculator"></i> --}}
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"
                        stroke="currentColor"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-currency-dollar" style="margin-right:5px;">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                        <path d="M12 3v3m0 12v3" />
                    </svg>
                    <div data-i18n="calculate salaries">Salary</div>
                </a>
            </li>
            <!-- Calculate Salaries -->



            {{-- End OAT --}}


        </ul>

</aside>
