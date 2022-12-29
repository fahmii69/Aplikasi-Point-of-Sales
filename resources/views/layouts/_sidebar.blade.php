<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset( 'AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                {{-- Transaction --}}
                <li class="nav-header">Transaction</li>
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                            Sales
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>
                            Sales History
                        </p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Open/Close
                        </p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-alt"></i>
                        <p>
                            Cash Management
                        </p>
                    </a>
                </li>
                {{-- /Transaction --}}

                {{-- Master Data --}}
                <li class="nav-header">Master Data</li>
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fa fa-tags"></i>
                        <p>Products</p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Stocks</p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="{{ route('supplier.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Supplier</p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Member</p>
                    </a>
                </li>
				{{-- /Master Data --}}

				{{-- Utilites --}}
                <li class="nav-header">Utilites</li>
				<li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Setting</p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Documentation</p>
                    </a>
                </li>
				{{-- /Utilites --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
