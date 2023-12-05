
{{-- {{ dd(url()->full()) }} --}}
@extends('layouts.app', ['title' => _lang('Double Benifit Application Information'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Double Benefit Application Information Of  {{$account_information->member->name_in_bangla}}">{{--<i
                class="fa fa-users mr-4"></i>--}}
            {{_lang('Double Benefit Application Information Of ')}}{{$account_information->member->name_in_bangla}}</h1>
        <p>{{_lang('Here you can see application information')}}</p>
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
                    class="btn btn-secondary text-light btn-sm mr-2" title="{{ _lang('Back To Previous Page') }}" data-popup="tooltip"
                    data-placement="bottom">
                    <i class="fa fa-arrow-left"></i>Back
                </a>

                 @can('double-benifit-pending-application.update')
                    <a data-placement="bottom" title="Edit Double Benifit" href="{{ route('admin.pending-application.edit',$account_information->uuid) }}"
                        id="" class="btn btn-info btn-sm text-light" title="{{ _lang('Edit') }}" data-popup="tooltip"
                        data-placement="bottom"><i class="fa fa-pencil-square-o"></i>Edit</a>
                    @endcan

                    @can('double-benifit-pending-application.delete')
                    <a data-placement="bottom" title="Delete Double Benifit." href="" id="delete_item" data-id="{{$account_information->id}}"
                        data-url="{{route('admin.pending-application.destroy',$account_information->id) }}" class="btn btn-danger btn-sm ml-1"
                        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i>Delete</a>
                    @endcan



            </div>


            <hr>
        </div>
        <div class="row">
            {{-- The following div is for image of member --}}
            <div class="col-md-3 d-flex">
                <a href="{{asset('storage/member/'.$account_information->member->photo)}}" target="_blank">
                    <img src="{{asset('storage/member/'.$account_information->member->photo)}}" width="80%" alt="Image Not Uploaded."
                        class="rounded img-thumbnail">
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
                            <span><a href="{{asset('storage/member/'.$account_information->member->signature)}}" target="_blank">
                                    <img src="{{asset('storage/member/'.$account_information->member->signature)}}" width="30%"
                                        alt="Signature Not Uploaded." class="rounded img-thumbnail">
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
                        <div><span class="font-weight-bold mr-3">National ID No : </span> <span>{{$account_information->member->nid}}</span>
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
                    <span> <a href="{{ route('admin.member-list.edit', $account_information->identity_provider->uuid) }}"> {{$account_information->identity_provider->prefix.'-'.numer_padding($account_information->identity_provider->code, get_option('digits_member_code'))}}</span> </a></div>
                 @endif

                  @if ( $account_information->identity_provider )
                <div><span class="font-weight-bold mr-3"> Name: </span>
                    <span>{{$account_information->identity_provider->name_in_bangla}}</span>
                </div>
                 @endif

                @if ( $account_information->identity_provider )
                <div><span class="font-weight-bold mr-3"> image: </span>
                    <span> <a href="{{asset('storage/member/'.$account_information->identity_provider->photo)}}" target="_blank">
                    <img src="{{asset('storage/member/'.$account_information->identity_provider->photo)}}" width="30%" alt="Image Not Uploaded."
                        class="rounded img-thumbnail">
                </a></span>
                </div>
                 @endif

                @if ( $account_information->identity_provider )
                <div><span class="font-weight-bold mr-3"> Sign: </span>
                    <span> <a href="{{asset('storage/member/'.$account_information->identity_provider->signature)}}" target="_blank">
                    <img src="{{asset('storage/member/'.$account_information->identity_provider->signature)}}" width="30%" alt="Image Not Uploaded."
                        class="rounded img-thumbnail">
                </a></span>
                </div>
                 @endif
            </div>


        </div>
        <div class="col-md-12 mt-3">
            {{-- Nomeene And Identifiers information  --}}
            <hr>
            <h3 class="text-center mt-3">Double Benifit Information</h3>
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

                @if ($account_information->double_benifit_amt)
                <div><span class="font-weight-bold mr-3">Total Saving Amt: </span>
                    <span>{{$account_information->double_benifit_amt}} (Taka)</span></div>
                @endif

                @if ($account_information->interest_rate)
                <div><span class="font-weight-bold mr-3">Interest Rate: </span>
                    <span>{{$account_information->interest_rate}} (%)</span></div>
                @endif

                @if ($account_information->double_benifit_duration)
                <div><span class="font-weight-bold mr-3">Double benifit Duration: </span>
                    <span>{{$account_information->double_benifit_duration}}
                        ({{ $account_information->double_benifit_duration_type }})</span></div>
                @endif

            </div>
            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}

                @if ( $account_information->total_interest_amt )
                <div><span class="font-weight-bold mr-3"> Total Interest: </span>
                    <span>{{$account_information->total_interest_amt}} (Taka)</span>
                </div>
                @endif

                @if ( $account_information->grand_total_double_benifit )
                <div><span class="font-weight-bold mr-3"> Grand Total: </span>
                    <span>{{$account_information->grand_total_double_benifit}} (Taka)</span>
                </div>
                @endif

                @if ( $account_information->approval_date )
                <div><span class="font-weight-bold mr-3"> Approval date: </span>
                    <span>{{carbonDate($account_information->approval_date)}}</span>
                </div>
                @endif

                @if ( $account_information->completion_date )
                <div><span class="font-weight-bold mr-3"> Complete date: </span>
                    <span>{{carbonDate($account_information->completion_date)}}</span>
                </div>
                @endif

                @if ( $account_information->double_benifit_reason )
                <div><span class="font-weight-bold mr-3"> Double Benifit Reason: </span>
                    <span>{{$account_information->double_benifit_reason}}</span>
                </div>
                @endif

            </div>
            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}

                @if (isset($account_information->user))
                <div><span class="font-weight-bold mr-3">Created By: </span>
                    <span>{{$account_information->user?$account_information->user->name:''}}</span></div>
                @endif

                <div>
                    <span class="font-weight-bold mr-3">Created At : </span>
                    <span>{{carbonDate($account_information->created_at)}}</span>
                </div>


                <div><span class="font-weight-bold mr-3">Status : </span>
                    @if ($account_information->status=='Active')
                    <span class="badge badge-success">{{($account_information->status)}}</span>
                    @else
                    <span class="badge badge-danger">{{($account_information->status)}}</span>

                    @endif
                </div>



            </div>
            {{-- ================================================= --}}
              {{-- ::::::::::    Double Benifit Info Tab Content    ::::::::: --}}
               <div class="col-md-12 mt-3">
            {{-- Nomeene And Identifiers information  --}}
            <hr>
            <h3 class="text-center mt-3">Double Benifit Transaction Info</h3>
            <hr>
        </div>
             <div class="col-md-6">
                 <h6>General Summery</h6>
                 <hr class="my-1">
                 <span>Total: {{ $due_and_payment_status['main_amount'] }} ৳</span><br>
                 <span>Interest: {{ $due_and_payment_status['interest_amt'] }} ৳</span><br>
                 <span>Sub Total: {{ $due_and_payment_status['with_interest'] }} ৳</span><br>
                 <span>Duration: {{ $account_information->double_benifit_duration }} {{ $account_information->double_benifit_duration_type }}</span><br>
                 <span>Issue: {{ carbonDate( $account_information->issue_date) }}</span><br>

             </div>

             <div class="col-md-6">
                 <h6>Withdraw Summery</h6>
                 <hr class="my-1">
                 <span>Per Month Withdrawable: {{ $due_and_payment_status['per_month_withdrawable'] }} ৳</span><br>
                 <span>Total Withdraw: {{ $due_and_payment_status['total_withdraw_amt'] }} ৳</span><br>
                 <span>Total Withdraw : {{ $due_and_payment_status['total_withdraw_times'] }} Times</span><br>
                 {{-- <span>Sub Total: {{ $due_and_payment_status['due_grand_total'] }} ৳</span><br> --}}
             </div>

         <table id="example" class="table table-striped table-bordered" style="width:100%;">
             <thead>
                 <tr class="bg-success text-light">
                     <th>#</th>
                     <th>Date</th>
                     <th>Withdraw Amount</th>

                 </tr>
             </thead>
             <tbody>
                 @if ($due_and_payment_status['total_withdraw_times']>0)
                 @php
                 $i = 0 ;
                 @endphp
                 @foreach ($transaction_info as $transaction)
                    @php
                    $i++;
                    @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{carbonDate($transaction->tx_date)}}</td>
                        <td>{{$transaction->grand_total_amt}}</td>

                    </tr>
                 @endforeach

                 @else
                 <tr>
                     <td colspan="3" align="center" class="text-danger">No Withdraw Found</td>
                 </tr>
                 @endif

             </tbody>

         </table>
            {{-- ================================================= --}}
        </div>
    </div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')


@endpush
