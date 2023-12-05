@extends('layouts.app', ['title' => _lang('Loan Application Form'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title  text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Loan Application Form "> {{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Loan Application Form ')}}</h1>
        <p>{{_lang('Here You Can Submit Loan Applicaiton')}}</p>
    </div>
    {{--<ul class="app-breadcrumb breadcrumb">
        --}}{{-- {{ Breadcrumbs::render('/employee-details') }} --}}{{--
    </ul>--}}
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <form action="{{route('admin.loan-account.store')}}" method="post" id="content_form">
            @csrf
            <div class="col-md-12">
                <hr>
                <h3 class="text-center">Member And Account Information</h3>
                <hr>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="member_id">{{_lang('Select Member')}} <span class="text-danger">*</span>
                            </label>
                            <select name="member_id" id="member_id"
                                data-url="{{ route('admin.loan-account.member-info') }}" class="form-control select"
                                data-placeholder="Please Select One .." required data-parsley-errors-container="#member_id_error">
                                <option value="">Please Select One ..</option>
                                @foreach ($model as $member)
                                <option value="{{$member->id}}">
                                    {{ $member->name_in_bangla.', '.$member->contact_number }}
                                </option>
                                @endforeach
                            </select>
                            <span id="member_id_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="prefix">{{_lang('Account Prefix')}} </label>
                            <div class="">
                                <input type="text" class="form-control" id="prefix" name="prefix"
                                    value="{{$code_prefix}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="code">{{_lang('Account Code')}} </label>
                            <div class="">
                                <input type="text" class="form-control" id="code" name="code" value="{{$uniqu_id}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Member  Address --}}
                        <div class="col-md-12 form-group mamber_info">
                            <label for="member_permanent_address">{{_lang(' Address')}}
                            </label>
                            <div class="">

                                <textarea name="member_permanent_address" class="form-control" id="member_permanent_address" readonly
                                    style="width:100%"></textarea>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="col-md-6">
                    <div class="row">
                        <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="member_permanent_address">{{_lang(' Photo')}}
                                </label>
                                <div>
                                    <a href="" target="_blank"> <img src="" id="member_image" width="60%"
                                            class="rounded img-thumbnail" alt="Photo Not Found"></a>
                                </div>
                            </div>

                        </div>

                        <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="member_permanent_address">{{_lang(' Signature')}}
                                </label>
                                <div>
                                        <a href="" target="_blank"> <img src="" id="member_sign" width="60%"
                                                class="rounded img-thumbnail" alt="Signature Not Found"></a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>












            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Business Information</h3>
                    <hr>
                </div>

                {{-- Business Zone --}}
                <div class="col-md-6 form-group">
                    <label for="zone">{{_lang('Zone')}}<span class="text-danger">*</span>
                    </label>
                    <div class="">
                        <select name="zone_id" id="zone" class="form-control select"
                            data-placeholder="Please Select One .." required
                            data-url="{{ route('admin.loan-account.zone-area') }}" data-parsley-errors-container="#zone_id_error">
                            <option value="">Please Select One ..</option>
                            @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}">{{$zone->zone}}</option>
                            @endforeach
                        </select>
                        <span id="zone_id_error"></span>
                    </div>
                </div>

                {{-- Business Area --}}
                <div class="col-md-6 form-group">
                    <label for="area">{{_lang('Area')}}<span class="text-danger">*</span>
                    </label>
                    <div class="">
                        <select name="area_id" id="area" class="form-control select"
                            data-placeholder="Please Select Zone First .." required data-parsley-errors-container="#area_id_error">
                            <option value="">Please Select Zone First ..</option>

                        </select>
                        <span id="area_id_error"></span>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label for="business_name">{{_lang('Business Name')}}<span class="text-danger">*</span>
                    </label>
                    <div class="">
                        <input type="text" required name="business_name" placeholder="Business Name"
                            class="form-control">
                    </div>
                </div>

                <div class="col-md-6 form-group ">
                    <div class="row">
                    <div class="col-md-12">
                        <label for="business_duration">{{_lang('Business Duration')}}<span class="text-danger">*</span>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" required name="business_duration" placeholder="Business Duration"
                            class="form-control">
                    </div>

                    <div class="col-md-6">
                        <select name="duration_indication" id="duration_indication" class="form-control select"
                            data-placeholder="Please Select One .." required data-parsley-errors-container="#business_duration_indication_error">
                            <option value="">Please Select One ..</option>
                            <option value="Year">Year</option>
                            <option value="Month">Month</option>
                        </select>
                        <span id="business_duration_indication_error"></span>
                    </div>
                    </div>
                </div>


                {{-- Business Address --}}
                <div class="col-md-6 form-group">
                    <label for="business_address">{{_lang('Business Address')}}<span class="text-danger">*</span>
                    </label>
                    <div class="">

                        <input type="text" required  class="form-control" name="business_address" id="business_address" placeholder="Enter Business Address"
                            style="width:100%">
                    </div>
                </div>

                {{-- Business Investment --}}
                <div class="col-md-6 form-group">
                    <label for="business_investment">{{_lang('investment Amount(Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min="0" step="1" required name="business_investment"
                            placeholder="Enter Business investment (taka)" class="form-control">
                    </div>
                </div>

                {{-- Business Stock --}}
                <div class="col-md-6 form-group">
                    <label for="business_stock">{{_lang('Stock Amount(taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min="0" step="1" required name="business_stock"
                            placeholder="Enter Business Stock(Taka)" class="form-control">
                    </div>
                </div>

                {{-- Business average_sell --}}
                <div class="col-md-6 form-group">
                    <label for="business_average_sell">{{_lang('Average Sell Amount/Day (taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min="0" step="1" required name="business_average_sell"
                            placeholder="Enter Average Sell Per Day(Taka)" class="form-control">
                    </div>
                </div>

                {{-- Business average_income --}}
                <div class="col-md-6 form-group">
                    <label for="business_average_income">{{_lang('Average Income Amount/Day (taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min="0" step="1" required name="business_average_income"
                            placeholder="Enter Average Income Per Day(Taka)" class="form-control">
                    </div>
                </div>


                {{-- Business shop_owner --}}
                <div class="col-md-6 form-group">
                    <label for="business_shop_owner">{{_lang('Business Shop Owner')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <select name="business_shop_owner" id="business_shop_owner" class="form-control select"
                            data-placeholder="Please Select One .." required data-parsley-errors-container="#parsley_business_shop_owner_error">
                            <option value="">Please Select One ..</option>
                            <option value="Own">Own</option>
                            <option value="Rent">Rent</option>
                        </select>
                        <span id="parsley_business_shop_owner_error"></span>
                    </div>
                </div>





                <div class="col-md-12">
                    <hr>

                    <div class="animated-checkbox text-center">
                        <span style="font-size:27px"> <b> Loan Information || </b></span>
                        <span class="text-danger ml-2" style="font-size:18px">Round Floating values ?</span>
                        <label class="ml-2">
                            <input type="checkbox" id="round" name="round"><span class="label-text"></span>
                        </label>
                    </div>
                    <hr>
                </div>

                {{--  loan_amount --}}
                <div class="col-md-4 form-group">
                    <label for="loan_amount">{{_lang('Loan Amount (taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min="0" step="1" required name="loan_amount" id="loan_amount"
                            placeholder="Enter Expectd Loan Amount" class="form-control">
                    </div>
                </div>

                {{--  loan_type --}}
                <div class="col-md-4 form-group">
                    <label for="loan_type"> {{_lang('Loan Type')}} </label><span class="text-danger">*</span>
                    <div class="">
                        <select name="loan_type" id="loan_type" data-placeholder="Please Select One.."
                            class="form-control select" data-url="{{ route('admin.loan-account.loan_type')}}" required data-parsley-errors-container="#loan_type_error">
                            <option value="">Please Select One .. </option>
                            @foreach ($loan_types as $loan_type)
                            <option value="{{$loan_type->id}}">
                                {{$loan_type->service_name.', '.$loan_type->duration.' '.$loan_type->duration_type.', '.$loan_type->rate.'%'}}
                            </option>
                            @endforeach
                        </select>
                        <span id="loan_type_error"></span>
                    </div>
                </div>

                {{--  Interest Rate --}}
                <div class="col-md-4 form-group">
                    <label for="interest_rate">{{_lang('Interest Rate(%)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min='0' step="1" required name="interest_rate" id="interest_rate"
                            placeholder="Interest Rate(%)" class="form-control">
                    </div>
                </div>

                {{--  installmant_no --}}
                <div class="col-md-3 form-group">
                    <label for="installment_no">{{_lang('No Of Installment')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text"  required name="installment_no" id="installment_no"
                            placeholder="No Of Installment" class="form-control">
                    </div>
                </div>

                {{--  installment_amount --}}
                <div class="col-md-3 form-group">
                    <label for="installment_amount">{{_lang('Installment Amount (Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" readonly required name="installment_amount" id="installment_amount"
                            placeholder="Main Installment" class="form-control">
                    </div>
                </div>

                {{--  installment_interest --}}
                <div class="col-md-3 form-group">
                    <label for="installment_interest">{{_lang('Installment Interest (Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" readonly required name="installment_interest" id="installment_interest"
                            placeholder="Installment Interest" class="form-control">
                    </div>
                </div>

                {{--  installment_interest --}}
                <div class="col-md-3 form-group">
                    <label for="installment_total">{{_lang('Total Installment(Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" readonly required name="installment_total" id="installment_total"
                            placeholder="Total Installment" class="form-control">
                    </div>
                </div>

                {{--  Loan Duration --}}
                <div class="col-md-6 form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="loan_duration">{{_lang('Loan Duration')}}
                            </label><span class="text-danger">*</span>
                        </div>
                        <div class="col-md-6">
                            <input type="number" min='0' step="1" required name="loan_duration" id="loan_duration"
                            placeholder="Loan Duration" class="form-control">
                        </div>
                        <div class="col-md-6">
                             <select name="loan_duration_type" required id="loan_duration_type" data-placeholder="Please Select One.."
                            class="form-control select" data-parsley-errors-container="#laon_duration_type_error">
                            <option value="">Please Select One .. </option>
                            <option value="Day">Day</option>
                            {{-- <option value="Week">Week</option> --}}
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
                        <span id="laon_duration_type_error"></span>
                        </div>
                    </div>

                </div>






                {{--  Installment  Duration --}}
                <div class="col-md-6 form-group">
                    <div class="row">
                        <div class="col-md-12">

                            <label for="installment_duration">{{_lang('Installment Duration')}}
                            </label><span class="text-danger">*</span>
                        </div>
                        <div class="col-md-6">
                            <input type="number" min='0' step="1" required name="installment_duration"
                            id="installment_duration" placeholder="Installment Duration" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <select name="installment_duration_type" id="installment_duration_type"
                            data-placeholder="Please Select One.." class="form-control select" data-parsley-errors-container="#installment_duration_type_error" required>
                            <option value="">Please Select One .. </option>
                            <option value="Day">Day</option>
                            <option value="Week">Week</option>
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
                        <span id="installment_duration_type_error"></span>
                        </div>
                    </div>

                </div>





                {{--  loan_reason --}}
                <div class="col-md-12 form-group">
                    <label for="loan_reason">{{_lang('Loan Reason')}}
                    </label>
                    <div class="">
                        <textarea name="loan_reason" class="form-control" id="loan_reason" placeholder="Describe Loan Resoan"
                            style="width:100%"></textarea>
                    </div>
                </div>


                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Sponsor's Information (01)</h3>
                    <hr>
                </div>

                {{-- Sponsor's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsonr_name1">{{_lang('Name')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" required name="sponsonr_name1" placeholder="Enter Sponsor Name"
                            class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Father's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_fathers_name1">{{_lang('Father\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="sponsor_fathers_name1" placeholder="Enter Father Name"
                            class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Husband's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_husbands_name1">{{_lang('Husband\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="sponsor_husbands_name1" placeholder="Enter Husband Name"
                            class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Relation with mamber --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_relation_with_member1">{{_lang('Relation With Member')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" required name="sponsor_relation_with_member1"
                            placeholder="Enter Relation With Member" class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Account No --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_account_no1">{{_lang('Account No')}}
                    </label>
                    <div class="">
                        <input type="text"  name="sponsor_account_no1" placeholder="Enter Account No"
                            class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Permanent Address --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_permanent_address1">{{_lang('Permanent Address')}}
                    </label><span class="text-danger">*</span>
                    <div class="">

                        <textarea required name="sponsor_permanent_address1" class="form-control" id="sponsor_permanent_address1"
                            placeholder="Enter Permanent Address" style="width:100%"></textarea>
                    </div>
                </div>


                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Sponsor's Information (02)</h3>
                    <hr>
                </div>

                {{-- Sponsor's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsonr_name2">{{_lang('Name')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" required name="sponsonr_name2" placeholder="Enter Sponsor Name"
                            class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Father's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_fathers_name2">{{_lang('Father\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="sponsor_fathers_name2" placeholder="Enter Father Name"
                            class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Husband's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_husbands_name2">{{_lang('Husband\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="sponsor_husbands_name2" placeholder="Enter Husband Name"
                            class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Relation with mamber --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_relation_with_member2">{{_lang('Relation With Member')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" required name="sponsor_relation_with_member2"
                            placeholder="Enter Relation With Member" class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Account No --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_account_no2">{{_lang('Account No')}}
                    </label>
                    <div class="">
                        <input type="text"  name="sponsor_account_no2" placeholder="Enter Account No"
                            class="form-control">
                    </div>
                </div>

                {{-- Sponsor's Permanent Address --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_permanent_address2">{{_lang('Permanent Address')}}
                    </label><span class="text-danger">*</span>
                    <div class="">

                        <textarea name="sponsor_permanent_address2" class="form-control" id="sponsor_permanent_address2" required
                            placeholder="Enter Permanent Address" style="width:100%"></textarea>
                    </div>
                </div>

                {{-- Active Status --}}
                <div class="col-md-12 form-group">
                    <label for="status">{{_lang('Active Status')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <select name="status" id="status" data-placeholder="Please Select One.."
                            class="form-control select" required data-parsley-errors-container="#status_error">
                            <option value="">Please Select One .. </option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <span id="status_error"></span>
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
<script src="{{ asset('js/pages/loan_account.js') }}"></script>

<script>
    $('.select').select2({
        width: '100%'
    });

</script>


@endpush
