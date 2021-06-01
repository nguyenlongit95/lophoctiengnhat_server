<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ url('/admin') }}" class="d-block">Bảng điều khiển</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ url('/admin') }}" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <p>
                        Bảng điều khiển
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-icons"></i>
                    <p>
                        Thành phần chính
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/admin/pages/index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Trang web</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/course-online/index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Học online với GV</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/course-level/index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Học theo cấp độ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/course-thematic/index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Học theo chuyên đề</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/course-free/index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Học miễn phí</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/question/index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Luyện đề online</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/documentation/index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tài liệu</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/widgets/index') }}" class="nav-link">
                    <i class="fas fa-text-width"></i>
                    <p>
                        Cài đặt chung
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-wallet"></i>
                    <p>
                        Ví điện tử
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/e-wallet/index') }}" class="nav-link">
                            <i class="fab fa-google-wallet"></i>
                            <p>Danh sách ví</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/e-wallet/logs') }}" class="nav-link">
                            <i class="fas fa-list"></i>
                            <p>Lịch sử giao dịch</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fas fa-cogs"></i>
                    <p>
                        Cấu hình hệ thống
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right">3</span>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/paygates/index') }}" class="nav-link">
                            <i class="fab fa-amazon-pay"></i>
                            <p>Cổng thanh toán</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/users/index') }}" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>Người dùng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/menus/index') }}" class="nav-link">
                            <i class="fas fa-bars"></i>
                            <p>Menus</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
