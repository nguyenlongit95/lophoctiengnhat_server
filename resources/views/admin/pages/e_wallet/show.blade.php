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
                        <h1 class="m-0 text-dark">Danh sách các ví</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <section class="content">
            <div class="col-md-12 float-left">
                <form action="{{ url('/admin/e-wallet/' . $id . '/update') }}" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin ví</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="col-sm-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Mã số ví</label>
                                        <input type="text" class="form-control" value="{{ $wallet->id }}" disabled="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="status">Trạng thái</label>
                                        <select name="status" class="form-control" id="status">
                                            <option @if($wallet->status == 1) selected @endif value="1">Hoạt động</option>
                                            <option @if($wallet->status == 0) selected @endif value="0">Khoá</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tên khách hàng</label>
                                        <input type="text" disabled="" class="form-control" value="{{ $wallet->name }}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{ $wallet->email }}" disabled="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Số dư (VND)</label>
                                        <input type="text" class="form-control" value="{{ number_format($wallet->amount, 0) }}" disabled="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Số lần nạp</label>
                                        <input type="text" class="form-control" value="{{ $wallet->total_charge }}" disabled="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Ghi chú</label>
                                        <textarea name="note" class="form-control" id="note" cols="30" rows="5">{{ $wallet->note }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" type="submit"><i class="fa fa-pen"></i> Chỉnh sửa</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>

            <div class="col-md-12 float-right">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lịch sử giao dịch</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="table-list-e-wallet" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th class="text-center">Số tiền (vnd)</th>
                                <th class="text-center">Thời gian</th>
                                <th class="text-center">Loại thanh toán</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($wallet->e_wallet_detail))
                                @foreach($wallet->e_wallet_detail as $detail)
                                    <tr>
                                        <td>{{ $detail->id }}</td>
                                        <td>{{ $wallet->name }}</td>
                                        <td>{{ $wallet->email }}</td>
                                        <td class="text-center">{{ number_format($detail->price, 0) }}</td>
                                        <td class="text-center">{{ $detail->time_charge }}</td>
                                        <td class="text-center">{{ $detail->txt_status }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th class="text-center">Số tiền (vnd)</th>
                                <th class="text-center">Thời gian</th>
                                <th class="text-center">Loại thanh toán</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $('#table-list-e-wallet').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>

    <style>
        #table-list-e-wallet_paginate {
            float: right;
        }
        .dataTables_filter label {
            width: 250px;
            float: right;
        }
        .dataTables_filter input {
            float: right;
            width: 195px;
        }
    </style>
@endsection
