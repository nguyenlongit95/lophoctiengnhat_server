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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table id="table-list-e-wallet" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th class="text-center">Số dư (vnd)</th>
                                <th class="text-center">Số lần nạp</th>
                                <th>Ghi chú</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($eWallet))
                                @foreach($eWallet as $wallet)
                                <tr>
                                    <td>{{ $wallet->id }}</td>
                                    <td>{{ $wallet->name }}</td>
                                    <td>{{ $wallet->email }}</td>
                                    <td class="text-center">{{ number_format($wallet->amount, 0) }}</td>
                                    <td class="text-center">{{ $wallet->total_charge }}</td>
                                    <td>{{ $wallet->note }}</td>
                                    <td class="text-center">{{ $wallet->txt_status }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('/admin/e-wallet/' . $wallet->id . '/detail') }}"><i class="fa fa-pen"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th class="text-center">Số dư (vnd)</th>
                                <th class="text-center">Số lần nạp</th>
                                <th>Ghi chú</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Thao tác</th>
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
