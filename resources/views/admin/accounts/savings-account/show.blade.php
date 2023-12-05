@extends('layouts.app', ['title' => _lang('Savings Account Information Of'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Savings Account Information Of  {{$member->name_in_bangla}}">{{--<i
                class="fa fa-users mr-4"></i>--}}
            {{_lang('Savings Account Information Of ')}}{{$member->name_in_bangla}}</h1>
        <p>{{_lang('Here you can see Member\'s Savings Account details')}}</p>
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
                        <div class="col-md-12 m-3">
                            <h5 class="text-left">Basic Information</h5>
                        </div>
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
                        <div>
                            <span class="font-weight-bold mr-3">Signature : </span>
                            <span>
                                <a href="{{asset('storage/member/'.$member->signature)}}" target="_blank">
                                    <img src="{{asset('storage/member/'.$member->signature)}}" width="30%"
                                        alt="Signature Not Uploaded." class="rounded img-thumbnail">
                                </a>
                            </span>
                        </div>

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
            {{-- Sponser And  information  --}}
            <hr>
            <h3 class="text-center mt-3">Nomenee, Identifier And Account Information</h3>
            <hr>
        </div>
        {{-- main row --}}
        <div class="row">
            {{-- in the left side I Will show Sponser information and in the righ side i will show  information  --}}
            <div class="col-md-4">
                {{-- this section will be used for Sponser information  --}}
                <div class="col-md-12 m-3">
                    <h5 class="text-left">Nomenee Information</h5>
                </div>
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->nomenee_name}}</span>
                </div>
                @if ( $account_information->nomenee_fathers_name )

                <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                    <span>{{$account_information->nomenee_fathers_name}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_husbands_name )
                <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                    <span>{{$account_information->nomenee_husbands_name}}</span>
                </div>
                @endif



                @if ( $account_information->nomenee_present_address )
                <div><span class="font-weight-bold mr-3">Present Address: </span>
                    <span>{{$account_information->nomenee_present_address}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_permanent_address )
                <div><span class="font-weight-bold mr-3">Permanent Address: </span>
                    <span>{{$account_information->nomenee_permanent_address}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_age )
                <div><span class="font-weight-bold mr-3">Age: </span>
                    <span>{{$account_information->nomenee_age}} (Years)</span>
                </div>
                @endif

                @if ( $account_information->nomenee_relation_with_member )
                <div><span class="font-weight-bold mr-3"> Relation : </span>
                    <span class="badge badge-success"> {{$account_information->nomenee_relation_with_member }}</span>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                {{-- this section will be used for   information  --}}
                <div class="col-md-12 m-3">
                    <h5 class="text-left">Identifier Information</h5>
                </div>
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->identifier_name}}</span>
                </div>
                @if ( $account_information->identifier_fathers_name )

                <div><span class="font-weight-bold mr-3"> Father's Name: </span>
                    <span>{{$account_information->identifier_fathers_name}}</span>
                </div>
                @endif

                @if ( $account_information->identifier_husbands_name )
                <div><span class="font-weight-bold mr-3"> Husband's Name: </span>
                    <span>{{$account_information->identifier_husbands_name}}</span>
                </div>
                @endif

                @if ( $account_information->identifier_permanent_address )
                <div><span class="font-weight-bold mr-3">Permanent Address: </span>
                    <span>{{$account_information->identifier_permanent_address}}</span>
                </div>
                @endif

                @if ( $account_information->nomenee_present_address )
                <div><span class="font-weight-bold mr-3">Present Address: </span>
                    <span>{{$account_information->nomenee_present_address}}</span>
                </div>
                @endif


                @if ( $account_information->identifier_age )
                <div><span class="font-weight-bold mr-3">Age: </span>
                    <span>{{$account_information->identifier_age}} (Years)</span>
                </div>
                @endif


            </div>
            {{-- business Information --}}
            <div class="col-md-4">
                {{-- this section will be used for   information  --}}
                <div class="col-md-12 m-3">
                    <h5 class="text-left">Account Information</h5>
                </div>
                <div><span class="font-weight-bold mr-3"> Account No: </span>
                    <span>{{$account_information->prefix.'-'.numer_padding($account_information->code, get_option('digits_savings_account_code'))}}</span>
                </div>

                <div><span class="font-weight-bold mr-3"> Created At: </span>
                    <span>{{carbonDate($account_information->created_at)}}</span>
                </div>

                @if ($account_information->created_by)
                <div><span class="font-weight-bold mr-3 text-danger">Account Created By: </span>
                    <span>{{$account_information->user->name}}</span></div>
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
        {{-- ======================================================= --}}
        <div class="col-md-12 mt-3">
            {{-- Sponser And  information  --}}
            <hr>
            <h3 class="text-center mt-3 text-danger">Withdraw & Deposit Information</h3>
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
        </ul>
        <div class="tab-content" id="myTabContent">


            {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
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
                        <span>Total Deposit : {{ $payment_status['total_deposit'] }} (Taka)</span><br>
                        <span>Total Withdraw : {{ $payment_status['total_withdraw'] }} (Taka)</span><br>
                        <span>Total Savings: {{ $payment_status['currntly_in_hand'] }} (Taka)</span><br>
                    </div>

                    <div class="col-md-6" align="right">
                        <span>Deposit : {{ $payment_status['deposit_times'] }} (Times)</span><br>
                        <span>Withdraw : {{ $payment_status['withdraw_times'] }} (Times)</span><br>
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
                            <td colspan="5" align="center" class="text-danger">No Deposit Of Savings Found</td>
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
                        <span>Total Savings: {{ $payment_status['currntly_in_hand'] }} (Taka)</span><br>
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
                            <td colspan="5" align="center" class="text-danger">No Withdraw Of Savings Found</td>
                        </tr>
                        @endif

                    </tbody>

                </table>


            </div>
        </div>

        {{-- ======================================================= --}}


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
