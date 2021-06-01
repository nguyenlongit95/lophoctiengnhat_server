<div id="paygateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ url('/hoc-vien/credit') }}" method="POST" enctype="multipart/form-data" id="form-paygate">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nạp credit</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <h3>Chọn cổng thanh toán</h3>
                        <div class="col-md-4 margin-top-15">
                            <label for="vnpay" id="icon-vnpay"><img class="img-logo-paygate" style="height: 125px !important;" src="{{ asset('/source/images/paygates/vnpay.png') }}" alt="Cổng thanh toán VNPAY"></label>
                            <input type="radio" name="paygate" value="vnpay" id="vnpay" class="hidden select-paygate" onclick="onSelectPaygate('vnpay')">
                        </div>
                        <div class="col-md-4">
                            <label for="paypal" id="icon-paypal"><div id="paypal-button"></div></label>
                            <input type="radio" name="paygate" value="paypal" id="paypal" class="hidden select-paygate" onclick="onSelectPaygate('paypal')">
                        </div>
                        <div class="col-md-4">
                            <label for="nganluong" id="icon-nganluong"><img class="img-logo-paygate" src="{{ asset('/source/images/paygates/nganluong.jpg') }}" alt="Cổng thanh toán Ngân Lượng"></label>
                            <input type="radio" name="paygate" value="nganluong" id="nganluong" class="hidden select-paygate" onclick="onSelectPaygate('nganluong')">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <label for="" id="txt-validate-paygate" class="hidden text-danger">Bạn hãy chọn cổng thanh toán</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 margin-top-15">
                    <div class="row">
                        <h3>Thông tin giao dịch</h3>
                        <div class="form-group margin-top-15">
                            <label for="price">Số tiền nạp <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="price" id="price" value="">
                            <label for="" id="txt-validate-price" class="hidden text-danger">Bạn hãy nhập đúng số tiền cần nạp.</label>
                        </div>
                        <div class="form-group margin-top-15">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" class="form-control" id="note" cols="30" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <h4 class="text-left">- Để tránh sai sót bạn hãy nhập thông tin trước khi chọn cổng thanh toán <span class="text-danger">*</span></h4>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" onclick="checkSelectPaygate()" class="btn btn-primary">Nạp tiền</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style>
    .img-logo-paygate {
        height: 150px !important;
        width: 150px !important;
    }
    .img-logo-paygate:hover {
        cursor: pointer;
    }
    .selected-paygate {
        border: 5px solid #337ab7;
        border-radius: 15px;
    }
    .error {
        color: red;
    }
    #icon-paypal {
        margin-top: 50px;
    }
</style>
<script>
    /**
     * Function select a paygate
     *
     * @param paygate
     */
    function onSelectPaygate(paygate) {
        if (paygate === 'vnpay') {
            $('#icon-vnpay').addClass('selected-paygate');
            $('#icon-paypal').removeClass('selected-paygate');
            $('#icon-nganluong').removeClass('selected-paygate');
        }
        if (paygate === 'paypal') {
            $('#icon-vnpay').removeClass('selected-paygate');
            $('#icon-paypal').addClass('selected-paygate');
            $('#icon-nganluong').removeClass('selected-paygate');
        }
        if (paygate === 'nganluong') {
            $('#icon-vnpay').removeClass('selected-paygate');
            $('#icon-paypal').removeClass('selected-paygate');
            $('#icon-nganluong').addClass('selected-paygate');
        }
    }

    /**
     * Function validate form paygate
     */
    function checkSelectPaygate() {
        let pg = $("input[name='paygate']:checked").val();
        if (pg == undefined) {
            $('#txt-validate-paygate').removeClass('hidden');
        } else {
            $('#txt-validate-paygate').addClass('hidden');
        }
        if ($('#price').val().length > 0 && $('#price').val() !== 'e') {
            $('#txt-validate-price').addClass('hidden');
        } else {
            $('#txt-validate-price').removeClass('hidden');
        }
        if (pg === 'paypal') {
            console.log('paypal');
        } else {
            if (pg != undefined && $('#price').val().length > 0 && $('#price').val() !== 'e') {
                // Submit form
                $('#form-paygate').submit();
            }
        }
    }
</script>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            // TODO get info account from database
            sandbox: 'AeYbemRrJQ94AKpZKo_sHSQJsdk8sH25QrfeDwiPhL8kEXxb962Xjs875juuJGsrPGCP5o2mb35jpqSq',
            production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        // total: $('#price').val(),
                        total: '0.01',
                        currency: 'USD'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Update information purchase
                console.log(data, actions);
                // updateEWallet($('#price').val());
                updateEWallet('0.01');
            });
        }
    }, '#paypal-button');

    /**
     * Function call api update e-wallet detail
     *
     * @param amount
     */
    function updateEWallet(amount) {
        $.ajax({
            url: "{{ url('/pay-gate-callback/pay-pal') }}",
            type: 'get',
            data: {
                amount: amount
            },
            success: function (response) {
                if (response.status === 200) {
                    alert('Bạn đã nạp tiền thành công!');
                    window.location.reload();
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    }
</script>
