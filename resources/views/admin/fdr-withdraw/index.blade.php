@extends('layouts.app', ['title' => _lang('Loan From Member Withdraw'), 'modal' => 'lg'])
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
        <h1 data-placement="bottom" title="Loan From Member Withdraw ">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Loan From Member Withdraw ')}}</h1>
        <p>{{_lang('Here You Can Withdraw Loan From Member')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render('fdr-withdraw') }} --}}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <form action="{{route('admin.fdr-withdraw.store')}}" method="post" id="content_form">
            @csrf
            <div class="col-md-12">
                <hr>
                <h4 class="text-center">Withdraw Loan From Member</h4>
                <hr>
            </div>



            <div class="row">
                {{-- :::::::::::::::    Right Side Of The Page:::::::::::::::: --}}
                <div class="col-md-6">
                    <div class="col-md-12">
                        <h5 class="text-center text-info">Withdraw Info</h5>
                        <hr>
                    </div>
                    {{-- select member --}}
                    {{-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="member_id">{{_lang('Select Member')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select name="member_id" id="member_id"
                                data-url="{{ route('admin.fdr-withdraw.get-fdr-account') }}"
                                class="form-control select"
                                data-placeholder="Type Name Or Mobile No Or Email  Of Member  .." required
                                data-parsley-errors-container="#member_id_error">

                            </select>
                            <span id="member_id_error"></span>
                        </div>
                    </div> --}}

                    {{-- select Loan Account --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"
                            for="fdr_id">{{_lang('Select Loan Acc')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select name="fdr_id" id="fdr_id"
                                data-url="{{ route('admin.fdr-withdraw.get-fdr-info') }}"
                                class="form-control select" data-placeholder="Please Select One .." required
                                data-parsley-errors-container="#fdr_id_error">
                                <option value="">Please Select One ...</option>
                                @foreach ($model as $fdr_account)
                                    <option value="{{ $fdr_account->id }}">{{ get_id_account_no('fdr',$fdr_account->prefix,$fdr_account->code) }}, {{ carbonDate($fdr_account->issue_date) }}</option>
                                @endforeach

                            </select>
                            <span id="fdr_id_error"></span>
                        </div>
                    </div>

                    <h6 class="text-danger ">Withdraw Information</h6>
                    <hr>



                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="withdraw_type">{{_lang('Select Withdraw Type')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select name="withdraw_type" id="withdraw_type"
                                data-url="{{ route('admin.fdr-withdraw.get-fdr-info') }}"
                                class="form-control select" data-placeholder="Please Select one .." required
                                data-parsley-errors-container="#withdraw_type_error">
                                <option value="">Please Select One</option>
                                <option value="Total">Total Withdraw</option>
                                <option value="Interest">Interest Withdraw</option>
                            </select>
                            <span id="withdraw_type_error"></span>
                        </div>
                    </div>


                    <div class="form-group row" style="display:none" id="expiry_reminder">
                        <p class="text-danger">Remember: You Are Going To Withdraw Total Amount Before The Expiry Date. Hence You Will Not Be Able To Enjoy The Benifit.</p>
                    </div>



                    {{--  now_withdrable --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"
                            for="withdrawable">{{_lang('Withdrawable Amount (Taka)')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="0.01" required name="withdrawable"
                                id="withdrawable" placeholder="" class="form-control">
                        </div>
                    </div>





                    {{--  The following hiddens section is for calculation --}}
                    <div style="display: none">
                        <div class="col-md-12">
                            <h5>
                                Hidden section for calculation
                            </h5>
                            <hr>
                        </div>
                        {{-- main TOtal --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"
                                for="now_withdrable_interest_calc">{{_lang('Withdrawable interest')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="now_withdrable_interest_calc"
                                    id="now_withdrable_interest_calc" placeholder="" class="form-control">
                            </div>
                        </div>
                        {{-- main Interest --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"
                                for="now_withdrable_total_calc">{{_lang('Withdrawable Total')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="now_withdrable_total_calc"
                                    id="now_withdrable_total_calc" placeholder="" class="form-control">
                            </div>
                        </div>
                        {{-- main Interest --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="expiry">{{_lang('Expiry')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="expiry" id="expiry" placeholder="" class="form-control">
                            </div>
                        </div>



                        <div class="col-md-12">
                            <hr>
                            <h5>
                                Hidden section ends here
                            </h5>
                        </div>

                    </div>

                    {{-- <h6 class="text-danger ">Due Information</h6>
                    <hr> --}}



                    {{--  interest_due --}}
                    {{-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="interest_due">{{_lang('Interest Due (Taka)')}}

                    <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="number" min="0" step="0.01" readonly required name="interest_due" id="interest_due"
                            placeholder="" class="form-control">
                    </div>
                </div> --}}


                {{--  loan_due --}}
                {{-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="loan_due">{{_lang('Loan Due (Taka)')}}
                <span class="text-danger">*</span>
                </label>
                <div class="col-sm-8">
                    <input type="number" min="0" step="0.01" readonly required name="loan_due" id="loan_due"
                        placeholder="" class="form-control">
                </div>
            </div> --}}







            {{-- <h6 class="text-danger ">Installment No Information</h6>
                    <hr> --}}

            {{--  installment_paid --}}
            {{-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="installment_paid">{{_lang('Installment Paid')}}
            <span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
                <input type="text" readonly name="installment_paid" id="installment_paid" placeholder=""
                    class="form-control">
            </div>
    </div> --}}



    {{--  paid_installment --}}
    {{-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="paid_installment">{{_lang('Paid Installment No')}}
    <span class="text-danger">*</span>
    </label>
    <div class="col-sm-8">
        <input type="text" readonly name="paid_installment" id="paid_installment" placeholder="" class="form-control">
    </div>
</div> --}}

{{--  due_installment --}}
{{-- <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="due_installment">{{_lang('Due Installment No')}}
<span class="text-danger">*</span>
</label>
<div class="col-sm-8">
    <input type="text" readonly name="due_installment" id="due_installment" placeholder="" class="form-control">
</div>
</div> --}}

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
            <option value="Cash" selected>Cash</option>
            <option value="Bank Check">Bank Check</option>
            <option value="Mobile Banking">Mobile Banking</option>
        </select>
        <span id="payment_method_error"></span>

    </div>
</div>

{{-- ::::::::::::::::   Payment method information     ::::::::::::::::::::: --}}

{{-- ::::::::::::::::::    Mobile Banking Payment Information     :::::::::::::::::::: --}}
<div class="mobile_banking" style="display:none">
    <h6 class="text-danger mobile_banking">Payment With Mobile Banking</h6>
    <hr>
    <div class="form-group row mobile_banking">
        <label class="col-sm-4 col-form-label" for="mob_banking_name">{{_lang('Mobile Banking Name')}}

        </label>
        <div class="col-sm-8">
            <input type="text" name="mob_banking_name" id="mob_banking_name" placeholder="Enter Mobile Banking Name "
                class="form-control mobile_banking mobile_banking_required">
        </div>
    </div>

    <div class="form-group row mobile_banking">
        <label class="col-sm-4 col-form-label" for="mob_account_holder">{{_lang('Account Holder Name')}}
        </label>
        <div class="col-sm-8">
            <input type="text" name="mob_account_holder" id="mob_account_holder" placeholder="Enter Account Holder Name"
                class="form-control mobile_banking">
        </div>
    </div>

    <div class="form-group row mobile_banking">
        <label class="col-sm-4 col-form-label" for="sending_mob_no">{{_lang('Sending Mobile No')}}
        </label>
        <div class="col-sm-8">
            <input type="text" name="sending_mob_no" id="sending_mob_no" placeholder="Enter Sending Mobile No"
                class="form-control mobile_banking mobile_banking_required">
        </div>
    </div>

    <div class="form-group row mobile_banking">
        <label class="col-sm-4 col-form-label" for="receiving_mob_no">{{_lang('Receiving Mob No')}}
        </label>
        <div class="col-sm-8">
            <input type="text" name="receiving_mob_no" id="receiving_mob_no" placeholder="Enter Receiving Mob No"
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
            <input type="text" readonly name="mob_payment_date" id="mob_payment_date" placeholder="Enter Payment Date"
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
            <input type="text" name="account_holder" id="account_holder" placeholder="Enter Account Holder Name"
                class="form-control bank_check bank_check_required">
        </div>
    </div>

    <div class="form-group row bank_check">
        <label class="col-sm-4 col-form-label" for="account_no">{{_lang('Account Number')}}
        </label>
        <div class="col-sm-8">
            <input type="text" name="account_no" id="account_no" placeholder="Enter Bank Account Number"
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
        <label class="col-sm-4 col-form-label" for="check_active_date">{{_lang('Check Active Date')}}
        </label>
        <div class="col-sm-8">
            <input type="text" readonly name="check_active_date" id="check_active_date"
                placeholder="Enter Check Active Date" class="form-control bank_check date bank_check_required">
        </div>
    </div>
</div>

<div class="form-group row ">
    <label class="col-sm-4 col-form-label" for="tx_date">{{_lang('Transaction Date')}}
    </label>
    <div class="col-sm-8">
        <input type="text" readonly name="tx_date" id="tx_date" placeholder="Enter Transaction Date"
            class="form-control  date " required value="{{ date('d/m/Y') }}">
    </div>
</div>
<h6 class="text-danger ">Additional Information</h6>
<hr>

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
        <h5 class="text-center text-info">Previous Payment Records</h5>
        <hr>
    </div>
    <div id="previous_payment_records">

    </div>
</div>






<div class="form-group col-md-12" align="right">
    {{-- <input type="hidden" name="type[]" value=" "> --}}
    <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
            class="icon-arrow-right14 position-right"></i></button>
    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
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
<script src="{{ asset('js/pages/fdr_withdraw.js') }}"></script>

<script>
    $('.select').select2({
        width: '100%'
    });

    $(document).ready(function () {
        // $('#example').DataTable();

        $('#example').DataTable({
            "searching": false,
            "lengthChange": false,
            "pageLength": 15
        });

    });

</script>


@endpush
