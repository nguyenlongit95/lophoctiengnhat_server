@extends('frontend.master')
@section('content')
    <section class="about font-medium" id="about">
        <div id="main-content-section">
            <!-- Content lession began -->
            <div id="lession-content">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('/source/images/avatar/' . \Illuminate\Support\Facades\Auth::user()->avatar) }}" class="img-avatar" alt="avatar of {{ \Illuminate\Support\Facades\Auth::user()->name }}">
                    </div>
                    <div class="col-md-5 padding-top-20">
                        <div class="col-md-4">
                            <p>Họ tên:</p>
                            <p>Địa chỉ:</p>
                            <p>Giới tính</p>
                            <p>Số điện thoại:</p>
                            <p>Ngày sinh:</p>
                            <p>Trường học:</p>
                            <p>Nghề nghiệp:</p>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $user->name }}</p>
                            <p>{{ $user->address }}</p>
                            <p>{{ $user->txt_gender }}</p>
                            <p>{{ $user->phone }}</p>
                            <p>{{ \Carbon\Carbon::create($user->birth_day)->format('d/m/Y') }}</p>
                            <p>{{ $user->school }}</p>
                            <p>{{ $user->job }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 padding-top-20">
                        <div class="col-md-6">
                            <p>Tổng số credit: </p>
                            <p>Số lần thực hiện giao dịch:</p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="text-danger">{{ number_format($eWallet->amount, 0) }} vnđ</span></p>
                            <p><span class="text-danger">{{ count($eWallet->e_wallet_detail) }}</span></p>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" onclick="showModalPayGates()"><i class="fa fa-coins"></i> Nạp credit</button>
                            <a class="btn btn-primary" href="{{ url('/hoc-vien/cap-nhat') }}"><i class="fa fa-user-edit"></i> Sửa thông tin</a>
                        </div>
                        <div class="col-md-12">
                            @include('admin.layouts.errors')
                        </div>
                    </div>
                    <div class="col-md-12 padding-35">
                        <div class="group-tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist" id="tabs-title-detail-users">
                                <li role="presentation" class="active col-md-3"><a href="#credit" aria-controls="credit" role="tab" data-toggle="tab">Danh sách các lần nạp credits</a></li>
                                <li role="presentation" class="col-md-3"><a href="#class" aria-controls="class" role="tab" data-toggle="tab">Danh sách khoá học đã mua</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="credit">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Thành tiền (vnd)</th>
                                            <th>Thời gian giao dịch</th>
                                            <th>Cổng thanh toán</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($eWallet->e_wallet_detail))
                                            @foreach($eWallet->e_wallet_detail as $eWalletDetail)
                                                @if($eWalletDetail->status === 1)
                                                <tr>
                                                    <td>{{ $eWalletDetail->id }}</td>
                                                    <td>{{ number_format($eWalletDetail->price, 0) }}</td>
                                                    <td>{{ $eWalletDetail->time_charge }}</td>
                                                    <td>{{ $eWalletDetail->paygate }}</td>
                                                    <td>{{ $eWalletDetail->note }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Thành tiền (vnd)</th>
                                            <th>Thời gian giao dịch</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="class">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Thành tiền</th>
                                            <th>Khoá học</th>
                                            <th>Cổng thanh toán</th>
                                            <th>Thời gian thanh toán</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($eWallet))
                                            @foreach($eWallet->e_wallet_detail as $detail)
                                                @if($detail->status === 0)
                                                <tr>
                                                    <td>{{ $detail->id }}</td>
                                                    <td>{{ number_format($detail->price, 0) }}</td>
                                                    <td>{{ str_word_count($detail->course_name) ? $detail->course_name : $detail->note }}</td>
                                                    <td>{{ str_word_count($detail->paygate) ? $detail->paygate : 'Ví điện tử' }}</td>
                                                    <td>{{ $detail->time_charge }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Thành tiền</th>
                                            <th>Khoá học</th>
                                            <th>Cổng thanh toán</th>
                                            <th>Thời gian thanh toán</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

@section('custom-js')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $('#example1').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
@endsection
