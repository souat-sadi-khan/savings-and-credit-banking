@extends('layouts.app', ['title' => _lang('
Update Last Verification'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title  text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="
        Update Last Verification ">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Update Last Verification ')}}</h1>
        <p>{{_lang('Here You Can Update Last Verification Information..')}}</p>
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
        <form action="{{route('admin.verified-loan.update-verification',$loan_confirmation->uuid)}}" method="post" id="content_form">
            @csrf
            <div class="row">

                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Member And Account Information</h3>
                    <hr>
                </div>



                <div class="col-md-6">

                {{-- Select Member --}}
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="service_name">{{_lang('Member')}} <span class="text-danger">*</span>
                        </label>

                        <input type="hidden" class="form-control" value="{{ $loan_info->member->id}}" readonly name="member_id" id="member_id">
                        <input type="hidden" class="form-control" value="{{ $loan_info->id}}" readonly name="loan_account_id" id="loan_account_id">

                        <input type="text" class="form-control"
                            value="{{ $loan_info->member->name_in_bangla.', '.$loan_info->member->contact_number }}"
                            readonly>

                    </div>
                </div>


                <div class="row">


                <div class="col-md-6 form-group">
                    <label for="prefix">{{_lang('Account Prefix')}} </label>
                    <div>
                        <input type="text" readonly class="form-control" id="prefix" name="prefix"
                            value="{{$loan_info->prefix}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="code">{{_lang('Account Code')}} </label>
                    <div>
                        <input type="text" readonly class="form-control" id="code" name="code"
                            value="{{numer_padding($loan_info->code, get_option('digits_loan_account_code'))}}">
                    </div>
                </div>



                </div>


                <div class="row">
                      {{-- Member  Address --}}
                <div class="col-md-12 form-group mamber_info" >
                    <label for="member_permanent_address">{{_lang(' Address')}}
                    </label>
                    <div>

                        <textarea name="member_permanent_address" readonly id="member_permanent_address"
                             class="form-control" style="width:100%">Father: {{$loan_info->member->father_name}}, Address: {{$loan_info->member->present_address_line_1}}</textarea>
                    </div>
                </div>


                </div>
                </div>

                {{-- for image and signature --}}
                <div class="col-md-6">
                    <div class="row">
                             <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="member_permanent_address">{{_lang('Photo')}}
                                </label>
                                <div>
                                    <a href="{{asset('storage/member/'.$loan_info->member->photo)}}" target="_blank"> <img src="{{asset('storage/member/'.$loan_info->member->photo)}}" id="member_image" width="60%"
                                            class="rounded img-thumbnail" alt="Photo Not Found"></a>
                                </div>
                            </div>

                        </div>

                        <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="member_permanent_address">{{_lang(' Signature')}}
                                </label>
                                <div>
                                        <a href="{{asset('storage/member/'.$loan_info->member->signature)}}" target="_blank"> <img src="{{asset('storage/member/'.$loan_info->member->signature)}}" id="member_sign" width="60%"
                                                class="rounded img-thumbnail" alt="Signature Not Found"></a>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Business Information</h3>
                    <hr>
                </div>

                {{-- Business Zone --}}
                <div class="col-md-6 form-group">
                    <label for="zone">{{_lang('Zone')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <select name="zone_id" id="zone" class="form-control select"
                            data-placeholder="Please Select One .." required
                            data-url="{{ route('admin.loan-account.zone-area') }}">
                            <option value="">Please Select One ..</option>
                            @foreach ($zones as $zone)

                            <option value="{{ $zone->id }}" {{ $zone->id == $loan_confirmation->zone_id?"selected":""}}>
                                {{$zone->zone}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Business Area --}}
                <div class="col-md-6 form-group">
                    <label for="area">{{_lang('Area')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <select name="area_id" id="area" class="form-control select"
                            data-placeholder="Please Select Zone First .." required>
                            @foreach ($zone_areas as $zone_area)

                            <option value="{{$zone_area->area->id}}"
                                {{$loan_confirmation->area_id == $zone_area->area->id?"selected":""}}>
                                {{$zone_area->area->area}},{{$zone_area->area->thana}} </option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label for="business_name">{{_lang('Business Name')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="text" required name="business_name" placeholder="Business Name"
                            class="form-control" value="{{$loan_confirmation->business_name}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="business_duration">{{_lang('Business Duration')}}
                    </label><span class="text-danger">*</span>
                        </div>
                        <div class="col-md-6"><input type="text" required name="business_duration" placeholder="Business Duration"
                            class="form-control" value="{{$loan_confirmation->business_duration}}"></div>
                        <div class="col-md-6">
                            <select name="duration_indication" id="duration_indication" class="form-control select"
                            data-placeholder="Please Select One .." required>
                            <option value="">Please Select One ..</option>
                            <option value="Year" {{ $loan_confirmation->duration_indication == 'Year' ? "Selected":"" }}>Year
                            </option>
                            <option value="Month" {{ $loan_confirmation->duration_indication == 'Month' ? "Selected":"" }}>Month
                            </option>
                        </select>
                        </div>
                    </div>
                </div>




                {{-- Business Address --}}
                <div class="col-md-6 form-group">
                    <label for="business_address">{{_lang('Business Address')}}
                    </label><span class="text-danger">*</span>
                    <div>
                            <input type="text" required name="business_address" class="form-control" id="business_address" placeholder="Enter Business Address" value="{{$loan_confirmation->business_address}}">
                    </div>
                </div>

                {{-- Business Investment --}}
                <div class="col-md-6 form-group">
                    <label for="business_investment">{{_lang('investment Amount(Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="number" min="0" step="1" required name="business_investment"
                            placeholder="Enter Business investment (taka)" class="form-control"
                            value="{{$loan_confirmation->business_investment}}">
                    </div>
                </div>

                {{-- Business Stock --}}
                <div class="col-md-6 form-group">
                    <label for="business_stock">{{_lang('Stock Amount(taka)')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="number" min="0" step="1" required name="business_stock"
                            placeholder="Enter Business Stock(Taka)" class="form-control"
                            value="{{$loan_confirmation->business_stock}}">
                    </div>
                </div>

                {{-- Business average_sell --}}
                <div class="col-md-6 form-group">
                    <label for="business_average_sell">{{_lang('Average Sell Amount/Day (taka)')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="number" min="0" step="1" required name="business_average_sell"
                            placeholder="Enter Average Sell Per Day(Taka)" class="form-control"
                            value="{{$loan_confirmation->business_average_sell}}">
                    </div>
                </div>

                {{-- Business average_income --}}
                <div class="col-md-6 form-group">
                    <label for="business_average_income">{{_lang('Average Income Amount/Day (taka)')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="number" min="0" step="1" required name="business_average_income"
                            placeholder="Enter Average Income Per Day(Taka)" class="form-control"
                            value="{{$loan_confirmation->business_average_income}}">
                    </div>
                </div>


                {{-- Business shop_owner --}}
                <div class="col-md-6 form-group">
                    <label for="business_shop_owner">{{_lang('Business Shop Owner')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <select name="business_shop_owner" id="business_shop_owner" class="form-control select"
                            data-placeholder="Please Select One .." required>
                            <option value="">Please Select One ..</option>
                            <option value="Own" {{ $loan_confirmation->business_shop_owner == "Own"? "Selected":"" }}>Own
                            </option>
                            <option value="Rent" {{ $loan_confirmation->business_shop_owner == "Rent"? "Selected":"" }}>Rent
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Business previous shop_owner --}}
                <div class="col-md-6 form-group own_shop"
                    style="{{$loan_confirmation->business_shop_owner == "Own"? " ":"display:none" }}">
                    <label for="shop_previous_position_owner">{{_lang('Shop Previous Position Owner')}}
                    </label>
                    <div>
                        <input type="text" name="shop_previous_position_owner" id="shop_previous_position_owner"
                    class="form-control own_shop_input" value="{{($loan_confirmation AND $loan_confirmation->shop_previous_position_owner)?$loan_confirmation->shop_previous_position_owner:''}}">
                    </div>
                </div>

                {{-- Business shop buy date --}}
                <div class="col-md-6 form-group own_shop"
                    style="{{$loan_confirmation->business_shop_owner == "Own"? " ":"display:none" }}">
                    <label for="position_buy_date">{{_lang('Position Buy Date')}}
                    </label>
                    <div>
                        <input type="text" name="position_buy_date" id="position_buy_date"
                            class="form-control own_shop_input date" readonly value="{{($loan_confirmation && $loan_confirmation->position_buy_date)?$loan_confirmation->position_buy_date:''}}">
                    </div>
                </div>

                {{-- Business shop buy date --}}
                <div class="col-md-6 form-group rent_shop"
                    style="{{$loan_confirmation->business_shop_owner == "Rent"? " ":"display:none" }}">
                    <label for="rent_start_date">{{_lang('Rent Start Date')}}
                    </label>
                    <div>
                        <input type="text" name="rent_start_date" id="rent_start_date"
                           class="form-control rent_shop_input date" readonly value="{{($loan_confirmation && $loan_confirmation->rent_start_date)?$loan_confirmation->rent_start_date:''}}">
                    </div>
                </div>

                {{-- Business shop rent Per month--}}
                <div class="col-md-6 form-group rent_shop"
                    style="{{$loan_confirmation->business_shop_owner == "Rent"? " ":"display:none" }}">
                    <label for="shop_rent_per_month">{{_lang('Shop Rent Per Month')}}
                    </label>
                    <div>
                        <input type="text" name="shop_rent_per_month" id="shop_rent_per_month"
                            placeholder="Shop Rent Per Month" class="form-control rent_shop_input" value="{{($loan_confirmation && $loan_confirmation->shop_rent_per_month)?$loan_confirmation->shop_rent_per_month:''}}">
                    </div>
                </div>

                {{-- Business Position contacted with--}}
                <div class="col-md-6 form-group rent_shop"
                    style="{{$loan_confirmation->business_shop_owner == "Rent"? " ":"display:none" }}">
                    <label for="shop_owner_name">{{_lang('Shop Owner Name')}}
                    </label>
                    <div>
                        <input type="text" name="shop_owner_name" id="shop_owner_name"
                            placeholder="Enter Shop Owner Name" class="form-control rent_shop_input" value="{{($loan_confirmation && $loan_confirmation->shop_owner_name)?$loan_confirmation->shop_owner_name:''}}">
                    </div>
                </div>


                {{-- Shop Booking Date--}}
                <div class="col-md-6 form-group rent_shop"
                    style="{{$loan_confirmation->business_shop_owner == "Rent"? " ":"display:none" }}">
                    <label for="shop_booked_from">{{_lang('Shop Booking Date')}}
                    </label>
                    <div>
                        <input type="text" name="shop_booked_from" id="shop_booked_from"
                             class="form-control rent_shop_input date" readonly value="{{($loan_confirmation && $loan_confirmation->shop_booked_from)?$loan_confirmation->shop_booked_from:''}}">
                    </div>
                </div>


                {{-- Investment Sector--}}
                <div class="col-md-6 form-group ">
                    <label for="investment_sector">{{_lang('Investment Sector')}}
                    </label>
                    <div>
                        <input type="text" name="investment_sector" required id="investment_sector"
                            placeholder="Enter Investment Sector" class="form-control" value="{{($loan_confirmation && $loan_confirmation->investment_sector)?$loan_confirmation->investment_sector:''}}">
                    </div>
                </div>





                <div class="col-md-12">
                    <hr>

                    <div class="animated-checkbox text-center">
                        <span style="font-size:27px"> <b> Loan Information || </b></span>
                        <span class="text-danger ml-2" style="font-size:18px">Round Floating values ?</span>
                        <label class="ml-2">
                            <input type="checkbox" id="round" name="round"
                                {{ $loan_confirmation->round == 1? "checked":"" }}><span class="label-text"></span>
                        </label>
                    </div>
                    <hr>
                </div>

                {{--  loan_amount --}}
                <div class="col-md-4 form-group">
                    <label for="loan_amount">{{_lang('Loan Amount (taka)')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="number" min="0" step="1" required name="loan_amount" id="loan_amount"
                            placeholder="Enter Expectd Loan Amount" class="form-control"
                            value="{{$loan_confirmation->loan_amount}}">
                    </div>
                </div>

                {{--  installmant_no --}}
                <div class="col-md-4 form-group">
                    <label for="installmant_no"> {{_lang('Loan Type')}} </label><span class="text-danger">*</span>
                    <div>
                        <select name="loan_type" id="loan_type" data-placeholder="Please Select One.."
                            class="form-control select"  required data-url="{{ route('admin.loan-account.loan_type')}}">
                            <option value="">Please Select One .. </option>
                            @foreach ($loan_types as $loan_type)
                            <option value="{{$loan_type->id}}"
                                {{ $loan_type->id == $loan_confirmation->loan_type?'selected':"" }}>
                                {{$loan_type->service_name.', '.$loan_type->duration.' '.$loan_type->duration_type.', '.$loan_type->rate.'%'}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{--  Interest Rate --}}
                <div class="col-md-4 form-group">
                    <label for="interest_rate">{{_lang('Interest Rate(%)')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="number" min='0' step="1" required name="interest_rate" id="interest_rate"
                            placeholder="Interest Rate(%)" class="form-control" value="{{$loan_confirmation->interest_rate}}">
                    </div>
                </div>

                {{--  installmant_no --}}
                <div class="col-md-3 form-group">
                    <label for="installment_no">{{_lang('No Of Installment')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="text" readonly required name="installment_no" id="installment_no"
                            placeholder="No Of Installment" class="form-control" value="{{$loan_confirmation->installment_no}}">
                    </div>
                </div>

                {{--  installment_amount --}}
                <div class="col-md-3 form-group">
                    <label for="installment_amount">{{_lang('Installment Amount (Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="text" readonly required name="installment_amount" id="installment_amount"
                            placeholder="Main Installment" class="form-control"
                            value="{{$loan_confirmation->installment_amount}}">
                    </div>
                </div>

                {{--  installment_interest --}}
                <div class="col-md-3 form-group">
                    <label for="installment_interest">{{_lang('Installment Interest (Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="text" readonly required name="installment_interest" id="installment_interest"
                            placeholder="Installment Interest" class="form-control"
                            value="{{$loan_confirmation->installment_interest}}">
                    </div>
                </div>

                {{--  installment_interest --}}
                <div class="col-md-3 form-group">
                    <label for="installment_total">{{_lang('Total Installment(Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="text" readonly required name="installment_total" id="installment_total"
                            placeholder="Total Installment" class="form-control"
                            value="{{$loan_confirmation->installment_total}}">
                    </div>
                </div>

                {{--  Loan Duration --}}
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">  <label for="loan_duration">{{_lang('Loan Duration')}}
                    </label><span class="text-danger">*</span></div>
                        <div class="col-md-6">
                            <input type="number" min='0' step="1" required name="loan_duration" id="loan_duration"
                            placeholder="Loan Duration" class="form-control" value="{{$loan_confirmation->loan_duration}}">
                        </div>
                        <div class="col-md-6">
                            <select name="loan_duration_type" id="loan_duration_type" data-placeholder="Please Select One.."
                            class="form-control select">
                            <option value="">Please Select One .. </option>
                            <option value="Day" {{ $loan_confirmation->loan_duration_type == "Day"?"selected":"" }}>Day</option>
                            <option value="Week" {{ $loan_confirmation->loan_duration_type == "Week"?"selected":"" }}>Week
                            </option>
                            <option value="Month" {{ $loan_confirmation->loan_duration_type == "Month"?"selected":"" }}>Month
                            </option>
                            <option value="Year" {{ $loan_confirmation->loan_duration_type == "Year"?"selected":"" }}>Year
                            </option>
                        </select>
                        </div>
                    </div>
                </div>




                {{--  Installment  Duration --}}
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                             <label for="installment_duration">{{_lang('Installment Duration')}}
                    </label><span class="text-danger">*</span>
                        </div>
                        <div class="col-md-6">
                             <input type="number" min='0' step="1" required name="installment_duration"
                            id="installment_duration" placeholder="Installment Duration" class="form-control"
                            value="{{$loan_confirmation->installment_duration}}">
                        </div>
                        <div class="col-md-6">
                             <select name="installment_duration_type" id="installment_duration_type"
                            data-placeholder="Please Select One.." class="form-control select">
                            <option value="">Please Select One .. </option>
                            <option value="Day" {{ $loan_confirmation->installment_duration_type == "Day"?"selected":"" }}>Day
                            </option>
                            <option value="Week" {{ $loan_confirmation->installment_duration_type == "Week"?"selected":"" }}>
                                Week</option>
                            <option value="Month" {{ $loan_confirmation->installment_duration_type == "Month"?"selected":"" }}>
                                Month</option>
                            <option value="Year" {{ $loan_confirmation->installment_duration_type == "Year"?"selected":"" }}>
                                Year</option>
                        </select>
                        </div>
                    </div>
                </div>






                {{--  loan_reason --}}
                <div class="col-md-12 form-group">
                    <label for="loan_reason">{{_lang('Loan Reason')}}
                    </label>
                    <div>
                        <textarea name="loan_reason" class="form-control" id="loan_reason" placeholder="Describe Loan Resoan"
                            style="width:100%">{{$loan_confirmation->loan_reason}}</textarea>
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
                    <div>
                        <input type="text" required name="sponsonr_name1" placeholder="Enter Sponsor Name"
                            class="form-control" value="{{$loan_confirmation->sponsonr_name1}}">
                    </div>
                </div>

                {{-- Sponsor's Father's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_fathers_name1">{{_lang('Father\'s Name')}}
                    </label>
                    <div>
                        <input type="text"  name="sponsor_fathers_name1" placeholder="Enter Father Name"
                            class="form-control" value="{{$loan_confirmation->sponsor_fathers_name1}}">
                    </div>
                </div>

                {{-- Sponsor's Husband's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_husbands_name1">{{_lang('Husband\'s Name')}}
                    </label>
                    <div>
                        <input type="text" name="sponsor_husbands_name1" placeholder="Enter Husband Name"
                            class="form-control" value="{{$loan_confirmation->sponsor_husbands_name1}}">
                    </div>
                </div>

                {{-- Sponsor's Relation with mamber --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_relation_with_member1">{{_lang('Relation With Member')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="text" required name="sponsor_relation_with_member1"
                            placeholder="Enter Relation With Member" class="form-control"
                            value="{{$loan_confirmation->sponsor_relation_with_member1}}">
                    </div>
                </div>

                {{-- Sponsor's Account No --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_account_no1">{{_lang('Account No')}}
                    </label>
                    <div>
                        <input type="text"  name="sponsor_account_no1" placeholder="Enter Account No"
                            class="form-control" value="{{$loan_confirmation->sponsor_account_no1}}">
                    </div>
                </div>

                {{-- Sponsor's Permanent Address --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_permanent_address1">{{_lang('Permanent Address')}}
                    </label><span class="text-danger">*</span>
                    <div>

                        <textarea name="sponsor_permanent_address1" required class="form-control" id="sponsor_permanent_address1"
                            placeholder="Enter Permanent Address"
                            style="width:100%">{{$loan_confirmation->sponsor_permanent_address1}}</textarea>
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
                    <div>
                        <input type="text" required name="sponsonr_name2" placeholder="Enter Sponsor Name"
                            class="form-control" value="{{$loan_confirmation->sponsonr_name2}}">
                    </div>
                </div>

                {{-- Sponsor's Father's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_fathers_name2">{{_lang('Father\'s Name')}}
                    </label>
                    <div>
                        <input type="text"  name="sponsor_fathers_name2" placeholder="Enter Father Name"
                            class="form-control" value="{{$loan_confirmation->sponsor_fathers_name2}}">
                    </div>
                </div>

                {{-- Sponsor's Husband's Name --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_husbands_name2">{{_lang('Husband\'s Name')}}
                    </label>
                    <div>
                        <input type="text" name="sponsor_husbands_name2" placeholder="Enter Husband Name"
                            class="form-control" value="{{$loan_confirmation->sponsor_husbands_name2}}">
                    </div>
                </div>

                {{-- Sponsor's Relation with mamber --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_relation_with_member2">{{_lang('Relation With Member')}}
                    </label><span class="text-danger">*</span>
                    <div>
                        <input type="text" required name="sponsor_relation_with_member2"
                            placeholder="Enter Relation With Member" class="form-control"
                            value="{{$loan_confirmation->sponsor_relation_with_member2}}">
                    </div>
                </div>

                {{-- Sponsor's Account No --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_account_no2">{{_lang('Account No')}}
                    </label>
                    <div>
                        <input type="text"  name="sponsor_account_no2" placeholder="Enter Account No"
                            class="form-control" value="{{$loan_confirmation->sponsor_account_no2}}">
                    </div>
                </div>

                {{-- Sponsor's Permanent Address --}}
                <div class="col-md-6 form-group">
                    <label for="sponsor_permanent_address2">{{_lang('Permanent Address')}}
                    </label><span class="text-danger">*</span>
                    <div>

                        <textarea name="sponsor_permanent_address2" required id="sponsor_permanent_address2"
                            placeholder="Enter Permanent Address" class="form-control"
                            style="width:100%">{{$loan_confirmation->sponsor_permanent_address1}}</textarea>
                    </div>
                </div>
<div class="col-md-12"><hr></div>
                <div class="col-md-6 text-right mt-3">
                   <h4> <b>{{_lang('Investigation Result')}}</b><span class="text-danger">*</span> </h4>
                </div>
                <div class="col-md-6">
                    <div class="animated-radio-button">
                        <label>
                            <input type="radio" name="confirmation" class="sohag" value="Confirmed"  {{($loan_confirmation->confirmation == 'Confirmed')?"checked":''}}
                               @if (!$loan_confirmation->confirmation)
                                  checked
                               @endif ><span class="label-text text-danger" >Confirm Loan</span>
                        </label>
                    </div>
                    <div class="animated-radio-button">
                        <label>
                            <input type="radio" name="confirmation" class="sohag" value="Refused" {{($loan_confirmation->confirmation == 'Refused')?"checked":''}}><span class="label-text text-danger"  >Refuse Loan</span>
                        </label>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <p class="text-center">
                        <span class="badge badge-danger">Remember:</span> If You Edit Verification Of An Approved Loan And Refuse It Then <span class=" text-danger">The Transaction Related With It Will Be Erased</span>. If You Do So It's Your Responsibility. So Handle It With Care...
                    </p>
                    <hr>
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
