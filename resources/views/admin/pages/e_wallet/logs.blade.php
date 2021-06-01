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
                        <h1 class="m-0 text-dark">Danh sách lịch sử giao dịch</h1>
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
                                <th class="text-center">Số tiền</th>
                                <th class="text-center">Thời gian giao dịch</th>
                                <th>Ghi chú</th>
                                <th class="text-center">Cổng thanh toán</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($logs))
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->name }}</td>
                                        <td>{{ $log->email }}</td>
                                        <td class="text-center">{{ number_format($log->price, 0) }}</td>
                                        <td class="text-center">{{ $log->time_charge }}</td>
                                        <td>{{ $log->note }}</td>
                                        <td class="text-center">{{ $log->paygate }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th class="text-center">Số tiền</th>
                                <th class="text-center">Thời gian giao dịch</th>
                                <th>Ghi chú</th>
                                <th class="text-center">Cổng thanh toán</th>
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
