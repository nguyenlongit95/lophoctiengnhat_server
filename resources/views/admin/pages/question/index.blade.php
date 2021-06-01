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
                        <h1 class="m-0 text-dark">Danh sách đề thi</h1>
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
                    @if(!empty($questions))
                        @foreach($questions as $key => $question)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $question->name }}</td>
                                <td>{{ $question->slug }}</td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/question/'.$question->id.'/edit') }}"><i class="fas fa-edit"></i></a> |
                                    <a href="{{ url('/admin/question/'.$question->id.'/delete') }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 float-right">
                <a href="{{ url('/admin/question/create') }}" class="btn btn-primary pull-right">Tạo đề thi mới</a>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')

@endsection
