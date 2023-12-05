@extends('layouts.app', ['title' => _lang('Member Create'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Member Create.">{{--<i class="fa fa-universal-access mr-4"></i>--}}
            {{_lang('Member Create')}}</h1>
        <p>{{_lang('Create Member. Here you can Add, Edit & Delete The Member ')}}</p>
    </div>
    {{--<ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('member-list-create') }}
    </ul>--}}
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-header">
        <h6>{{_lang('Add New Member')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.member-list.store')}}" method="post" id="content_form">
            @csrf
            <div class="row">


                {{--*---------- The following section is for Member information -----------------}}
                <div class="col-md-12">
                    {{-- <hr> --}}
                    <h3 class="text-center text-info">Member Information</h3>
                    <hr>
                </div>

                <div class="col-md-6 form-group">
                    <label for="prefix">{{_lang('Code')}} <span class="text-danger">*</span>
                    </label>
                    <div class="row">
                        <div class="col-md-4"><input type="text" name="prefix" id="prefix" class="form-control"
                                placeholder="Prefix" value="{{$code_prefix}}" required></div>
                        <div class="col-md-8"> <input type="text" name="code" id="code" class="form-control"
                                placeholder="Code Here" required value="{{$uniqu_id}}"></div>
                    </div>
                </div>

                {{-- Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                </div>

                {{-- Father Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Father Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="father_name" id="father_name" class="form-control"
                        placeholder="Enter Father Name" required>
                </div>

                {{-- Mother Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Mother Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="mother_name" id="mother_name" class="form-control"
                        placeholder="Enter Mother Name" required>
                </div>

                {{-- Contact Number --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Contact Number')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control"
                        placeholder="Enter Contact Number" required maxlength="14">
                </div>

                {{-- Gender --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Gender')}} <span class="text-danger">*</span>
                    </label>

                    <select data-parsley-errors-container="#parsley_error_select_gender_for_creating_new_Member"
                        data-placeholder="Please Select One" name="gender" id="gender" class="form-control select"
                        required>
                        <option value="">Please Select One..</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <span id="parsley_error_select_gender_for_creating_new_Member"></span>
                </div>

                {{-- Date Of Birth --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Date Of Birth')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" autocomplete="off" name="date_of_birth" id="date_of_birth"
                        class="form-control date" required>
                </div>

                {{-- Nationality --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Nationality')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_error_select_nationality_for_creating_new_member"
                        name="nationality" data-placeholder="Please Select One.." class="form-control select"
                        id="nationality" required>
                        <option value="">Please Select One..</option>
                        @foreach($nationality as $item){
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        }
                        @endforeach
                    </select>
                    <span id="parsley_error_select_nationality_for_creating_new_member"></span>
                </div>

                {{-- Religious --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Religious')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_error_select_religious_for_creating_new_member"
                        name="religious" data-placeholder="Please Select One.." class="form-control select"
                        id="religious" required>
                        <option value="">Please Select One..</option>
                        @foreach($religious as $item){
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        }
                        @endforeach
                    </select>
                    <span id="parsley_error_select_religious_for_creating_new_member"></span>
                </div>

                {{-- Occupation --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Occupation')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_error_select_occupation_for_creating_new_member"
                        name="occupation" data-placeholder="Please Select One.." class="form-control select"
                        id="occupation" required>
                        <option value="">Please Select One..</option>
                        @foreach($occupation as $item){
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        }
                        @endforeach
                    </select>
                    <span id="parsley_error_select_occupation_for_creating_new_member"></span>
                </div>


                {{-- Reference --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Referer Name')}}
                    </label>
                    <select name="referrer_id" class="form-control " id="referrer_id">
                    </select>
                    <span id="parsley_error_select_reference_for_creating_new_member"></span>
                </div>

                {{-- Photo --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Photo')}} </label>
                    <input type="file" autocomplete="off" name="photo" id="photo" class="form-control">
                </div>

                {{-- Signature --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Signature')}} </label>
                    <input type="file" autocomplete="off" name="signature" id="signature" class="form-control">
                </div>
            </div>

            {{-- Address Section --}}

            <div class="row">
                {{-- Present Address Line 1 --}}
                <div class="col-md-4 form-group">
                    <label for="present_address_line_1">{{_lang('Member Present Address Line 1')}} <span
                            class="text-danger">*</span>
                    </label>
                    <input required type="text" name="present_address_line_1" id="present_address_line_1"
                        class="form-control" placeholder="Enter Member Present Address Line 1">
                </div>

                {{-- Present Address Line 2 --}}
                <div class="col-md-4 form-group">
                    <label for="present_address_line_2">{{_lang('Member Present Address Line 2')}}
                    </label>
                    <input type="text" name="present_address_line_2" id="present_address_line_2" class="form-control"
                        placeholder="Enter Member Present Address Line 2">
                </div>

                {{-- City --}}
                <div class="col-md-4 form-group">
                    <label for="present_city">{{_lang('Member Present City')}}
                    </label>
                    <input type="text" name="present_city" id="present_city" class="form-control"
                        placeholder="Enter Member Present City">
                </div>

                {{-- Statue --}}
                <div class="col-md-4 form-group">
                    <label for="present_state">{{_lang('Member Present State')}}
                    </label>
                    <input type="text" name="present_state" id="present_state" class="form-control"
                        placeholder="Enter Member Present State">
                </div>

                {{-- Zipcode --}}
                <div class="col-md-4 form-group">
                    <label for="present_zipcode">{{_lang('Member Present Zipcode')}}
                    </label>
                    <input type="text" name="present_zipcode" id="present_zipcode" class="form-control"
                        placeholder="Enter Member Present Zipcode">
                </div>

                {{-- Country --}}
                <div class="col-md-4 form-group">
                    <label for="present_country">{{_lang('Member Present Country')}}
                    </label>
                    <input type="text" name="present_country" id="present_country" class="form-control"
                        placeholder="Enter Member Present Country">
                </div>

                {{-- Parmanent Address --}}
                <div class="col-md-12 form-group">
                    <label for="same_as_present_address">Parmanent Address</label>
                    <select data-placeholder="Please Select One" name="same_as_present_address"
                        id="same_as_present_address" class="form-control select">
                        <option selected value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="row" id="present_address" style="display:none;">
                {{-- Present Address Line 1 --}}
                <div class="col-md-4 form-group">
                    <label for="permanent_address_line_1">{{_lang('Member Parmanent Address Line 1')}} <span
                            class="text-danger">*</span>
                    </label>
                    <input type="text" name="permanent_address_line_1" id="permanent_address_line_1"
                        class="form-control" placeholder="Enter Member Parmanent Address Line 1">
                </div>

                {{-- Present Address Line 2 --}}
                <div class="col-md-4 form-group">
                    <label for="permanent_address_line_2">{{_lang('Member Parmanent Address Line 2')}}
                    </label>
                    <input type="text" name="permanent_address_line_2" id="permanent_address_line_2"
                        class="form-control" placeholder="Enter Member Parmanent Address Line 2">
                </div>

                {{-- City --}}
                <div class="col-md-4 form-group">
                    <label for="permanent_city">{{_lang('Member Parmanent City')}}
                    </label>
                    <input type="text" name="permanent_city" id="permanent_city" class="form-control"
                        placeholder="Enter Member Parmanent City">
                </div>

                {{-- Statue --}}
                <div class="col-md-4 form-group">
                    <label for="permanent_state">{{_lang('Member Parmanent State')}}
                    </label>
                    <input type="text" name="permanent_state" id="permanent_state" class="form-control"
                        placeholder="Enter Member Parmanent State">
                </div>

                {{-- Zipcode --}}
                <div class="col-md-4 form-group">
                    <label for="permanent_zipcode">{{_lang('Member Parmanent Zipcode')}}
                    </label>
                    <input type="text" name="permanent_zipcode" id="permanent_zipcode" class="form-control"
                        placeholder="Enter Member Parmanent Zipcode">
                </div>

                {{-- Country --}}
                <div class="col-md-4 form-group">
                    <label for="permanent_country">{{_lang('Member Parmanent Country')}}
                    </label>
                    <input type="text" name="permanent_country" id="permanent_country" class="form-control"
                        placeholder="Enter Member Parmanent Country">
                </div>
            </div>

            {{--*---------- The following section is for share information -----------------}}
            <div class="col-md-12">
                {{-- <hr> --}}
                <br>
                <h3 class="text-center text-info">Share Information</h3>
                <hr>
            </div>

            <div class="row">

                <div class="col-md-6 form-group">
                    <label for="prefix_share">{{_lang('Share Account No')}} <span class="text-danger">*</span>
                    </label>
                    <div class="row">
                        <div class="col-md-4"><input type="text" name="prefix_share" id="prefix_share"
                                class="form-control" placeholder="Prefix_share" value="{{$code_prefix_share}}" required>
                        </div>
                        <div class="col-md-8"> <input type="text" name="code_share" id="code_share" class="form-control"
                                placeholder="Code Here" required value="{{$uniqu_id_share}}"></div>
                    </div>
                </div>

                {{--  share_amount --}}
                <div class="col-md-6 form-group">
                    <label for="share_amount">{{_lang('Share Amount')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min="0" step="0.01" required name="share_amount" id="share_amount"
                            placeholder="Enter Share Amount" class="form-control">
                    </div>
                </div>

                {{-- share type --}}
                {{-- <div class=" form-group col-md-6">
                    <label for="share_type">{{_lang('Share Type')}}
                        <span class="text-danger">*</span>
                    </label>

                    <div>
                        <select name="share_type" id="share_type" class="form-control select"
                            data-placeholder="Please Select One .." required
                            data-parsley-errors-container="#share_type_error">
                            <option value="">Please Select One ..</option>
                            @foreach ($share_types as $share_type)
                            <option value="{{$share_type->id}}">{{$share_type->rate}}% Per
                                {{$share_type->interest_period}}</option>
                            @endforeach
                        </select>
                        <span id="share_type_error"></span>

                    </div>
                </div> --}}
                {{--  pay_type --}}

                <div class=" form-group col-md-12">
                    <label for="payment_method">{{_lang('Payment Method')}}
                        <span class="text-danger">*</span>
                    </label>

                    <div>
                        <select name="payment_method" id="payment_method" class="form-control select"
                            data-placeholder="Please Select One .." required
                            data-parsley-errors-container="#payment_method_error">
                            <option value="">Please Select One ..</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank Check">Bank Check</option>
                            <option value="Mobile Banking">Mobile Banking</option>
                        </select>
                        <span id="payment_method_error"></span>

                    </div>
                </div>

                {{-- ::::::::::::::::   Payment method information     ::::::::::::::::::::: --}}

                {{-- ::::::::::::::::::    Mobile Banking Payment Information     :::::::::::::::::::: --}}
                <div class="mobile_banking col-md-12" style="display:none">
                    <h6 class="text-danger mobile_banking">Payment With Mobile Banking</h6>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6 mobile_banking">
                            <label for="mob_banking_name">{{_lang('Mobile Banking Name')}} </label>
                            <input type="text" name="mob_banking_name" id="mob_banking_name"
                                placeholder="Enter Mobile Banking Name "
                                class="form-control mobile_banking mobile_banking_required">
                        </div>

                        <div class="form-group col-md-6 mobile_banking">
                            <label for="mob_account_holder">{{_lang('Account Holder Name')}}
                            </label>
                            <div>
                                <input type="text" name="mob_account_holder" id="mob_account_holder"
                                    placeholder="Enter Account Holder Name" class="form-control mobile_banking">
                            </div>
                        </div>

                        <div class="form-group col-md-6 mobile_banking">
                            <label for="sending_mob_no">{{_lang('Sending Mobile No')}}
                            </label>
                            <div>
                                <input type="text" name="sending_mob_no" id="sending_mob_no"
                                    placeholder="Enter Sending Mobile No"
                                    class="form-control mobile_banking mobile_banking_required">
                            </div>
                        </div>

                        <div class="form-group col-md-6 mobile_banking">
                            <label for="receiving_mob_no">{{_lang('Receiving Mob No')}}
                            </label>
                            <div>
                                <input type="text" name="receiving_mob_no" id="receiving_mob_no"
                                    placeholder="Enter Receiving Mob No"
                                    class="form-control mobile_banking mobile_banking_required">
                            </div>
                        </div>

                        <div class="form-group col-md-6 mobile_banking">
                            <label for="mob_tx_id">{{_lang('Transaction ID')}}
                            </label>
                            <div>
                                <input type="text" name="mob_tx_id" id="mob_tx_id" placeholder="Enter Transaction ID"
                                    class="form-control mobile_banking mobile_banking_required">
                            </div>
                        </div>

                        <div class="form-group col-md-6 mobile_banking">
                            <label for="mob_payment_date">{{_lang('Payment Date')}}
                            </label>
                            <div>
                                <input type="text" readonly name="mob_payment_date" id="mob_payment_date"
                                    placeholder="Enter Payment Date"
                                    class="form-control mobile_banking date mobile_banking_required">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ::::::::::::::::::    Bank Check Payment Information     :::::::::::::::::::: --}}
                <div class="bank_check col-md-12" style="display:none">
                    <h6 class="text-danger">Payment With Bank Check</h6>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6 bank_check">
                            <label for="bank_name">{{_lang('Bank Name')}}

                            </label>
                            <div>
                                <input type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name "
                                    class="form-control bank_check bank_check_required">
                            </div>
                        </div>

                        <div class="form-group col-md-6 bank_check">
                            <label for="account_holder">{{_lang('Account Holder Name')}}
                            </label>
                            <div>
                                <input type="text" name="account_holder" id="account_holder"
                                    placeholder="Enter Account Holder Name"
                                    class="form-control bank_check bank_check_required">
                            </div>
                        </div>

                        <div class="form-group col-md-6 bank_check">
                            <label for="account_no">{{_lang('Account Number')}}
                            </label>
                            <div>
                                <input type="text" name="account_no" id="account_no"
                                    placeholder="Enter Bank Account Number"
                                    class="form-control bank_check bank_check_required">
                            </div>
                        </div>

                        <div class="form-group col-md-6 bank_check">
                            <label for="check_no">{{_lang('Check No')}}
                            </label>
                            <div>
                                <input type="text" name="check_no" id="check_no" placeholder="Enter Check No"
                                    class="form-control bank_check bank_check_required">
                            </div>
                        </div>

                        <div class="form-group col-md-6 bank_check">
                            <label for="check_active_date">{{_lang('Check Active Date')}}
                            </label>
                            <div>
                                <input type="text" readonly name="check_active_date" id="check_active_date"
                                    placeholder="Enter Check Active Date"
                                    class="form-control bank_check date bank_check_required">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12" id="transaction_date_div">
                    <label for="tx_date">{{_lang('Transaction Date')}}
                    </label>
                    <div>
                        <input type="text" readonly name="tx_date" id="tx_date" placeholder="Enter Transaction Date"
                            class="form-control  date ">
                    </div>
                </div>
            </div>

            @can('Member_list.create')
            <div class="form-group col-md-12" align="right">
                <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i
                        class="icon-arrow-right14 position-right"></i></button>
                <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                    <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
            </div>
            @endcan
    </div>
    </form>
</div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
<script src="{{ asset('js/member/list.js') }}"></script>
<script>
    $('#same_as_present_address').change(function () {
        var id = $(this).val();

        if (id == '0') {
            $('#present_address').fadeIn(1000);
        } else {
            $('#present_address').fadeOut(1000);
        }
    });

</script>
@endpush
