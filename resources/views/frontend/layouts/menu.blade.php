<div class="header">
    <nav class="navbar navbar-default">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <nav>
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{ url('/') }}">Trang chủ</a>
                    </li>
                    @if(isset($masterMenus) && !empty($masterMenus))
                        @foreach($masterMenus as $masterMenu)
                            <li>
                                <a data-toggle="dropdown" href="{{ url($masterMenu->slug) }}">{{ $masterMenu->name }} <span class="caret"></span></a>
                                @if(isset($childMenus) && !empty($childMenus))
                                <ul class="dropdown-menu">
                                    @foreach($childMenus as $childMenu)
                                        @if($childMenu->parent_id == $masterMenu->id)
                                            <li><a href="{{ url($masterMenu->slug . '/' . $childMenu->slug) }}">{{ $childMenu->name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                        @endforeach
                    @endif
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::check() == true)
                            <a href="{{ url('/hoc-vien/thong-tin') }}">Tài khoản của tôi</a>
                        @else
                            <a href="{{ url('/register') }}">Đăng ký</a>
                        @endif
                    </li>
                </ul>
            </nav>
        </div>
        <div class="clearfix"> </div>
    </nav>
</div>
