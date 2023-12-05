@extends('layouts.app', ['title' => _lang('Update Double Benifit Approval'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Update Double Benifit Approval Of  {{$account_information->member->name_in_bangla}}">{{--<i
                class="fa fa-users mr-4"></i>--}}
            {{_lang('Update Double Benefit Approval Of ')}}{{$account_information->member->name_in_bangla}}</h1>
        <p>{{_lang('Here you can update double benefit')}}</p>
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
                    href="{{ url()->previous() != url()->full() ? url()->previous() : route('admin.approved-double-benifit.index') }}"
                    class="btn btn-secondary text-light btn-sm mr-2" title="{{ _lang('Back To Previous Page') }}" data-popup="tooltip"
                    data-placement="bottom">
                    <i class="fa fa-arrow-left"></i>Back
                </a>
                 @can('double-benifit-pending-application.update')
                    <a data-placement="bottom" title="Edit Double Benifit" href="{{ route('admin.approved-double-benifit.edit',$account_information->uuid) }}"
                        id="" class="btn btn-info btn-sm text-light" title="{{ _lang('Edit') }}" data-popup="tooltip"
                        data-placement="bottom"><i class="fa fa-pencil-square-o"></i>Edit Info</a>
                @endcan

                @can('double-benifit-approved-double-benifit.delete')
                    <a data-placement="bottom" title="Delete Double Benifit." href="" id="delete_item" data-id="{{$account_information->id}}"
                        data-url="{{route('admin.approved-double-benifit.destroy',$account_information->id) }}" class="btn btn-danger btn-sm ml-1"
                        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i> Delete</a>
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
                    <span> <a href="{{ route('admin.member-list.edit', $account_information->identity_provider->code, get_option('digits_member_code'))}}</span> </a></div>
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
                    <span>{{$account_information->prefix.'-'.numer_padding($account_information->code, get_option('digits_double_benifit_code'))}}</span>
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
                    <span>{{$account_information->grand_total_double_benifit}}</span>
                </div>
                @endif

                @if ( $account_information->double_benifit_reason )
                <div><span class="font-weight-bold mr-3"> Double Benifit Reason: </span>
                    <span>{{$account_information->double_benifit_reason}} (Taka/Installment)</span>
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
            <h3 class="text-center mt-3">Double Benifit Approval</h3>
            <hr>
        </div>

        <div class="col-md-12">
            <form action="{{route('admin.approved-double-benifit.add_approval',$account_information->uuid)}}" method="post" id="approve_form">
                @csrf
                @method('PATCH')
                <div class="row mt-5">
                    <div class="col-md-6 row ">
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


                    <div class="col-md-3 form-group" style="display:none">
                        <label for="loan_duration">{{_lang('Loan Duration Hidden')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" id="loan_duration" readonly name="loan_duration"
                                placeholder="Enter Issue Date" class="form-control"
                                value="{{$account_information->double_benifit_duration}}">
                        </div>
                    </div>


                    <div class="col-md-3 form-group" style="display:none">
                        <label for="loan_duration_type">{{_lang('Loan Duration type Hidden')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" id="loan_duration_type" readonly name="loan_duration_type"
                                placeholder="Enter Issue Date" class="form-control"
                                value="{{$account_information->double_benifit_duration_type}}">
                        </div>
                    </div>


                    <div class="col-md-3 form-group">
                        <label for="issue_date">{{_lang('Issue Date')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" data-url="{{route('admin.verified-loan.get_completation_date')}}"
                                id="issue_date" required readonly name="issue_date" placeholder="Enter Issue Date" class="form-control date"  value="{{date("d/m/Y", strtotime($account_information->issue_date))}}">
                        </div>
                    </div>


                    <div class="col-md-3 form-group">
                        <label for="completion_date">{{_lang('Completation Date')}}
                        </label><span class="text-danger">*</span>
                        <div class="">
                            <input type="text" required readonly id="completion_date" name="completion_date"
                                placeholder="Enter Completation Date" class="form-control "  value="{{date("d/m/Y", strtotime($account_information->completion_date))}}">
                        </div>
                    </div>


                    <div class="col-md-12 form-group">
                        <label for="approval_comment">{{_lang('Comment')}}
                        </label>
                        <div class="input-group">
                            <textarea name="approval_comment" id="approval_comment"
                                class="form-control">{{$account_information->approval_comment}}</textarea>
                        </div>
                    </div>

                </div>
                <div class="row m-2">

                </div>

                <div class="col-md-12">
                    <hr>
                    <h5 class="text-center">
                        <span class="badge badge-danger">Remember:</span> If You Reject The Approval Then <span class=" text-danger">The Transaction Related With It Will Be Erased</span>. If You Do So It's Your Responsibility. So Handle It With Care...
                    </h5>
                    <hr>
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
<script src="{{ asset('js/pages/double_benifit_account.js') }}"></script>


@endpush
