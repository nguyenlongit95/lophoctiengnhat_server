<div id="right-menu" class="clearfix">
    <a class="right-link long" href="{{ url('/') }}">
        <span class="right-link-inner">
            <span class="right-link-content">
                <span class="fa fa-home font-size-35 float-left"></span>
                <span class="right-txt margin-left-15">
                    <span class="right-big">Trang Chủ</span> <br>
                    <span class="right-small margin-left-15">Truy cập từ trang chủ</span>
                </span>
            </span>
        </span>
    </a>
    @if(\Illuminate\Support\Facades\Auth::check() == false)
    <a class="right-link short cre-show" href="javascript:;" onclick="alert('Vui lòng đăng nhập để thực hiện chức năng này.'); return false">
    @else
    <a class="right-link short cre-show" @if(\Illuminate\Support\Facades\Auth::user()->role == 2) href="#" onclick="showModalPayGates()" @else href="#" onclick="alert('Hãy đăng nhập với tài khoản khách hàng');" @endif>
    @endif
        <span class="right-link-inner">
            <span class="right-link-content">
                <span class="fa fa-coins font-size-35 float-left"></span>
                <span class="right-txt margin-left-15">
                    <span class="right-big">Nạp credit</span> <br>
                    <span class="right-small margin-left-15">Nạp thêm tiền vào tài khoản</span>
                </span>
            </span>
        </span>
    </a>
    @if(\Illuminate\Support\Facades\Auth::check())
        <a class="right-link short vip-show" href="{{ url('logout') }}">
    @else
        <a class="right-link short vip-show" href="{{ url('/login') }}">
    @endif
        <span class="right-link-inner">
            <span class="right-link-content">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <span class="fa fa-sign-out-alt font-size-35 float-left"></span>
                @else
                    <span class="fa fa-star font-size-35 float-left"></span>
                @endif
                <span class="right-txt margin-left-15">
                    @if(\Illuminate\Support\Facades\Auth::check())
                    <span class="right-big">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span> <br>
                    <span class="right-small margin-left-15">{{ \Illuminate\Support\Facades\Auth::user()->email }}</span>
                    @else
                    <span class="right-big">Đăng nhập</span> <br>
                    <span class="right-small margin-left-15">Đăng nhập</span>
                    @endif
                </span>
            </span>
        </span>
    </a>
</div>
