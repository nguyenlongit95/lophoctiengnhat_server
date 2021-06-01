@extends('frontend.master')
@section('content')
    <section class="about font-medium" id="about">
        <div id="main-content-section">
            <!-- Content lession began -->
            <div id="lession-content">
                <form class="form-group" method="POST" action="{{ url('/hoc-vien/update') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('/source/images/avatar/' . \Illuminate\Support\Facades\Auth::user()->avatar) }}" class="img-avatar" alt="">
                        <input class="hidden" type="file" id="avatar" name="avatar" value="{{ $user->avatar }}">
                        <span class="padding-left-25">Click vào <label for="avatar" class="text-danger">đây</label> để thay avatar</span>
                    </div>
                    <div class="col-md-5 padding-top-20">
                        <div class="form-group">
                            <label for="name">Họ tên:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                        </div>
                        <div class="form-group">
                            <label for="gender">Giới tính</label>
                            <select name="gender" id="gender" class="form-control">
                                <option @if($user->gender == 0) selected @endif value="0">Nam</option>
                                <option @if($user->gender == 1) selected @endif value="1">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="col-md-5 padding-top-20">
                        <div class="form-group">
                            <label for="birth_day">Ngày sinh: {{ \Carbon\Carbon::create($user->birth_day)->format('d/m/Y') }}</label>
                            <input type="date" class="form-control" id="birth_day" name="birth_day" value="{{ \Carbon\Carbon::create($user->birth_day)->format('d/m/Y') }}">
                        </div>
                        <div class="form-group">
                            <label for="school">Trường học:</label>
                            <input type="text" class="form-control" name="school" id="school" value="{{ $user->school }}">
                        </div>
                        <div class="form-group">
                            <label for="job">Nghề nghiệp:</label>
                            <input type="text" class="form-control" id="job" name="job" value="{{ $user->job }}">
                        </div>
                        <div class="form-group text-right padding-top-20">
                            <button class="btn btn-primary" type="submit">Câp nhật</button>
                            <button class="btn btn-warning" type="reset">Làm mới</button>
                        </div>
                    </div>
                    <div class="col-md-12 text-center list-style-none">
                        @include('admin.layouts.errors')
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

@section('custom-js')
    <style>
        .list-style-none ul li {
            list-style: none;
        }
    </style>
@endsection
