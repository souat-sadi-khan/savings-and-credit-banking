@extends('layouts.app', ['title' => _lang('Loan Account Information Of'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Loan Account Information Of  {{$loan_info->member->name_in_bangla}}">{{--<i
                class="fa fa-users mr-4"></i>--}}
            {{_lang('Loan Account Information Of ')}}{{$loan_info->member->name_in_bangla}}</h1>
        <p>{{_lang('Here you can see approved loan account information')}}</p>
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
        <div class="col-md-12">
            <hr>
            <h3 class="text-center">Member & Account Information</h3>
            <hr>
        </div>
        <div class="row">
            {{-- The following div is for image of member --}}
            <div class="col-md-3 d-flex">
                <a href="{{asset('storage/member/'.$loan_info->member->photo)}}" target="_blank">
                    <img src="{{asset('storage/member/'.$loan_info->member->photo)}}" width="80%"
                        alt="Image Not Uploaded." class="rounded img-thumbnail">
                </a>
            </div>
            {{-- the following div is for member basic information   --}}
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">General Information</h5>
                            <hr>
                        </div>
                        <div><span class="font-weight-bold mr-3">Member Id:</span>
                            <span>{{$loan_info->member->prefix.'-'.numer_padding($loan_info->member->code, get_option('digits_member_code'))}}</span>
                        </div>

                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$loan_info->member->name_in_bangla}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Father's Name:</span>
                            <span>{{$loan_info->member->father_name}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Mother's Name:</span>
                            <span>{{$loan_info->member->mother_name}}</span>
                        </div>

                        <div><span class="font-weight-bold mr-3">Signature : </span>
                            <span><a href="{{asset('storage/member/'.$loan_info->member->signature)}}" target="_blank">
                                    <img src="{{asset('storage/member/'.$loan_info->member->signature)}}" width="30%"
                                        alt="Signature Not Uploaded." class="rounded img-thumbnail">
                                </a></span></div>

                        @if ($loan_info->member->created_at)
                        <div><span class="font-weight-bold mr-3">Member From : </span>
                            <span>{{carbonDate($loan_info->member->created_at)}}</span></div>
                        @endif


                    </div>

                    <div class="col-md-4">
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Permanent Address</h5>
                            <hr>
                        </div>
                        @if ($loan_info->member->same_as_present_address == 1)
                        <div class="text-danger">Permanent Address Is Same As Present Address</div>
                        @else
                        <div><span class="font-weight-bold mr-3">Line 1: </span>
                            <span>{{$loan_info->member->permanent_address_line_1}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 2: </span>
                            <span>{{$loan_info->member->permanent_address_line_2}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">City: </span>
                            <span>{{$loan_info->member->permanent_city}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">State: </span>
                            <span>{{$loan_info->member->permanent_state}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Zip Code: </span>
                            <span>{{$loan_info->member->permanent_zipcode}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Country: </span>
                            <span>{{$loan_info->member->permanent_country}}</span>
                        </div>
                        @endif

                        @if ($loan_info->member->nid)
                        <div><span class="font-weight-bold mr-3">National ID No : </span>
                            <span>{{$loan_info->member->nid}}</span>
                        </div>
                        @endif

                        @if ($loan_info->member->birth_certificate_number)
                        <div><span class="font-weight-bold mr-3">Birth Certificate No : </span>
                            <span>{{$loan_info->member->birth_certificate_number}}</span></div>
                        @endif



                    </div>
                    <div class="col-md-4">

                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Present Address</h5>
                            <hr>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 1:</span>
                            <span>{{$loan_info->member->present_address_line_1}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 2:</span>
                            <span>{{$loan_info->member->present_address_line_2}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">City:</span>
                            <span>{{$loan_info->member->present_city}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">State:</span>
                            <span>{{$loan_info->member->present_state}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Zip Code:</span>
                            <span>{{$loan_info->member->present_zipcode}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Country:</span>
                            <span>{{$loan_info->member->present_country}}</span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-md-12 mt-3 d-flex">
            {{-- Nomeene And Identifiers information  --}}

            <h3 class="mt-3 col-md-5">Application Information </h3>
            <h3 class="mt-3 text-danger col-md-2"> <span class="badge badge-danger"> VS </span></h3>
            <h3 class="mt-3 col-md-5">Verification Information</h3>

        </div>
        <hr>
        {{-- Application Information --}}
        <div class="row">
            <div class="col-md-12">
                {{-- in the left side I Will show Nomeene information and in the righ side i will show identifiers information  --}}
                <div class="row">

                    <div class="col-md-6">
                        {{-- Application sponsor  --}}
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Sponsor Information (01)</h5>
                            <hr>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$loan_info->sponsonr_name1}}</span>
                        </div>
                        @if ( $loan_info->sponsor_fathers_name1 )

                        <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                            <span>{{$loan_info->sponsor_fathers_name1}}</span>
                        </div>
                        @endif

                        @if ( $loan_info->sponsor_husbands_name1 )

                        <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                            <span>{{$loan_info->sponsor_husbands_name1}}</span>
                        </div>
                        @endif
                        <div><span class="font-weight-bold mr-3"> Account No: </span>
                            <span>{{$loan_info->sponsor_account_no1 }}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Address: </span>
                            <span>{{$loan_info->sponsor_permanent_address1 }}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Relation : </span>
                            <span class="badge badge-success"> {{$loan_info->sponsor_relation_with_member1 }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- Verified sponsor information 01  --}}
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Sponsor Information (01)</h5>
                            <hr>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$loan_confirmation->sponsonr_name1}}</span>
                        </div>
                        @if ( $loan_confirmation->sponsor_fathers_name1 )

                        <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                            <span>{{$loan_confirmation->sponsor_fathers_name1}}</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->sponsor_husbands_name1 )

                        <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                            <span>{{$loan_confirmation->sponsor_husbands_name1}}</span>
                        </div>
                        @endif
                        <div><span class="font-weight-bold mr-3"> Account No: </span>
                            <span>{{$loan_confirmation->sponsor_account_no1 }}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Address: </span>
                            <span>{{$loan_confirmation->sponsor_permanent_address1 }}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Relation : </span>
                            <span class="badge badge-success">
                                {{$loan_confirmation->sponsor_relation_with_member1 }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {{-- Application Sponsor Information 02  --}}
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Sponsor Information (02)</h5>
                            <hr>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$loan_info->sponsonr_name2}}</span>
                        </div>
                        @if ( $loan_info->sponsor_fathers_name2 )

                        <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                            <span>{{$loan_info->sponsor_fathers_name2}}</span>
                        </div>
                        @endif
                        @if ( $loan_info->sponsor_husbands_name2 )

                        <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                            <span>{{$loan_info->sponsor_husbands_name2}}</span>
                        </div>
                        @endif
                        <div><span class="font-weight-bold mr-3"> Account No: </span>
                            <span>{{$loan_info->sponsor_account_no2 }}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Address: </span>
                            <span>{{$loan_info->sponsor_permanent_address2 }}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Relation : </span>
                            <span class="badge badge-success"> {{$loan_info->sponsor_relation_with_member2 }}</span>
                        </div>

                    </div>
                    <div class="col-md-6">
                        {{-- Verified Sponsor Information  --}}
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Sponsor Information (02)</h5>
                            <hr>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$loan_confirmation->sponsonr_name2}}</span>
                        </div>
                        @if ( $loan_confirmation->sponsor_fathers_name2 )

                        <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                            <span>{{$loan_confirmation->sponsor_fathers_name2}}</span>
                        </div>
                        @endif
                        @if ( $loan_confirmation->sponsor_husbands_name2 )

                        <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                            <span>{{$loan_confirmation->sponsor_husbands_name2}}</span>
                        </div>
                        @endif
                        <div><span class="font-weight-bold mr-3"> Account No: </span>
                            <span>{{$loan_confirmation->sponsor_account_no2 }}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Address: </span>
                            <span>{{$loan_confirmation->sponsor_permanent_address2 }}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Relation : </span>
                            <span class="badge badge-success">
                                {{$loan_confirmation->sponsor_relation_with_member2 }}</span>
                        </div>

                    </div>
                </div>

                <div class="row">
                    {{-- Applied Business Information --}}
                    <div class="col-md-6">
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Business Information</h5>
                            <hr>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$loan_info->business_name}}</span>
                        </div>
                        @if ( $loan_info->business_duration )

                        <div><span class="font-weight-bold mr-3"> Duration: </span>
                            <span>{{$loan_info->business_duration}} {{$loan_info->duration_indication}}</span>
                        </div>
                        @endif
                        @if ( $loan_info->business_address )
                        <div><span class="font-weight-bold mr-3"> Address: </span>
                            <span>{{$loan_info->business_address}}</span>
                        </div>
                        @endif

                        @if ( $loan_info->Investment )
                        <div><span class="font-weight-bold mr-3"> Investment: </span>
                            <span>{{$loan_info->Investment}} (Taka)</span>
                        </div>
                        @endif

                        @if ( $loan_info->business_stock )
                        <div><span class="font-weight-bold mr-3"> Stock: </span>
                            <span>{{$loan_info->business_stock}} (Taka)</span>
                        </div>
                        @endif

                        @if ( $loan_info->business_average_sell )
                        <div><span class="font-weight-bold mr-3"> Average Sell: </span>
                            <span>{{$loan_info->business_average_sell}} (Taka/Day)</span>
                        </div>
                        @endif

                        @if ( $loan_info->business_average_income )
                        <div><span class="font-weight-bold mr-3"> Average Income: </span>
                            <span>{{$loan_info->business_average_income}} (Taka/Day)</span>
                        </div>
                        @endif

                        @if ( $loan_info->business_shop_owner )
                        <div><span class="font-weight-bold mr-3"> Shop Owner: </span>
                            <span>{{$loan_info->business_shop_owner}} </span>
                        </div>
                        @endif

                    </div>

                    {{-- Verified business information  --}}
                    <div class="col-md-6">
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Business Information</h5>
                            <hr>
                        </div>
                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$loan_confirmation->business_name}}</span>
                        </div>
                        @if ( $loan_confirmation->business_duration )

                        <div><span class="font-weight-bold mr-3"> Duration: </span>
                            <span>{{$loan_confirmation->business_duration}}
                                {{$loan_confirmation->duration_indication}}</span>
                        </div>
                        @endif
                        @if ( $loan_confirmation->business_address )
                        <div><span class="font-weight-bold mr-3"> Address: </span>
                            <span>{{$loan_confirmation->business_address}}</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->Investment )
                        <div><span class="font-weight-bold mr-3"> Investment: </span>
                            <span>{{$loan_confirmation->Investment}} (Taka)</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->business_stock )
                        <div><span class="font-weight-bold mr-3"> Stock: </span>
                            <span>{{$loan_confirmation->business_stock}} (Taka)</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->business_average_sell )
                        <div><span class="font-weight-bold mr-3"> Average Sell: </span>
                            <span>{{$loan_confirmation->business_average_sell}} (Taka/Day)</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->business_average_income )
                        <div><span class="font-weight-bold mr-3"> Average Income: </span>
                            <span>{{$loan_confirmation->business_average_income}} (Taka/Day)</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->business_shop_owner )
                        <div><span class="font-weight-bold mr-3"> Shop Owner: </span>
                            <span>{{$loan_confirmation->business_shop_owner}} </span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->business_shop_owner )
                        <div><span class="font-weight-bold mr-3"> Shop Owner: </span>
                            <span>{{$loan_confirmation->business_shop_owner}} </span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->shop_previous_position_owner )
                        <div><span class="font-weight-bold mr-3">Previous Shop Owner: </span>
                            <span>{{$loan_confirmation->shop_previous_position_owner}} </span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->position_buy_date )
                        <div><span class="font-weight-bold mr-3">Position Buy Date: </span>
                            <span>{{$loan_confirmation->position_buy_date}} </span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->rent_start_date )
                        <div><span class="font-weight-bold mr-3">Rent Start Date: </span>
                            <span>{{$loan_confirmation->rent_start_date}} </span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->shop_rent_per_month )
                        <div><span class="font-weight-bold mr-3">Shop Rent: </span>
                            <span>{{$loan_confirmation->shop_rent_per_month}} (Taka/Month)</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->shop_owner_name )
                        <div><span class="font-weight-bold mr-3">Shop Owner Name: </span>
                            <span>{{$loan_confirmation->shop_owner_name}}</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->shop_booked_from )
                        <div><span class="font-weight-bold mr-3">Shop Booked From: </span>
                            <span>{{$loan_confirmation->shop_booked_from}}</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->investment_sector )
                        <div><span class="font-weight-bold mr-3">Investment Sector: </span>
                            <span>{{$loan_confirmation->investment_sector}}</span>
                        </div>
                        @endif

                    </div>
                </div>



                <div class="row">


                    <div class="col-md-6">
                        {{-- application loan information --}}
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Loan Information</h5>
                            <hr>
                        </div>
                        {{-- this section will be used for nomeene information  --}}

                        <div><span class="font-weight-bold mr-3">A/C No:</span>
                            <span>{{$loan_info->prefix.'-'.numer_padding($loan_info->code, get_option('digits_loan_account_code'))}}</span>
                        </div>

                        @if ($loan_info->loan_amount)
                        <div><span class="font-weight-bold mr-3">Loan Amount: </span>
                            <span>{{$loan_info->loan_amount}} (Taka)</span></div>
                        @endif

                        @if ($loan_info->interest_rate)
                        <div><span class="font-weight-bold mr-3">Interest Rate: </span>
                            <span>{{$loan_info->interest_rate}} (%)</span></div>
                        @endif

                        @if ($loan_info->loan_duration)
                        <div><span class="font-weight-bold mr-3">Loan Duration: </span>
                            <span>{{$loan_info->loan_duration}} ({{ $loan_info->loan_duration_type }})</span></div>
                        @endif

                        @if ($loan_info->loan_reason)
                        <div><span class="font-weight-bold mr-3">Loan Reason: </span>
                            <span>{{$loan_info->loan_reason}}</span></div>
                        @endif



                        <div><span class="font-weight-bold mr-3">Applied At : </span>
                            <span>{{carbonDate($loan_info->created_at)}}</span></div>

                        <div><span class="font-weight-bold mr-3">Status : </span>
                            @if ($loan_info->status=='Active')
                            <span class="badge badge-success">{{($loan_info->status)}}</span>
                            @else
                            <span class="badge badge-danger">{{($loan_info->status)}}</span>

                            @endif
                        </div>

                        @if ( $loan_info->installment_no )
                        <div><span class="font-weight-bold mr-3"> No Of Installment: </span>
                            <span>{{$loan_info->installment_no}}</span>
                        </div>
                        @endif

                        @if ( $loan_info->installment_amount )
                        <div><span class="font-weight-bold mr-3"> Installment Of Capital: </span>
                            <span>{{$loan_info->installment_amount}} (Taka/Installment)</span>
                        </div>
                        @endif

                        @if ( $loan_info->installment_interest )
                        <div><span class="font-weight-bold mr-3"> Installment Of Interest: </span>
                            <span>{{$loan_info->installment_interest}} (Taka/Installment)</span>
                        </div>
                        @endif

                        @if ( $loan_info->installment_total )
                        <div><span class="font-weight-bold mr-3"> Total Installment: </span>
                            <span>{{$loan_info->installment_total}} (Taka/Installment)</span>
                        </div>
                        @endif

                        @if ( $loan_info->installment_duration )
                        <div><span class="font-weight-bold mr-3"> Installment Interval: </span>
                            <span>{{$loan_info->installment_duration}}
                                ({{ $loan_info->installment_duration_type }})</span>
                        </div>
                        @endif

                    </div>


                    <div class="col-md-6">
                        {{-- verified loan information --}}
                        <div class="col-md-12 mt-3 mb-2 text-primary">
                            <h5 class="text-left">Loan Information</h5>
                            <hr>
                        </div>

                        <div><span class="font-weight-bold mr-3">A/C No:</span>
                            <span>{{$loan_confirmation->prefix.'-'.numer_padding($loan_confirmation->code, get_option('digits_loan_account_code'))}}</span>
                        </div>

                        @if ($loan_confirmation->loan_amount)
                        <div><span class="font-weight-bold mr-3">Loan Amount: </span>
                            <span>{{$loan_confirmation->loan_amount}} (Taka)</span></div>
                        @endif

                        @if ($loan_confirmation->interest_rate)
                        <div><span class="font-weight-bold mr-3">Interest Rate: </span>
                            <span>{{$loan_confirmation->interest_rate}} (%)</span></div>
                        @endif

                        @if ($loan_confirmation->loan_duration)
                        <div><span class="font-weight-bold mr-3">Loan Duration: </span>
                            <span>{{$loan_confirmation->loan_duration}}
                                ({{ $loan_confirmation->loan_duration_type }})</span></div>
                        @endif

                        @if ($loan_confirmation->loan_reason)
                        <div><span class="font-weight-bold mr-3">Loan Reason: </span>
                            <span>{{$loan_confirmation->loan_reason}}</span></div>
                        @endif



                        <div><span class="font-weight-bold mr-3">Applied At : </span>
                            <span>{{carbonDate($loan_confirmation->created_at)}}</span></div>

                        <div><span class="font-weight-bold mr-3">Status : </span>
                            @if ($loan_confirmation->status=='Active')
                            <span class="badge badge-success">{{($loan_confirmation->status)}}</span>
                            @else
                            <span class="badge badge-danger">{{($loan_confirmation->status)}}</span>

                            @endif
                        </div>


                        @if ( $loan_confirmation->installment_no )
                        <div><span class="font-weight-bold mr-3"> No Of Installment: </span>
                            <span>{{$loan_confirmation->installment_no}}</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->installment_amount )
                        <div><span class="font-weight-bold mr-3"> Installment Of Capital: </span>
                            <span>{{$loan_confirmation->installment_amount}} (Taka/Installment)</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->installment_interest )
                        <div><span class="font-weight-bold mr-3"> Installment Of Interest: </span>
                            <span>{{$loan_confirmation->installment_interest}} (Taka/Installment)</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->installment_total )
                        <div><span class="font-weight-bold mr-3"> Total Installment: </span>
                            <span>{{$loan_confirmation->installment_total}} (Taka/Installment)</span>
                        </div>
                        @endif

                        @if ( $loan_confirmation->installment_duration )
                        <div><span class="font-weight-bold mr-3"> Installment Interval: </span>
                            <span>{{$loan_confirmation->installment_duration}}
                                ({{ $loan_confirmation->installment_duration_type }})</span>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="row mt-5">
                    <div class="col-md-12 mt-3 mb-2 text-primary text-center">
                            <h5>Action Information</h5>
                            <hr>
                        </div>

                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        {{-- loan applied by --}}
                        @if (isset($loan_info->user))
                        <div><span class="font-weight-bold mr-3">Applied By: </span>
                            <span>{{$loan_info->user?$loan_info->user->name:''}}</span></div>
                        @endif
                        {{-- loan verified by --}}
                        @if (isset($loan_confirmation->user))
                        <div><span class="font-weight-bold mr-3">Verified By: </span>
                            <span>{{$loan_confirmation->user?$loan_confirmation->user->name:''}}</span></div>
                        @endif
                        {{-- loan approved or rejected by --}}
                        @if ($loan_info->approval == 'Approved')
                        <div><span class="font-weight-bold mr-3">Approved By: </span>
                            <span>{{$loan_info->approved?$loan_info->approved->name:''}}</span></div>
                        @elseif($loan_info->approved == 'Refused')
                        <div><span class="font-weight-bold mr-3">Rejected By: </span>
                            <span>{{$loan_info->approved?$loan_info->approved->name:''}}</span></div>
                        @else

                        @endif
                    </div>

                    {{-- show action date --}}
                    <div class="col-md-4">
                        {{-- loan applied date --}}
                        @if (isset($loan_info->user))
                        <div><span class="font-weight-bold mr-3">Application Date: </span>
                            <span>{{carbonDate($loan_info->created_at)}}</span></div>
                        @endif
                        {{-- loan verified date --}}
                        @if (isset($loan_confirmation->user))
                        <div><span class="font-weight-bold mr-3">Verification Date: </span>
                            <span>{{carbonDate($loan_confirmation->created_at)}}</span></div>
                        @endif
                        {{-- loan approved or rejected date --}}
                        @if ($loan_info->approval == 'Approved')
                        <div><span class="font-weight-bold mr-3">Approval Date: </span>
                            <span>{{carbonDate($loan_info->approval_date)}}</span></div>
                        @elseif($loan_info->approved == 'Refused')
                        <div><span class="font-weight-bold mr-3">Rejection Date: </span>
                            <span>{{carbonDate($loan_info->approval_date)}}</span></div>
                        @else

                        @endif


                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-12 text-center mt-4">
                         {{-- loan approved or rejected comment --}}
                        @if ($loan_info->approval == 'Approved')
                        <div><span class="font-weight-bold mr-3">Approval Comment: </span>
                            <span>{{$loan_info->approval_comment}}</span></div>
                        @elseif($loan_info->approved == 'Refused')
                        <div><span class="font-weight-bold mr-3">Rejection Comment: </span>
                            <span>{{$loan_info->approval_comment}}</span></div>
                        @else

                        @endif
                    </div>
                    {{-- ===================================================== --}}
                       {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
           <div class="col-md-12 mt-4 mb-2 text-primary text-center">
                            <h3 class="text-danger">Transaction Info / Installment Payment Info</h3>
                            <hr>
                        </div>
         {{-- <div class="row" style="margin-bottom:25px"> --}}
             <div class="col-md-4">
                 <h6>Loan Info</h6>
                 <hr class="my-1">
                 <span>Loan: {{ $due_and_payment_status['main_total'] }} ৳</span><br>
                 <span>Interest: {{ $due_and_payment_status['main_interest'] }} ৳</span><br>
                 <span>Sub Total: {{ $due_and_payment_status['main_grand_total'] }} ৳</span><br>
                 <span>Total Install No: {{ $loan_confirmation->installment_no }} </span><br>
             </div>
             <div class="col-md-4">
                 <h6>Loan Pay Info</h6>
                 <hr class="my-1">
                 <span>Loan: {{ $due_and_payment_status['paid_total'] }} ৳</span><br>
                 <span>Interest: {{ $due_and_payment_status['paid_interest'] }} ৳</span><br>
                 <span>Sub Total: {{ $due_and_payment_status['paid_grand_total'] }} ৳</span><br>
                 <span>Paid Install No: {{ $due_and_payment_status['paid_installment_no'] }} </span><br>
             </div>
             <div class="col-md-4">
                 <h6>Due Info</h6>
                 <hr class="my-1">
                 <span>Loan: {{ $due_and_payment_status['due_total'] }} ৳</span><br>
                 <span>Interest: {{ $due_and_payment_status['due_interest'] }} ৳</span><br>
                 <span>Sub Total: {{ $due_and_payment_status['due_grand_total'] }} ৳</span><br>
                 <span>Due Install No: {{ $due_and_payment_status['due_installment_no'] }} </span><br>
             </div>
         {{-- </div> --}}

         <table id="example" class="table table-striped table-bordered mt-3" style="width:100%;">
             <thead>
                 <tr class="bg-success text-light">
                     <th>#</th>
                     <th>Date</th>
                     <th>Installment</th>
                     <th>Loan</th>
                     <th>Interest</th>
                     <th>Total</th>
                 </tr>
             </thead>
             <tbody>
                 @if ($due_and_payment_status['total_installment_times']>0)
                 @php
                 $i = 0 ;
                 @endphp
                 @foreach ($transaction_info as $transaction)
                    @php
                    $i++;
                    @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{carbonDate($transaction->created_at)}}</td>
                        <td>{{$transaction->no_of_paying_installment}}</td>
                        <td>{{$transaction->total_amt}}</td>
                        <td>{{$transaction->total_interest_amt}}</td>
                        <td>{{$transaction->grand_total_amt}}</td>
                    </tr>
                 @endforeach

                 @else
                 <tr>
                     <td colspan="6" align="center" class="text-danger">No Previous Installment Payment Found</td>
                 </tr>
                 @endif

             </tbody>

         </table>
                    {{-- ===================================================== --}}
                </div>
            </div>


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

@endpush
