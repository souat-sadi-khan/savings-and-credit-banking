@extends('layouts.app', ['title' => _lang('Loan Repay From Member'), 'modal' => 'lg'])
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
        <h1 data-placement="bottom" title="Loan Repay From Member ">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Loan Repay From Member ')}}</h1>
        <p>{{_lang('Here You Can Repay Loan From Memebers')}}</p>
    </div>
    {{--<ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('loan-repay') }}
    </ul>--}}
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <form action="{{route('admin.loan-repay.store')}}" method="post" id="content_form">
            @csrf
            <div class="col-md-12">
                <hr>
                <h4 class="text-center">Repay The Loan</h4>
                <hr>
            </div>



            <div class="row">
                {{-- :::::::::::::::    Right Side Of The Page:::::::::::::::: --}}
                <div class="col-md-6">
                    <div class="col-md-12">
                        <h5 class="text-center text-info">Loan Repay Info</h5>
                        <hr>
                    </div>
                    {{-- select member --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="member_id">{{_lang('Select Member')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select name="member_id" id="member_id"
                                data-url="{{ route('admin.loan-repay.get-loan-account') }}" class="form-control select"
                                data-placeholder="Type Name Or Mobile No Or Email  Of Member  .." required
                                data-parsley-errors-container="#member_id_error">

                            </select>
                            <span id="member_id_error"></span>
                        </div>
                    </div>

                    {{-- select Loan Account --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="loan_id">{{_lang('Select Loan')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select name="loan_id" id="loan_id" data-url="{{ route('admin.loan-repay.get-loan-info') }}"
                                class="form-control select" data-placeholder="Please Select Mamber First .." required
                                data-parsley-errors-container="#loan_id_error">

                            </select>
                            <span id="loan_id_error"></span>
                        </div>
                    </div>

                     <h6 class="text-danger ">Pay Information</h6>
                    <hr>
                    {{--  no_of_paying_installment --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"
                            for="no_of_paying_installment">{{_lang('Paying Installment No')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="1" required name="no_of_paying_installment"
                                id="no_of_paying_installment" placeholder="Enter No Of Insatallments To Be Paid"
                                class="form-control">
                        </div>
                    </div>


                    {{--  total_repay --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="total_repay">{{_lang('Total Repay (Taka)')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="0.01" required name="total_repay" id="total_repay" placeholder="Enter Total Repay Amount(ie. Installment Amt)"
                                class="form-control">
                        </div>
                    </div>

                     {{--  repay_interest --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="repay_interest">{{_lang('Interest Repay (Taka)')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="0.01" readonly required name="repay_interest" id="repay_interest"
                                placeholder="" class="form-control">
                        </div>
                    </div>


                    {{--  repay_loan --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="repay_loan">{{_lang('Loan Repay (Taka)')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="0.01" readonly required name="repay_loan" id="repay_loan"
                                placeholder="" class="form-control">
                        </div>
                    </div>





                    {{--  The following hiddens section is for calculation --}}
                    <div style="display:none">
                        <div class="col-md-12">
                            <h5>
                                Hidden section for calculation
                            </h5>
                            <hr>
                        </div>
                        {{-- main TOtal --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="main_total">{{_lang('Main loan amt taken')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="main_total" id="main_total" placeholder=""
                                    class="form-control">
                            </div>
                        </div>
                        {{-- main Interest --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="main_interest">{{_lang('Main Interest Amt')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="main_interest" id="main_interest" placeholder=""
                                    class="form-control">
                            </div>
                        </div>
                        {{-- main grand total --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"
                                for="main_grand_total">{{_lang('Main Grand Total Amt')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="main_grand_total" id="main_grand_total"
                                    placeholder="" class="form-control">
                            </div>
                        </div>

                        {{-- paid TOtal --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="paid_total">{{_lang('paid loan amt taken')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="paid_total" id="paid_total" placeholder=""
                                    class="form-control">
                            </div>
                        </div>
                        {{-- paid Interest --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="paid_interest">{{_lang('paid Interest Amt')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="paid_interest" id="paid_interest" placeholder=""
                                    class="form-control">
                            </div>
                        </div>
                        {{-- paid grand total --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"
                                for="paid_grand_total">{{_lang('paid Grand Total Amt')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="paid_grand_total" id="paid_grand_total"
                                    placeholder="" class="form-control">
                            </div>
                        </div>
                        {{-- Loan amt per Installment  --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"
                                for="loan_per_installment">{{_lang('Loan amount per installment')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="loan_per_installment" id="loan_per_installment"
                                    placeholder="" class="form-control">
                            </div>
                        </div>
                        {{-- interest Per installment  --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"
                                for="interest_per_installment">{{_lang('Interest amount per installment')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0" step="0.01" name="interest_per_installment"
                                    id="interest_per_installment" placeholder="" class="form-control">
                            </div>
                        </div>
                        {{-- grand_total Per installment  --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"
                                for="grand_total_per_installment">{{_lang('Grand Total per installment')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" min="0"step="0.01" name="grand_total_per_installment"
                                    id="grand_total_per_installment" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h5>
                                Hidden section ends here
                            </h5>
                        </div>

                    </div>

                  <div class="" style="display:none">
                        <h6 class="text-danger ">Due Information</h6>
                    <hr>

                     {{--  total_due --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="total_due">{{_lang('Total Due (Taka)')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="0.01" readonly required name="total_due" id="total_due" placeholder=""
                                class="form-control">
                        </div>
                    </div>

                      {{--  interest_due --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="interest_due">{{_lang('Interest Due (Taka)')}}

                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="0.01" readonly required name="interest_due" id="interest_due" placeholder=""
                                class="form-control">
                        </div>
                    </div>


                    {{--  loan_due --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="loan_due">{{_lang('Loan Due (Taka)')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="0.01" readonly required name="loan_due" id="loan_due" placeholder=""
                                class="form-control">
                        </div>
                    </div>


                   <h6 class="text-danger ">Installment No Information</h6>
                    <hr>

                    {{--  installment_paid --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="installment_paid">{{_lang('Installment Paid')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  readonly name="installment_paid" id="installment_paid"
                                placeholder="" class="form-control">
                        </div>
                    </div>



                    {{--  paid_installment --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="paid_installment">{{_lang('Paid Installment No')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  readonly name="paid_installment" id="paid_installment"
                                placeholder="" class="form-control">
                        </div>
                    </div>

                    {{--  due_installment --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="due_installment">{{_lang('Due Installment No')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text"  readonly name="due_installment" id="due_installment"
                                placeholder="" class="form-control">
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

                        <div class="form-group row ">
                            <label class="col-sm-4 col-form-label" for="tx_date">{{_lang('Transaction Date')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly name="tx_date" id="tx_date"
                                    placeholder="Enter Transaction Date"
                                    class="form-control  date " required 
                                    value="{{ date("d/m/Y") }}">
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
<script src="{{ asset('js/pages/loan_repay.js') }}"></script>

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
