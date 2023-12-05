@extends('layouts.app', ['title' => _lang('DPS Deposit From Member'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')

<style>
    .table th,
    .table td {
        padding: 0.40rem 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

</style>
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="DPS Deposit From Member ">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('DPS Deposit From Member ')}}</h1>
        <p>{{_lang('Here You Can Add New DPS Deposit From Members')}}</p>
    </div>
    {{--<ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('dps-deposit') }}
    </ul>--}}
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <form action="{{route('admin.dps-deposit.store')}}" method="post" id="content_form">
            @csrf
            <div class="col-md-12">
                <hr>
                <h4 class="text-center">Add New DPS Deposit</h4>
                <hr>
            </div>



            <div class="row">
                {{-- :::::::::::::::    Right Side Of The Page:::::::::::::::: --}}
                <div class="col-md-6">
                    <div class="col-md-12">
                        <h5 class="text-center text-info">New Deposit Info</h5>
                        <hr>
                    </div>
                    {{-- select member --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="member_id">{{_lang('Select Member')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select name="member_id" id="member_id"
                                data-url="{{ route('admin.dps-deposit.get-dps-account') }}" class="form-control select"
                                data-placeholder="Type Name Or Mobile No Or Email  Of Member  .." required
                                data-parsley-errors-container="#member_id_error">
                            </select>
                            <span id="member_id_error"></span>
                        </div>
                    </div>

                    {{-- select Savings Account --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="dps_account_id">{{_lang('Select DPS AC')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select name="dps_account_id" id="dps_account_id"
                                data-url="{{ route('admin.dps-deposit.get-deposit-info') }}" class="form-control select"
                                data-placeholder="Please Select Mamber First .." required
                                data-parsley-errors-container="#dps_acc_id_error">
                            </select>
                            <span id="dps_account_id_error"></span>
                        </div>
                    </div>

                    <h6 class="text-danger ">Deposit Information</h6>
                    <hr>
                    {{--  new_deposit --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="new_deposit">{{_lang('New Deposit Amt')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="1" readonly required name="new_deposit" id="new_deposit"
                                placeholder="Enter New Deposit Amount" class="form-control">
                        </div>
                    </div>


                    {{--  total_dps --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="total_dps">{{_lang('Total DPS (Till Now)')}}

                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" readonly name="total_dps" id="total_dps"
                                placeholder="Total DPS Till Now" class="form-control">
                        </div>
                    </div>

                    {{--  grand_total_dps --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="grand_total_dps">{{_lang('Grand Total DPS')}}

                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" readonly name="grand_total_dps" id="grand_total_dps"
                                placeholder="Total DPS + New Deposit Amt" class="form-control">
                        </div>
                    </div>


                    <h6 class="text-danger ">DPS No Payment Information</h6>
                    <hr>
                    <div class="row">
                        {{-- Total No Of DPS --}}
                        <div class="col-md-4 form-group">
                            <label for="no_of_dps">{{_lang('Total DPS')}}
                            </label>
                            <div class="input-group">
                                <input type="number" min="0" readonly name="no_of_dps" id="no_of_dps" class="form-control">
                            </div>
                        </div>
                        {{-- Total No Of Paid DPS --}}
                        <div class="col-md-4 form-group">
                            <label for="paid_dps">{{_lang('Paid DPS')}}
                            </label>
                            <div class="input-group">
                                <input type="number" min="0" readonly name="paid_dps" id="paid_dps" class="form-control">
                            </div>
                        </div>
                          {{-- Total No Of Due DPS --}}
                        <div class="col-md-4 form-group">
                            <label for="due_dps">{{_lang('Due DPS')}}
                            </label>
                            <div class="input-group">
                                <input type="number" min="0" readonly name="due_dps" id="due_dps" class="form-control">
                            </div>
                        </div>


                    </div>



                    {{--  pay_type --}}

                    <div class=" form-group row">
                        <label class="col-sm-4 col-form-label" for="payment_method"
                            class="col-sm-4 col-form-label">{{_lang('Payment Method')}}
                            <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-8">
                            <select name="payment_method" id="payment_method" class="form-control select"
                                data-placeholder="Please Select One .." required required
                                data-parsley-errors-container="#payment_method_error">
                                <option value="">Please Select One ..</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank Check">Bank Check</option>
                                <option value="Mobile Banking">Mobile Banking</option>
                            </select>
                            <span id="payment_method_error"></span>

                        </div>
                    </div>

                    {{-- :::::::::::  Payment method information     ::::::::::::::::: --}}

                    {{-- ::::::::::    Mobile Banking Payment Information     ::::::::::::::: --}}
                    <div class="mobile_banking" style="display:none">
                        <h6 class="text-danger mobile_banking">Payment With Mobile Banking</h6>
                        <hr>
                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label"
                                for="mob_banking_name">{{_lang('Mobile Banking Name')}}

                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="mob_banking_name" id="mob_banking_name"
                                    placeholder="Enter Mobile Banking Name "
                                    class="form-control mobile_banking mobile_banking_required">
                            </div>
                        </div>

                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label"
                                for="mob_account_holder">{{_lang('Account Holder Name')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="mob_account_holder" id="mob_account_holder"
                                    placeholder="Enter Account Holder Name" class="form-control mobile_banking">
                            </div>
                        </div>

                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label" for="sending_mob_no">{{_lang('Sending Mobile No')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="sending_mob_no" id="sending_mob_no"
                                    placeholder="Enter Sending Mobile No"
                                    class="form-control mobile_banking mobile_banking_required">
                            </div>
                        </div>

                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label" for="receiving_mob_no">{{_lang('Receiving Mob No')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="receiving_mob_no" id="receiving_mob_no"
                                    placeholder="Enter Receiving Mob No"
                                    class="form-control mobile_banking mobile_banking_required">
                            </div>
                        </div>

                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label" for="mob_tx_id">{{_lang('Transaction ID')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="mob_tx_id" id="mob_tx_id" placeholder="Enter Transaction ID"
                                    class="form-control mobile_banking mobile_banking_required">
                            </div>
                        </div>

                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label" for="mob_payment_date">{{_lang('Payment Date')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly name="mob_payment_date" id="mob_payment_date"
                                    placeholder="Enter Payment Date"
                                    class="form-control mobile_banking date mobile_banking_required">
                            </div>
                        </div>
                    </div>
                    {{-- ::::::::::::::::::    Bank Check Payment Information     :::::::::::::::::::: --}}
                    <div class="bank_check" style="display:none">
                        <h6 class="text-danger">Payment With Bank Check</h6>
                        <hr>
                        <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label" for="bank_name">{{_lang('Bank Name')}}

                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name "
                                    class="form-control bank_check bank_check_required">
                            </div>
                        </div>

                        <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label" for="account_holder">{{_lang('Account Holder Name')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="account_holder" id="account_holder"
                                    placeholder="Enter Account Holder Name"
                                    class="form-control bank_check bank_check_required">
                            </div>
                        </div>

                        <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label" for="account_no">{{_lang('Account Number')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="account_no" id="account_no"
                                    placeholder="Enter Bank Account Number"
                                    class="form-control bank_check bank_check_required">
                            </div>
                        </div>

                        <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label" for="check_no">{{_lang('Check No')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="check_no" id="check_no" placeholder="Enter Check No"
                                    class="form-control bank_check bank_check_required">
                            </div>
                        </div>

                        <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label"
                                for="check_active_date">{{_lang('Check Active Date')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly name="check_active_date" id="check_active_date"
                                    placeholder="Enter Check Active Date"
                                    class="form-control bank_check date bank_check_required">
                            </div>
                        </div>
                    </div>
                    <h6 class="text-danger ">Additional Information</h6>
                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="tx_date">{{_lang('Transaction Date')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" required readonly name="tx_date" id="tx_date"
                                placeholder="Enter Transaction Date" class="form-control date">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="additional_note">{{_lang('Comment')}}
                        </label>
                        <div class="col-sm-8">
                            <textarea name="additional_note" id="additional_note" placeholder="Enter Comment"
                                class="form-control "></textarea>
                        </div>
                    </div>
                </div>


                {{-- :::::::::::::::    Right Side Of The Page:::::::::::::::: --}}
                <div class="col-md-6">
                    <div class="col-md-12">
                        <h5 class="text-center text-info">Previous Deposit Informaiton</h5>
                        <hr>
                    </div>
                    <div id="previous_payment_records">

                    </div>
                </div>






                <div class="form-group col-md-12" align="right">
                    {{-- <input type="hidden" name="type[]" value=" "> --}}
                    <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
                            class="icon-arrow-right14 position-right"></i></button>
                    <button type="button" class="btn btn-link" id="submiting"
                        style="display: none;">{{_lang('Processing')}}
                        <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                </div>
            </div>
        </form>

    </div>
</div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
{{-- <script src="{{ asset('backend/js/plugins/buttons.min.js') }}"></script> --}}
<script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
<script src="{{ asset('js/pages/dps_deposit.js') }}"></script>

<script>
    $('.select').select2({
        width: '100%'
    });

    $(document).ready(function () {
        // $('#example').DataTable();

        $('#withdraw_data_table').DataTable({
            "searching": false,
            "lengthChange": false,
            "pageLength": 15
        });

        $('#deposit_data_table').DataTable({
            "searching": false,
            "lengthChange": false,
            "pageLength": 15
        });

    });

</script>


@endpush
