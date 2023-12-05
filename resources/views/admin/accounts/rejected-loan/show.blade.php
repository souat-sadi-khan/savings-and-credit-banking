@extends('layouts.app', ['title' => _lang('Rejected Loan Account Information Of'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Loan Account Information Of  {{$member->name_in_bangla}}">{{--<i
                class="fa fa-users mr-4"></i>--}}
            {{_lang('Loan Account Information Of ')}}{{$member->name_in_bangla}}</h1>
        <p>{{_lang('Here you can see Rejected Member Loan information')}}</p>
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
            <h3 class="text-center">Member Information</h3>
            <hr>
        </div>
        <div class="row">
            {{-- The following div is for image of member --}}
            <div class="col-md-3 d-flex">
                <a href="{{asset('storage/member/'.$member->photo)}}" target="_blank">
                    <img src="{{asset('storage/member/'.$member->photo)}}" width="80%" alt="Image Not Uploaded."
                        class="rounded img-thumbnail">
                </a>
            </div>
            {{-- the following div is for member basic information   --}}
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div><span class="font-weight-bold mr-3">Member Id:</span>
                            <span>{{$member->prefix.'-'.numer_padding($member->code, get_option('digits_member_code'))}}</span>
                        </div>

                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$member->name_in_bangla}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Father's Name:</span>
                            <span>{{$member->father_name}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Mother's Name:</span>
                            <span>{{$member->mother_name}}</span>
                        </div>

                        <div><span class="font-weight-bold mr-3">Signature : </span>
                            <span><a href="{{asset('storage/member/'.$member->signature)}}" target="_blank">
                                    <img src="{{asset('storage/member/'.$member->signature)}}" width="30%"
                                        alt="Signature Not Uploaded." class="rounded img-thumbnail">
                                </a></span></div>

                        @if ($member->created_at)
                        <div><span class="font-weight-bold mr-3">Member From : </span>
                            <span>{{carbonDate($member->created_at)}}</span></div>
                        @endif


                    </div>

                    <div class="col-md-4">
                        <div class="col-md-12 m-3">
                            <h5 class="text-left">Permanent Address</h5>
                        </div>
                        @if ($member->same_as_present_address == 1)
                        <div class="text-danger">Permanent Address Is Same As Present Address</div>
                        @else
                        <div><span class="font-weight-bold mr-3">Line 1: </span>
                            <span>{{$member->permanent_address_line_1}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 2: </span>
                            <span>{{$member->permanent_address_line_2}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">City: </span>
                            <span>{{$member->permanent_city}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">State: </span>
                            <span>{{$member->permanent_state}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Zip Code: </span>
                            <span>{{$member->permanent_zipcode}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Country: </span>
                            <span>{{$member->permanent_country}}</span>
                        </div>
                        @endif

                        @if ($member->nid)
                        <div><span class="font-weight-bold mr-3">National ID No : </span> <span>{{$member->nid}}</span>
                        </div>
                        @endif

                        @if ($member->birth_certificate_number)
                        <div><span class="font-weight-bold mr-3">Birth Certificate No : </span>
                            <span>{{$member->birth_certificate_number}}</span></div>
                        @endif



                    </div>
                    <div class="col-md-4">

                        <div class="col-md-12 m-3">
                            <h5 class="text-left">Present Address</h5>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 1:</span>
                            <span>{{$member->present_address_line_1}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 2:</span>
                            <span>{{$member->present_address_line_2}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">City:</span>
                            <span>{{$member->present_city}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">State:</span>
                            <span>{{$member->present_state}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Zip Code:</span>
                            <span>{{$member->present_zipcode}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Country:</span>
                            <span>{{$member->present_country}}</span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            {{-- Nomeene And Identifiers information  --}}
            <hr>
            <h3 class="text-center mt-3">Sponsor And Account Information</h3>
            <hr>
        </div>
        {{-- main row --}}
        <div class="row">

            {{-- in the left side I Will show Nomeene information and in the righ side i will show identifiers information  --}}
            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}
                <div class="col-md-12 m-3">
                    <h5 class="text-left">Sponsor Information (01)</h5>
                </div>
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->sponsonr_name1}}</span>
                </div>
                @if ( $account_information->sponsor_fathers_name1 )

                <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                    <span>{{$account_information->sponsor_fathers_name1}}</span>
                </div>
                @endif

                @if ( $account_information->sponsor_husbands_name1 )

                <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                    <span>{{$account_information->sponsor_husbands_name1}}</span>
                </div>
                @endif
                <div><span class="font-weight-bold mr-3"> Account No: </span>
                    <span>{{$account_information->sponsor_account_no1 }}</span>
                </div>
                <div><span class="font-weight-bold mr-3"> Address: </span>
                    <span>{{$account_information->sponsor_permanent_address1 }}</span>
                </div>
                <div><span class="font-weight-bold mr-3"> Relation : </span>
                    <span class="badge badge-success"> {{$account_information->sponsor_relation_with_member1 }}</span>
                </div>
            </div>
            <div class="col-md-4">
                {{-- this section will be used for Identifiers  information  --}}
                <div class="col-md-12 m-3">
                    <h5 class="text-left">Sponsor Information (02)</h5>
                </div>
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->sponsonr_name2}}</span>
                </div>
                @if ( $account_information->sponsor_fathers_name2 )

                <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                    <span>{{$account_information->sponsor_fathers_name2}}</span>
                </div>
                @endif
                @if ( $account_information->sponsor_husbands_name2 )

                <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                    <span>{{$account_information->sponsor_husbands_name2}}</span>
                </div>
                @endif
                <div><span class="font-weight-bold mr-3"> Account No: </span>
                    <span>{{$account_information->sponsor_account_no2 }}</span>
                </div>
                <div><span class="font-weight-bold mr-3"> Address: </span>
                    <span>{{$account_information->sponsor_permanent_address2 }}</span>
                </div>
                <div><span class="font-weight-bold mr-3"> Relation : </span>
                    <span class="badge badge-success"> {{$account_information->sponsor_relation_with_member2 }}</span>
                </div>

            </div>

            {{-- business information  --}}
            <div class="col-md-4">
                <div class="col-md-12 m-3">
                    <h5 class="text-left">Business Information</h5>
                </div>
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->business_name}}</span>
                </div>
                @if ( $account_information->business_duration )

                <div><span class="font-weight-bold mr-3"> Duration: </span>
                    <span>{{$account_information->business_duration}}
                        {{$account_information->duration_indication}}</span>
                </div>
                @endif
                @if ( $account_information->business_address )
                <div><span class="font-weight-bold mr-3"> Address: </span>
                    <span>{{$account_information->business_address}}</span>
                </div>
                @endif

                @if ( $account_information->Investment )
                <div><span class="font-weight-bold mr-3"> Investment: </span>
                    <span>{{$account_information->Investment}} (Taka)</span>
                </div>
                @endif

                @if ( $account_information->business_stock )
                <div><span class="font-weight-bold mr-3"> Stock: </span>
                    <span>{{$account_information->business_stock}} (Taka)</span>
                </div>
                @endif

                @if ( $account_information->business_average_sell )
                <div><span class="font-weight-bold mr-3"> Average Sell: </span>
                    <span>{{$account_information->business_average_sell}} (Taka/Day)</span>
                </div>
                @endif

                @if ( $account_information->business_average_income )
                <div><span class="font-weight-bold mr-3"> Average Income: </span>
                    <span>{{$account_information->business_average_income}} (Taka/Day)</span>
                </div>
                @endif

                @if ( $account_information->business_shop_owner )
                <div><span class="font-weight-bold mr-3"> Shop Owner: </span>
                    <span>{{$account_information->business_shop_owner}} </span>
                </div>
                @endif

            </div>
        </div>
        <div class="col-md-12 mt-3">
            {{-- Nomeene And Identifiers information  --}}
            <hr>
            <h3 class="text-center mt-3">Loan Information</h3>
            <hr>
        </div>
        {{-- main row --}}
        <div class="row">
            {{-- in the left side I Will show Nomeene information and in the righ side i will show identifiers information  --}}
            <div class="col-md-2">  </div>

            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}

                <div><span class="font-weight-bold mr-3">A/C No:</span>
                    <span>{{$account_information->prefix.'-'.numer_padding($account_information->code, get_option('digits_loan_account_code'))}}</span>
                </div>

                @if ($account_information->loan_amount)
                <div><span class="font-weight-bold mr-3">Loan Amount: </span>
                    <span>{{$account_information->loan_amount}} (Taka)</span></div>
                @endif

                @if ($account_information->interest_rate)
                <div><span class="font-weight-bold mr-3">Interest Rate: </span>
                    <span>{{$account_information->interest_rate}} (%)</span></div>
                @endif

                @if ($account_information->loan_duration)
                <div><span class="font-weight-bold mr-3">Loan Duration: </span>
                    <span>{{$account_information->loan_duration}}
                        ({{ $account_information->loan_duration_type }})</span></div>
                @endif

                @if ($account_information->loan_reason)
                <div><span class="font-weight-bold mr-3">Loan Reason: </span>
                    <span>{{$account_information->loan_reason}}</span></div>
                @endif



                <div><span class="font-weight-bold mr-3">Applied At : </span>
                    <span>{{carbonDate($account_information->created_at)}}</span></div>

                <div><span class="font-weight-bold mr-3">Status : </span>
                    @if ($account_information->status=='Active')
                    <span class="badge badge-success">{{($account_information->status)}}</span>
                    @else
                    <span class="badge badge-danger">{{($account_information->status)}}</span>

                    @endif
                </div>



            </div>
            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}


                @if ( $account_information->installment_no )
                <div><span class="font-weight-bold mr-3"> No Of Installment: </span>
                    <span>{{$account_information->installment_no}}</span>
                </div>
                @endif

                @if ( $account_information->installment_amount )
                <div><span class="font-weight-bold mr-3"> Installment Of Capital: </span>
                    <span>{{$account_information->installment_amount}} (Taka/Installment)</span>
                </div>
                @endif

                @if ( $account_information->installment_interest )
                <div><span class="font-weight-bold mr-3"> Installment Of Interest: </span>
                    <span>{{$account_information->installment_interest}} (Taka/Installment)</span>
                </div>
                @endif

                @if ( $account_information->installment_total )
                <div><span class="font-weight-bold mr-3"> Total Installment: </span>
                    <span>{{$account_information->installment_total}} (Taka/Installment)</span>
                </div>
                @endif

                @if ( $account_information->installment_duration )
                <div><span class="font-weight-bold mr-3"> Installment Interval: </span>
                    <span>{{$account_information->installment_duration}}
                        ({{ $account_information->installment_duration_type }})</span>
                </div>
                @endif

            </div>
            <div class="col-md-2">  </div>
        </div>
        <div class="row mt-5">
             <div class="col-md-12 mt-3">
            {{-- Nomeene And Identifiers information  --}}
            <hr>
            <h3 class="text-center mt-3">Action Information</h3>
            <hr>
        </div>

            <div class="col-md-2"></div>
            <div class="col-md-4">
                @if (isset($account_information->user))
                <div><span class="font-weight-bold mr-3">Applied By: </span>
                    <span>{{$account_information->user?$account_information->user->name:''}}</span></div>
                @endif

                @if (isset($account_information->verified))
                <div><span class="font-weight-bold mr-3">Verified By: </span>
                    <span>{{$account_information->verified?$account_information->verified->name:''}}</span></div>
                @endif

                @if (isset($account_information->approved))
                <div><span class="font-weight-bold mr-3">Rejeccted By: </span>
                    <span>{{$account_information->approved?$account_information->approved->name:''}}</span></div>
                @endif
            </div>

            {{-- show action date --}}
            <div class="col-md-4">
                @if (isset($account_information->user))
                <div><span class="font-weight-bold mr-3">Application Date: </span>
                    <span>{{carbonDate($account_information->created_at)}}</span></div>
                @endif



                @if (isset($account_information->approved))
                <div><span class="font-weight-bold mr-3">Rejection Date: </span>
                    <span>{{carbonDate($account_information->approval_date)}}</span></div>
                @endif

            </div>
            <div class="col-md-2"></div>

            <div class="col-md-12 text-center mt-4">


                @if (isset($account_information->approved))
                <div><span class="font-weight-bold mr-3">Rejection Comment: </span>
                    <span>{{$account_information->approval_comment}}</span></div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script>

</script>

@endpush
