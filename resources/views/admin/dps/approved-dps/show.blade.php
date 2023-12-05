@extends('layouts.app', ['title' => _lang('DPS Application Information'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom"
            title="DPS Application Information Of  {{$account_information->member->name_in_bangla}}">{{--<i
                class="fa fa-users mr-4"></i>--}}
            {{_lang('DPS Application Information Of ')}}{{$account_information->member->name_in_bangla}}</h1>
        <p>{{_lang('Here you can see DPS application information')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render('/employee-details') }} --}}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <div class="col-md-12 text-center">
            <hr>
            <h3 class="text-center">Member Information</h3>

            <div class="btn-group mt-1" role="group">

                <a data-placement="bottom" title="Go Back To Previous Page"
                    href="{{ url()->previous() != url()->full() ? url()->previous() : route('admin.dps-pending-application.index') }}"
                    class="btn btn-secondary text-light btn-sm mr-2" title="{{ _lang('Back To Previous Page') }}"
                    data-popup="tooltip" data-placement="bottom">
                    <i class="fa fa-arrow-left"></i>Back
                </a>

                @can('dps-pending-application.update')
                <a data-placement="bottom" title="Edit DPS Application"
                    href="{{ route('admin.dps-pending-application.edit',$account_information->uuid) }}" id=""
                    class="btn btn-info btn-sm text-light" title="{{ _lang('Edit') }}" data-popup="tooltip"
                    data-placement="bottom"><i class="fa fa-pencil-square-o"></i>Edit</a>
                @endcan

                @can('dps-pending-application.delete')
                <a data-placement="bottom" title="Delete DPS Application." href="" id="delete_item"
                    data-id="{{$account_information->id}}"
                    data-url="{{route('admin.dps-pending-application.destroy',$account_information->id) }}"
                    class="btn btn-danger btn-sm ml-1" title="{{ _lang('Delete') }}" data-popup="tooltip"
                    data-placement="bottom"><i class="fa fa-trash"></i>Delete</a>
                @endcan


            </div>


            <hr>
        </div>
        <div class="row">
            {{-- The following div is for image of member --}}
            <div class="col-md-3 d-flex">
                <a href="{{asset('storage/member/'.$account_information->member->photo)}}" target="_blank">
                    <img src="{{asset('storage/member/'.$account_information->member->photo)}}" width="80%"
                        alt="Image Not Uploaded." class="rounded img-thumbnail">
                </a>
            </div>
            {{-- the following div is for member basic information   --}}
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div><span class="font-weight-bold mr-3">Member Id:</span>
                            <span>{{$account_information->member->prefix.'-'.numer_padding($account_information->member->code, get_option('digits_member_code'))}}</span>
                        </div>

                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$account_information->member->name_in_bangla}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Father's Name:</span>
                            <span>{{$account_information->member->father_name}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Mother's Name:</span>
                            <span>{{$account_information->member->mother_name}}</span>
                        </div>

                        <div><span class="font-weight-bold mr-3">Signature : </span>
                            <span><a href="{{asset('storage/member/'.$account_information->member->signature)}}"
                                    target="_blank">
                                    <img src="{{asset('storage/member/'.$account_information->member->signature)}}"
                                        width="30%" alt="Signature Not Uploaded." class="rounded img-thumbnail">
                                </a></span></div>

                        @if ($account_information->member->created_at)
                        <div><span class="font-weight-bold mr-3">Member From : </span>
                            <span>{{carbonDate($account_information->member->created_at)}}</span></div>
                        @endif


                    </div>

                    <div class="col-md-4">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-left">Permanent Address</h5>
                        </div>
                        @if ($account_information->member->same_as_present_address == 1)
                        <div class="text-danger">Permanent Address Is Same As Present Address</div>
                        @else
                        <div><span class="font-weight-bold mr-3">Line 1: </span>
                            <span>{{$account_information->member->permanent_address_line_1}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 2: </span>
                            <span>{{$account_information->member->permanent_address_line_2}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">City: </span>
                            <span>{{$account_information->member->permanent_city}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">State: </span>
                            <span>{{$account_information->member->permanent_state}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Zip Code: </span>
                            <span>{{$account_information->member->permanent_zipcode}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Country: </span>
                            <span>{{$account_information->member->permanent_country}}</span>
                        </div>
                        @endif

                        @if ($account_information->member->nid)
                        <div><span class="font-weight-bold mr-3">National ID No : </span>
                            <span>{{$account_information->member->nid}}</span>
                        </div>
                        @endif

                        @if ($account_information->member->birth_certificate_number)
                        <div><span class="font-weight-bold mr-3">Birth Certificate No : </span>
                            <span>{{$account_information->member->birth_certificate_number}}</span></div>
                        @endif



                    </div>
                    <div class="col-md-4">

                        <div class="col-md-12 mb-3">
                            <h5 class="text-left">Present Address</h5>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 1:</span>
                            <span>{{$account_information->member->present_address_line_1}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 2:</span>
                            <span>{{$account_information->member->present_address_line_2}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">City:</span>
                            <span>{{$account_information->member->present_city}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">State:</span>
                            <span>{{$account_information->member->present_state}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Zip Code:</span>
                            <span>{{$account_information->member->present_zipcode}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Country:</span>
                            <span>{{$account_information->member->present_country}}</span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            {{-- Nomeene And Identifiers information  --}}
            <hr>
            <h3 class="text-center mt-3">Nomenee Information</h3>
            <hr>
        </div>
        {{-- main row --}}
        <div class="row">

            {{-- in the left side I Will show Nomeene information and in the righ side i will show identifiers information  --}}
            <div class="col-md-3">
                {{-- this section will be used for nomeene information  --}}
                <div class="col-md-12 mb-3">
                    <h5 class="text-left">Nomenee Info (01)</h5>
                </div>
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->nomenee_name1}}</span>
                </div>
                @if ( $account_information->nomenee_fathers_name1 )

                <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                    <span>{{$account_information->nomenee_fathers_name1}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_husbands_name1 )
                <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                    <span>{{$account_information->nomenee_husbands_name1}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_age1 )
                <div><span class="font-weight-bold mr-3"> Age: </span>
                    <span>{{$account_information->nomenee_age1}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_permanent_address1 )
                <div><span class="font-weight-bold mr-3"> Address: </span>
                    <span>{{$account_information->nomenee_permanent_address1}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_relation_with_member1 )
                <div><span class="font-weight-bold mr-3"> Relation: </span>
                    <span class="badge badge-success">{{$account_information->nomenee_relation_with_member1}}</span>
                </div>
                @endif


                @if ( $account_information->nomenee_part_asset1 )
                <div><span class="font-weight-bold mr-3"> Part Of Asset: </span>
                    <span>{{$account_information->nomenee_part_asset1}} (%)</span>
                </div>
                @endif

            </div>

            <div class="col-md-3">
                {{-- this section will be used for nomeene information  --}}
                <div class="col-md-12 mb-3">
                    <h5 class="text-left">Nomenee Info (02)</h5>
                </div>

                @if ( $account_information->nomenee_name2 )
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->nomenee_name2}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_fathers_name2 )
                <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                    <span>{{$account_information->nomenee_fathers_name2}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_husbands_name2 )
                <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                    <span>{{$account_information->nomenee_husbands_name2}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_age2 )
                <div><span class="font-weight-bold mr-3"> Age: </span>
                    <span>{{$account_information->nomenee_age2}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_permanent_address2 )
                <div><span class="font-weight-bold mr-3"> Address: </span>
                    <span>{{$account_information->nomenee_permanent_address2}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_relation_with_member2 )
                <div><span class="font-weight-bold mr-3"> Relation: </span>
                    <span class="badge badge-success">{{$account_information->nomenee_relation_with_member2}}</span>
                </div>
                @endif


                @if ( $account_information->nomenee_part_asset2 )
                <div><span class="font-weight-bold mr-3"> Part Of Asset: </span>
                    <span>{{$account_information->nomenee_part_asset2}} (%)</span>
                </div>
                @endif

            </div>

            <div class="col-md-3">
                {{-- this section will be used for nomeene information  --}}
                <div class="col-md-12 mb-3">
                    <h5 class="text-left">Nomenee Info (03)</h5>
                </div>
                @if ( $account_information->nomenee_name3 )
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->nomenee_name3}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_fathers_name3 )
                <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                    <span>{{$account_information->nomenee_fathers_name3}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_husbands_name3 )
                <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                    <span>{{$account_information->nomenee_husbands_name3}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_age3 )
                <div><span class="font-weight-bold mr-3"> Age: </span>
                    <span>{{$account_information->nomenee_age3}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_permanent_address3 )
                <div><span class="font-weight-bold mr-3"> Address: </span>
                    <span>{{$account_information->nomenee_permanent_address3}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_relation_with_member3 )
                <div><span class="font-weight-bold mr-3"> Relation: </span>
                    <span class="badge badge-success">{{$account_information->nomenee_relation_with_member3}}</span>
                </div>
                @endif


                @if ( $account_information->nomenee_part_asset3 )
                <div><span class="font-weight-bold mr-3"> Part Of Asset: </span>
                    <span>{{$account_information->nomenee_part_asset3}} (%)</span>
                </div>
                @endif

            </div>

            <div class="col-md-3">
                {{-- this section will be used for nomeene information  --}}
                <div class="col-md-12 mb-3">
                    <h5 class="text-left">Identity Provider</h5>
                </div>

                @if ( $account_information->identity_provider )
                <div><span class="font-weight-bold mr-3"> ID: </span>
                    <span> <a
                            href="{{ route('admin.member-list.edit', $account_information->identity_provider->uuid) }}">
                            {{$account_information->identity_provider->prefix.'-'.numer_padding($account_information->identity_provider->code, get_option('digits_member_code'))}}</span>
                    </a></div>
                @endif

                @if ( $account_information->identity_provider )
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->identity_provider->name_in_bangla}}</span>
                </div>
                @endif

                @if ( $account_information->identity_provider )
                <div><span class="font-weight-bold mr-3"> image: </span>
                    <span> <a href="{{asset('storage/member/'.$account_information->identity_provider->photo)}}"
                            target="_blank">
                            <img src="{{asset('storage/member/'.$account_information->identity_provider->photo)}}"
                                width="30%" alt="Image Not Uploaded." class="rounded img-thumbnail">
                        </a></span>
                </div>
                @endif

                @if ( $account_information->identity_provider )
                <div><span class="font-weight-bold mr-3"> Sign: </span>
                    <span> <a href="{{asset('storage/member/'.$account_information->identity_provider->signature)}}"
                            target="_blank">
                            <img src="{{asset('storage/member/'.$account_information->identity_provider->signature)}}"
                                width="30%" alt="Image Not Uploaded." class="rounded img-thumbnail">
                        </a></span>
                </div>
                @endif
            </div>


        </div>
        <div class="col-md-12 mt-3">
            {{-- Nomeene And Identifiers information  --}}
            <hr>
            <h3 class="text-center mt-3">DPS Information</h3>
            <hr>
        </div>
        {{-- main row --}}
        <div class="row">
            {{-- in the left side I Will show Nomeene information and in the righ side i will show identifiers information  --}}
            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}

                <div><span class="font-weight-bold mr-3">ID No:</span>
                    <span>{{$account_information->prefix.'-'.numer_padding($account_information->code, get_option('digits_dps_code'))}}</span>
                </div>

                @if ($account_information->per_month_dps_amt)
                <div><span class="font-weight-bold mr-3">Per Month DPS Amount: </span>
                    <span>{{$account_information->per_month_dps_amt}} (Taka)</span></div>
                @endif

                @if ($account_information->interest_rate)
                <div><span class="font-weight-bold mr-3">Interest Rate: </span>
                    <span>{{$account_information->interest_rate}} (%)</span></div>
                @endif

                @if ($account_information->dps_duration)
                <div><span class="font-weight-bold mr-3">DPS Duration: </span>
                    <span>{{$account_information->dps_duration}}
                        ({{ $account_information->dps_duration_type }})</span></div>
                @endif








            </div>
            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}


                @if ($account_information->total_dps_amt)
                <div><span class="font-weight-bold mr-3">Total DPS: </span>
                    <span>{{$account_information->total_dps_amt}}</span></div>
                @endif

                @if ( $account_information->total_interest_amt )
                <div><span class="font-weight-bold mr-3"> Total Interest: </span>
                    <span>{{$account_information->total_interest_amt}}</span>
                </div>
                @endif

                @if ( $account_information->grand_total_dps )
                <div><span class="font-weight-bold mr-3"> Grand Total: </span>
                    <span>{{$account_information->grand_total_dps}}</span>
                </div>
                @endif



            </div>
            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}


                @if ( $account_information->dps_reason )
                <div><span class="font-weight-bold mr-3"> DPS Reason: </span>
                    <span>{{$account_information->dps_reason}} (Taka/Installment)</span>
                </div>
                @endif

                <div><span class="font-weight-bold mr-3">Status : </span>
                    @if ($account_information->status=='Active')
                    <span class="badge badge-success">{{($account_information->status)}}</span>
                    @else
                    <span class="badge badge-danger">{{($account_information->status)}}</span>

                    @endif
                </div>

            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12 mt-3 mb-2 text-primary text-center">
                <h5>Action Information</h5>
                <hr>
            </div>

            <div class="col-md-2"></div>
            <div class="col-md-4">
                {{-- loan applied by --}}
                @if (isset($account_information->user))
                <div><span class="font-weight-bold mr-3">Applied By: </span>
                    <span>{{$account_information->user?$account_information->user->name:''}}</span></div>
                @endif

                {{-- loan approved or rejected by --}}
                @if ($account_information->approval == 'Approved')
                <div><span class="font-weight-bold mr-3">Approved By: </span>
                    <span>{{$account_information->approved?$account_information->approved->name:''}}</span></div>
                @elseif($account_information->approved == 'Refused')
                <div><span class="font-weight-bold mr-3">Rejected By: </span>
                    <span>{{$account_information->approved?$account_information->approved->name:''}}</span></div>
                @else

                @endif
            </div>

            {{-- show action date --}}
            <div class="col-md-4">
                {{-- loan applied date --}}
                @if (isset($account_information->user))
                <div><span class="font-weight-bold mr-3">Application Date: </span>
                    <span>{{carbonDate($account_information->created_at)}}</span></div>
                @endif

                {{-- loan approved or rejected date --}}
                @if ($account_information->approval == 'Approved')
                <div><span class="font-weight-bold mr-3">Approval Date: </span>
                    <span>{{carbonDate($account_information->approval_date)}}</span></div>
                @elseif($account_information->approved == 'Refused')
                <div><span class="font-weight-bold mr-3">Rejection Date: </span>
                    <span>{{carbonDate($account_information->approval_date)}}</span></div>
                @else

                @endif


            </div>
            <div class="col-md-2"></div>
            <div class="col-md-12 text-center mt-4">
                {{-- loan approved or rejected comment --}}
                @if ($account_information->approval == 'Approved')
                <div><span class="font-weight-bold mr-3">Approval Comment: </span>
                    <span>{{$account_information->approval_comment}}</span></div>
                @elseif($account_information->approved == 'Refused')
                <div><span class="font-weight-bold mr-3">Rejection Comment: </span>
                    <span>{{$account_information->approval_comment}}</span></div>
                @else

                @endif
            </div>


        </div>

               {{-- ============================================= --}}
<div class="col-md-12 mt-5 mb-2 text-primary text-center">
                <h3 class="text-danger">Deposit & Withdraw Info</h3>
                <hr>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="deposit-info-tab" data-toggle="tab" href="#deposit-info" role="tab"
                        aria-controls="deposit-info" aria-selected="true">Deposit Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="withdraw-tab" data-toggle="tab" href="#withdraw" role="tab"
                        aria-controls="withdraw" aria-selected="false">withdraw Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="dps-tab" data-toggle="tab" href="#dps" role="tab" aria-controls="dps"
                        aria-selected="false">DPS Info</a>
                </li>


            </ul>
            <div class="tab-content" id="myTabContent">


                {{-- ::::::::::    Deposit Info Tab Content    ::::::::: --}}
                <div class="tab-pane fade show active" id="deposit-info" role="tabpanel"
                    aria-labelledby="deposit-info-tab">
                    <table class="table table-striped table-bordered  mt-3" style="width:100%;">
                        <thead>
                            <tr class="text-center" class="bg-success text-light" style="">
                                <th colspan="2" class="text-light" style="background:#099286;padding:7px">
                                    Deposit Information
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="row" style="margin-bottom:25px">
                        <div class="col-md-12 text-center">
                            <h6>Summery</h6>
                            <hr class="my-1">
                        </div>

                        <div class="col-md-6">
                            <span>Total Deposit Amt: {{ $payment_status['total_deposit'] }} (Taka)</span><br>
                            <span>Total Withdraw : {{ $payment_status['total_withdraw'] }} (Taka)</span><br>
                            {{-- <span>Total Savings: {{ $account_information->grand_total_dps - $payment_status['total_deposit'] }}
                            (Taka)</span><br> --}}
                        </div>

                        <div class="col-md-6" align="right">
                            @php
                            $duration = $account_information->dps_duration;
                            $duration_type = $account_information->dps_duration_type;
                            if ($duration_type == 'Year') {
                            $total_dps = $duration * 12 ;
                            }else {
                            $total_dps = $duration;
                            }
                            $paid_dps = $payment_status['deposit_times'];
                            $due_dps = $total_dps - $paid_dps ;

                            @endphp
                            <span>Total DPS No: {{ $total_dps }}</span><br>
                            <span>Paid DPS : {{ $paid_dps }}</span><br>
                            <span>Due DPS : {{ $due_dps }}</span><br>
                        </div>

                    </div>
                    <div class="col-md-12 text-center">
                        <h6>Deposit In Detail</h6>
                        <hr class="my-1">
                    </div>
                    <table id="deposit_data_table" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr class="bg-success text-light">
                                <th>Sl No</th>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Deposit Amt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($payment_status['deposit_times']>0)
                            @php
                            $i = 0 ;
                            @endphp
                            @foreach ($deposit_info as $deposit)
                            @php
                            $i++;
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$deposit->invoice_no}}</td>
                                <td>{{carbonDate($deposit->tx_date)}}</td>
                                <td>{{$deposit->grand_total_amt}}</td>
                            </tr>
                            @endforeach

                            @else
                            <tr>
                                <td colspan="5" align="center" class="text-danger">No Deposit Of DPS Found</td>
                            </tr>
                            @endif

                        </tbody>

                    </table>


                </div>


                {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
                <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
                    <table class="table table-striped table-bordered  mt-3" style="width:100%;">
                        <thead>
                            <tr class="text-center" class="bg-success text-light" style="">
                                <th colspan="2" class="text-light" style="background:#099286;padding:7px">
                                    Withdraw Information
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="row" style="margin-bottom:25px">
                        <div class="col-md-12 text-center">
                            <h6>Summery</h6>
                            <hr class="my-1">
                        </div>
                        <div class="col-md-6">
                            <span>Total Deposit : {{ $payment_status['total_deposit'] }} (Taka)</span><br>
                            <span>Total Withdraw : {{ $payment_status['total_withdraw'] }} (Taka)</span><br>
                            {{-- <span>Total Savings: {{ $payment_status['currntly_in_hand'] }} (Taka)</span><br> --}}
                        </div>

                        <div class="col-md-6" align="right">
                            <span>Deposit : {{ $payment_status['deposit_times'] }} (Times)</span><br>
                            <span>Withdraw : {{ $payment_status['withdraw_times'] }} (Times)</span><br>
                        </div>

                    </div>
                    <div class="col-md-12 text-center">
                        <h6>Withdraw In Detail</h6>
                        <hr class="my-1">
                    </div>
                    <table id="withdraw_data_table" class="table table-striped table-bordered" style="width:100%;">

                        <thead>
                            <tr class="bg-success text-light">
                                <th>Sl No</th>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Withdraw Amt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($payment_status['withdraw_times']>0)
                            @php
                            $i = 0 ;
                            @endphp
                            @foreach ($withdraw_info as $withdraw)
                            @php
                            $i++;
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$withdraw->invoice_no}}</td>

                                <td>{{carbonDate($withdraw->tx_date)}}</td>
                                <td>{{$withdraw->grand_total_amt}}</td>
                            </tr>
                            @endforeach

                            @else
                            <tr>
                                <td colspan="5" align="center" class="text-danger">No Withdraw Of DPS Found</td>
                            </tr>
                            @endif

                        </tbody>

                    </table>


                </div>
                {{-- :::::::::::: DPS Infromation :::::::::::::: --}}
                <div class="tab-pane fade  " id="dps" role="tabpanel" aria-labelledby="dps-tab">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr class="text-center" class="bg-success text-light" style="">
                                <th colspan="4" class="text-light" style="background:#099286;padding:15px">
                                    Dps Information In Detail
                                </th>
                            </tr>
                            <tr class="text-center" class="bg-success text-light" style="">
                                <th colspan="4" class="text-light"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>DPS Per Month Amt</td>
                                <td>{{$account_information->per_month_dps_amt}} Taka</td>
                                <td>Interest Rate</td>
                                <td>{{$account_information->interest_rate}} %</td>
                            </tr>

                            <tr>
                                <td>Interest Amt</td>
                                <td>{{$account_information->total_interest_amt}} Taka</td>
                                <td> Duration</td>
                                <td>{{$account_information->dps_duration}} {{$account_information->dps_duration_type}}
                                </td>
                            </tr>

                            <tr>
                                <td>Total DPS</td>
                                <td>{{$account_information->total_dps_amt}} Taka</td>
                                <td>Total DPS No</td>
                                <td>{{$total_dps}}
                                </td>

                            </tr>

                            <tr>
                                <td>Grand Total</td>
                                <td>{{$account_information->grand_total_dps}} Taka</td>
                                <td>Paid DPS No</td>
                                <td>{{$paid_dps}}</td>


                            </tr>

                            <tr>
                                <td>Paid DPS</td>
                                <td>{{$payment_status['total_deposit']}} Taka</td>
                                <td>Due DPS No</td>
                                <td>{{$due_dps}}</td>

                            </tr>

                            <tr>
                                <td>Due DPS</td>
                                <td>{{$account_information->grand_total_dps - $payment_status['total_deposit']}} Taka
                                </td>




                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ============================================= --}}

    </div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script>

</script>

@endpush
