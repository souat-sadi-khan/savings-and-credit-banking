@extends('layouts.app', ['title' => _lang('Approve Loan From Member Application'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Approve Loan From Member Application">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Approve Loan From Member Application ')}}</h1>
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
                    class="btn btn-secondary text-light btn-sm mr-2" title="{{ _lang('Back To Previous Page') }}"
                    data-popup="tooltip" data-placement="bottom">
                    <i class="fa fa-arrow-left"></i>Back
                </a>

                @can('loan-from-member-pending-application.update')
                <a data-placement="bottom" title="Edit Double Benifit"
                    href="{{ route('admin.loan-member-pending-application.edit',$account_information->uuid) }}" id=""
                    class="btn btn-info btn-sm text-light" title="{{ _lang('Edit') }}" data-popup="tooltip"
                    data-placement="bottom"><i class="fa fa-pencil-square-o"></i>Edit</a>
                @endcan

                @can('loan-from-member-pending-application.delete')
                <a data-placement="bottom" title="Delete Double Benifit." href="" id="delete_item"
                    data-id="{{$account_information->id}}"
                    data-url="{{route('admin.loan-member-pending-application.destroy',$account_information->id) }}"
                    class="btn btn-danger btn-sm ml-1" title="{{ _lang('Delete') }}" data-popup="tooltip"
                    data-placement="bottom"><i class="fa fa-trash"></i>Delete</a>
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
                        <div><span class="font-weight-bold mr-3">National ID No : </span>
                            <span>{{$member_details->nid}}</span>
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
        <div class="col-md-12 mt-3">
            {{-- Nomeene And Identifiers information  --}}
            <hr>
            <h3 class="text-center mt-3">Loan From Member Applicaton Approval</h3>
            <hr>
        </div>

        <div class="col-md-12">
            <form action="{{route('admin.loan-member-pending-application.add_approval',$account_information->uuid)}}"
                method="post" id="approve_form">
                @csrf
                @method('PATCH')

                <div class="row">

                    <div class="col-md-3 form-group" style="display:none">
                        <label for="loan_duration">{{_lang('Loan Duration')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" id="loan_duration" required name="loan_duration"
                                placeholder="Enter Loan Duration" class="form-control"
                                value="{{$account_information->loan_duration}}">
                        </div>
                    </div>

                    <div class="col-md-3 form-group" style="display:none">
                        <label for="loan_duration_type">{{_lang('Loan Duration Type')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" id="loan_duration_type" required name="loan_duration_type"
                                placeholder="Enter Loan Duration Type" class="form-control"
                                value="{{$account_information->loan_duration_type}}">
                        </div>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="receipt_no">{{_lang('Receipt No')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" required name="receipt_no" placeholder="Enter Receipt No"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="receiver_name">{{_lang('Receiver Name')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" readonly required name="receiver_name" placeholder="Enter Receiver Name"
                                class="form-control" value="{{$account_information->nomenee_name1}}">
                        </div>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="issue_date">{{_lang('Issue Date')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text"
                                data-url="{{route('admin.loan-member-pending-application.get_completation_date')}}"
                                id="issue_date" required readonly name="issue_date" placeholder="Enter Issue Date"
                                class="form-control date">
                        </div>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="completion_date">{{_lang('Completation Date')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" required readonly id="completion_date" name="completion_date"
                                placeholder="Enter Completation Date" class="form-control date">
                        </div>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="amount_with_interest">{{_lang('Amount With Interest (Taka)')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" required readonly id="amount_with_interest" name="amount_with_interest"
                        placeholder="Enter Amount With Interest" class="form-control" value="{{$account_information->grand_total_amt}}">
                        </div>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="interest_rate">{{_lang('Interest Rate (%)')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" required readonly id="interest_rate" name="interest_rate"
                        placeholder="Enter Amount With Interest" class="form-control" value="{{$account_information->interest_rate}}">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="approval_comment">{{_lang('Comment')}}
                        </label>
                        <div class="input-group">
                            <input type="text" name="approval_comment" id="approval_comment" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6 row mt-3">
                        <div class="col-md-4 text-center">
                            <h5>Approval</h5>
                        </div>
                        <div class="col-md-8">
                            <div class="animated-radio-button">
                                <label>
                                    <input type="radio" name="approval" class="sohag" checked value="Approved"><span
                                        class="label-text text-danger">Approve</span>
                                </label>
                            </div>
                            <div class="animated-radio-button">
                                <label>
                                    <input type="radio" name="approval" class="sohag" value="Refused"><span
                                        class="label-text text-danger">Reject</span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row m-2">

                </div>

                <div class="form-group col-md-12" align="left">
                    {{-- <input type="hidden" name="type[]" value=" "> --}}
                    <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
                            class="icon-arrow-right14 position-right"></i></button>
                    <button type="button" class="btn btn-link" id="submiting"
                        style="display: none;">{{_lang('Processing')}}
                        <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
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
<script src="{{ asset('js/pages/loan_from_member_account.js') }}"></script>


@endpush
