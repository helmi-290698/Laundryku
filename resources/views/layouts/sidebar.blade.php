<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ url('/dashboard') }}" class="waves-effect">
                        <i class="ti-home"></i><span class="badge rounded-pill bg-primary float-end">2</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/laundry') }}" class=" waves-effect">
                        <i class="ti-receipt"></i>
                        <span>Input Data</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/pembayaran') }}" class=" waves-effect">
                        <i class="ti-money"></i>
                        <span>Pembayaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/datalaundry') }}" class=" waves-effect">
                        <i class="ti-view-grid"></i>
                        <span>Laundry</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/consument') }}" class=" waves-effect">
                        <i class="ti-user"></i>
                        <span>Data Konsumen</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-settings"></i>
                        <span>Data Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/item_laundry') }}">Item Laundry</a></li>
                        <li><a href="{{ url('/item_paket') }}">Item Paket</a></li>
                        <li><a href="{{ url('/tipelaundry') }}">Tipe Laundry</a></li>
                    </ul>
                </li>




            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
