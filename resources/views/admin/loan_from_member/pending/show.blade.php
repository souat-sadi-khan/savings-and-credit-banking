
{{-- {{ dd(url()->full()) }} --}}
@extends('layouts.app', ['title' => _lang('Loan From Member Application Information'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Loan From Member Application Information ">{{--<i
                class="fa fa-users mr-4"></i>--}}
            {{_lang('Loan From Member Application Information ')}}</h1>
        <p>{{_lang('Here you can see')}}</p>
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
                    href="{{ url()->previous() != url()->full() ? url()->previous() : route('admin.loan-member-pending-application.index') }}"
                    class="btn btn-secondary text-light btn-sm mr-2"
                    title="{{ _lang('Back To Previous Page') }}" data-popup="tooltip" data-placement="bottom">
                    <i class="fa fa-arrow-left"></i>Back
                </a>

                 @can('loan-from-member-pending-application.update')
                    <a data-placement="bottom" title="Edit Double Benifit" href="{{ route('admin.loan-member-pending-application.edit',$account_information->uuid) }}"
                        id="" class="btn btn-info btn-sm text-light" title="{{ _lang('Edit') }}" data-popup="tooltip"
                        data-placement="bottom"><i class="fa fa-pencil-square-o"></i>Edit</a>
                    @endcan

                    @can('loan-from-member-pending-application.delete')
                    <a data-placement="bottom" title="Delete Double Benifit." href="" id="delete_item" data-id="{{$account_information->id}}"
                        data-url="{{route('admin.loan-member-pending-application.destroy',$account_information->id) }}" class="btn btn-danger btn-sm ml-1"
                        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i>Delete</a>
                    @endcan

                    @can('loan-from-member-pending-application.approval')
                    <a data-placement="bottom" title="Approve Account" href="{{ route('admin.loan-member-pending-application.approval',$account_information->uuid) }}"
                        class="btn btn-success text-light btn-sm ml-1" title="{{ _lang('Approve') }}" data-popup="tooltip"
                        data-placement="bottom">
                        <i class="fa fa-check-circle"></i>Approve
                    </a>
                    @endcan

            </div>


            <hr>
        </div>
        @php
            $i=0;
        @endphp
        @foreach ($account_information->fdrMember as $mem_info)
             @php
                 $member_details = $mem_info->member;
                 $i++;
             @endphp
              <div class="row">
            {{-- The following div is for image of member --}}

            {{-- the following div is for member basic information   --}}
            <div class="col-md-12">
                <div class="col-md-12 text-center">
            <h4 class="text-center text-success">Member 0{{ $i }} </h4>
            <hr>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-left">Permanent Address</h5>
                        </div>
                        <div><span class="font-weight-bold mr-3">Member Id:</span>
                            <span>{{$member_details->prefix.'-'.numer_padding($member_details->code, get_option('digits_member_code'))}}</span>
                        </div>

                        <div><span class="font-weight-bold mr-3"> Name: </span>
                            <span>{{$member_details->name_in_bangla}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Father's Name:</span>
                            <span>{{$member_details->father_name}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Mother's Name:</span>
                            <span>{{$member_details->mother_name}}</span>
                        </div>

                        @if ($member_details->created_at)
                        <div><span class="font-weight-bold mr-3">Member From : </span>
                            <span>{{carbonDate($member_details->created_at)}}</span></div>
                        @endif


                    </div>

                    <div class="col-md-4">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-left">Permanent Address</h5>
                        </div>
                        @if ($member_details->same_as_present_address == 1)
                        <div class="text-danger">Permanent Address Is Same As Present Address</div>
                        @else
                        <div><span class="font-weight-bold mr-3">Line 1: </span>
                            <span>{{$member_details->permanent_address_line_1}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 2: </span>
                            <span>{{$member_details->permanent_address_line_2}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">City: </span>
                            <span>{{$member_details->permanent_city}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">State: </span>
                            <span>{{$member_details->permanent_state}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Zip Code: </span>
                            <span>{{$member_details->permanent_zipcode}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Country: </span>
                            <span>{{$member_details->permanent_country}}</span>
                        </div>
                        @endif

                        @if ($member_details->nid)
                        <div><span class="font-weight-bold mr-3">National ID No : </span> <span>{{$member_details->nid}}</span>
                        </div>
                        @endif

                        @if ($member_details->birth_certificate_number)
                        <div><span class="font-weight-bold mr-3">Birth Certificate No : </span>
                            <span>{{$member_details->birth_certificate_number}}</span></div>
                        @endif



                    </div>
                    <div class="col-md-4">

                        <div class="col-md-12 mb-3">
                            <h5 class="text-left">Present Address</h5>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 1:</span>
                            <span>{{$member_details->present_address_line_1}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Line 2:</span>
                            <span>{{$member_details->present_address_line_2}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">City:</span>
                            <span>{{$member_details->present_city}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">State:</span>
                            <span>{{$member_details->present_state}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Zip Code:</span>
                            <span>{{$member_details->present_zipcode}}</span>
                        </div>
                        <div><span class="font-weight-bold mr-3">Country:</span>
                            <span>{{$member_details->present_country}}</span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        @endforeach

          <div class="col-md-12 mt-3">
            {{-- Nomeene And Identifiers information  --}}
            <hr>
            <h3 class="text-center mt-3">Nomenee Information</h3>
            <hr>
        </div>
        {{-- main row --}}
        <div class="row">

            {{-- in the left side I Will show Nomeene information and in the righ side i will show identifiers information  --}}
            <div class="col-md-2"></div>
            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}

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


            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">


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





        </div>

        <div class="col-md-12 mt-3">
            <hr>
            <h3 class="text-center mt-3">Loan From Memeber Information</h3>
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

                @if ($account_information->loan_amt)
                <div><span class="font-weight-bold mr-3">Total Loan Amt: </span>
                    <span>{{$account_information->loan_amt}} (Taka)</span></div>
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

            </div>
            <div class="col-md-4">
                {{-- this section will be used for nomeene information  --}}

                @if ( $account_information->total_interest_amt )
                <div><span class="font-weight-bold mr-3"> Total Interest: </span>
                    <span>{{$account_information->total_interest_amt}} (Taka)</span>
                </div>
                @endif

                @if ( $account_information->grand_total_amt )
                <div><span class="font-weight-bold mr-3"> Grand Total: </span>
                    <span>{{$account_information->grand_total_amt}}</span>
                </div>
                @endif

                @if ( $account_information->loan_reason )
                <div><span class="font-weight-bold mr-3"> Loan Reason: </span>
                    <span>{{$account_information->loan_reason}} </span>
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
        </div>
    </div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')


@endpush
