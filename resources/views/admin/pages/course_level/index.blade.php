@extends('admin.master')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('/css/CustomStyle.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Danh sách các khoá học</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <section class="content">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    <thead class="background-blue color-white">
                    <th>
                    <td>Tên</td>
                    <td>Định danh</td>
                    <td class="text-center">Thao tác</td>
                    </th>
                    </thead>
                    <tbody>
                    @if(!empty($courses))
                        @foreach($courses as $course)
                            <tr>
                                <td class="text-center">{{ $course->id }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->slug }}</td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/course-level/'.$course->id.'/edit') }}"><i class="fas fa-edit"></i></a> |
                                    <a href="{{ url('/admin/course-level/'.$course->id.'/delete') }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 float-right">
                <a href="{{ url('/admin/course-level/create') }}" class="btn btn-primary pull-right">Tạo khoá học mới</a>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')

@endsection
