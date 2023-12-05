@extends('layouts.app', ['title' => _lang('Edit Loan From Member Application Form'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Edit Loan From Member Application Form ">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Edit Loan From Member Application Form ')}}</h1>
        <p>{{_lang('Here You Can Submit Edited Loan From Member Applicaiton')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render('loan-from-member-application') }} --}}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <form action="{{route('admin.loan-member-pending-application.update',$model->uuid)}}" method="post"
            id="content_form">
            @method('patch')
            @csrf



            <div class="row">

                <div class="col-md-12" align="center">
                    <hr>
                    <div class="animated-checkbox text-center">
                        <span style="font-size:27px"> <b> Loan From Member Information || </b></span>
                        <span class="text-danger ml-2" style="font-size:18px">Round Floating values ?</span>
                        <label class="ml-2">
                            <input type="checkbox" {{ $model->round == 1?'checked':'' }} id="round" name="round">
                            <span class="label-text"></span>
                        </label>
                    </div>
                    <div class="btn-group mt-1 text-center" role="group">

                        <a data-placement="bottom" title="Go Back To Previous Page"
                            href="{{ url()->previous() != url()->full() ? url()->previous() : route('admin.loan-member-pending-application.index') }}"
                            class="btn btn-secondary text-light btn-sm mr-2"
                            title="{{ _lang('Back To Previous Page') }}" data-popup="tooltip" data-placement="bottom">
                            <i class="fa fa-arrow-left"></i>Back
                        </a>

                        @can('loan-from-member-pending-application.delete')
                        <a data-placement="bottom" title="Delete Double Benifit." href="" id="delete_item"
                            data-id="{{$model->id}}"
                            data-url="{{route('admin.loan-member-pending-application.destroy',$model->id) }}"
                            class="btn btn-danger btn-sm" title="{{ _lang('Delete') }}" data-popup="tooltip"
                            data-placement="bottom"><i class="fa fa-trash"></i> Delete</a>
                        @endcan
                        @can('loan-from-member-pending-application.approval')
                        <a data-placement="bottom" title="Approve Account"
                            href="{{ route('admin.loan-member-pending-application.approval',$model->uuid) }}"
                            class="btn btn-success text-light btn-sm ml-1" title="{{ _lang('Approve') }}"
                            data-popup="tooltip" data-placement="bottom">
                            <i class="fa fa-check-circle"></i>Approve
                        </a>
                        @endcan

                    </div>
                    <hr>
                </div>

                {{--  loan_amt --}}
                <div class="col-md-6 form-group">
                    <label for="loan_amt">{{_lang('Loan Amount')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min="0" step="1" required name="loan_amt" id="loan_amt"
                            placeholder="Enter Loan Amount" class="form-control" value="{{$model->loan_amt}}">
                    </div>
                </div>

                {{--  loan_type --}}
                <div class="col-md-6 form-group">
                    <label for="loan_type"> {{_lang('Double Benifit Type')}} </label><span class="text-danger">*</span>
                    <div class="">
                        <select name="loan_type" id="loan_type" data-placeholder="Please Select One.."
                            class="form-control select"
                            data-url="{{ route('admin.loan-from-member-application.loan_type')}}" required
                            data-parsley-errors-container="#loan_type_error">
                            <option value="">Please Select One .. </option>
                            @foreach ($fdr_types as $loan_type)
                            <option value="{{$loan_type->id}}" {{$model->loan_type == $loan_type->id ? 'selected':''}}>
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
                            placeholder="Interest Rate(%)" class="form-control" value="{{$model->interest_rate}}">
                    </div>
                </div>

                {{--  Loan Duration --}}
                <div class="col-md-8 form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="loan_duration">{{_lang('Double Benifit Duration')}}
                            </label><span class="text-danger">*</span>
                        </div>
                        <div class="col-md-6">
                            <input type="number" min='0' step="1" required name="loan_duration" id="loan_duration"
                                placeholder="Enter Double Benifit Duration" class="form-control"
                                value="{{$model->loan_duration}}">
                        </div>
                        <div class="col-md-6">
                            <select name="loan_duration_type" required id="loan_duration_type"
                                data-placeholder="Please Select One.." class="form-control select"
                                data-parsley-errors-container="#loan_duration_type_error">
                                <option value="">Please Select One .. </option>
                                <option value="Month" {{$model->loan_duration_type == 'Month'? "selected":''}}>Month
                                </option>
                                <option value="Year" {{$model->loan_duration_type == 'Year'? "selected":''}}>Year
                                </option>
                            </select>
                            <span id="loan_duration_type_error"></span>
                        </div>
                    </div>

                </div>

                {{--  total_interest_amt --}}
                <div class="col-md-4 form-group">
                    <label for="total_interest_amt">{{_lang('Total Interest (Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" readonly required name="total_interest_amt" id="total_interest_amt"
                            placeholder="Total Interest Amount (Taka)" class="form-control"
                            value="{{$model->total_interest_amt}}">
                    </div>
                </div>

                {{--  grand_total_amt --}}
                <div class="col-md-4 form-group">
                    <label for="grand_total_amt">{{_lang('Grand Total Amt(Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" readonly required name="grand_total_amt" id="grand_total_amt"
                            placeholder="Grand Total Amt (Taka) At The End" class="form-control"
                            value="{{$model->grand_total_amt}}">
                    </div>
                </div>



                {{--  loan_reason --}}
                <div class="col-md-4 form-group">
                    <label for="loan_reason">{{_lang('Lona Reason Reason')}}
                    </label>
                    <div class="">
                        <textarea name="loan_reason" class="form-control" id="loan_reason"
                            placeholder="Describe Lona Reason Resoan"
                            style="width:100%">{{$model->loan_reason}}</textarea>
                    </div>
                </div>


                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Nomenee Information</h3>
                    <hr>
                </div>

                {{-- nomenee's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_name1">{{_lang('Name')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" required name="nomenee_name1" placeholder="Enter nomenee Name"
                            class="form-control" value="{{$model->nomenee_name1}}">
                    </div>
                </div>

                {{-- nomenee's Father's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_fathers_name1">{{_lang('Father\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_fathers_name1" placeholder="Enter Father Name"
                            class="form-control" value="{{$model->nomenee_fathers_name1}}">
                    </div>
                </div>

                {{-- nomenee's Husband's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_husbands_name1">{{_lang('Husband\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_husbands_name1" placeholder="Enter Husband Name"
                            class="form-control" value="{{$model->nomenee_husbands_name1}}">
                    </div>
                </div>

                {{-- nomenee's Relation with mamber --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_relation_with_member1">{{_lang('Relation With Member')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" required name="nomenee_relation_with_member1"
                            placeholder="Enter Relation With Member" class="form-control"
                            value="{{$model->nomenee_relation_with_member1}}">
                    </div>
                </div>

                {{-- nomenee's Age --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_age1">{{_lang('Age')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_age1" placeholder="Enter Age" class="form-control"
                            value="{{$model->nomenee_age1}}">
                    </div>
                </div>

                {{-- nomenee's part_asset --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_part_asset1">{{_lang('Part Of Asset (%)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" required name="nomenee_part_asset1" placeholder="Enter Part Of Asset (%)"
                            class="form-control" value="{{$model->nomenee_part_asset1}}">
                    </div>
                </div>

                {{-- nomenee's Permanent Address --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_permanent_address1">{{_lang('Permanent Address')}}
                    </label><span class="text-danger">*</span>
                    <div class="">

                        <textarea required name="nomenee_permanent_address1" class="form-control"
                            id="nomenee_permanent_address1" placeholder="Enter Permanent Address"
                            style="width:100%">{{$model->nomenee_permanent_address1}}</textarea>
                    </div>
                </div>
            </div>
    </div>

    {{-- Active Status --}}
    <div class="col-md-12 form-group">
        <label for="status">{{_lang('Active Status')}}
        </label><span class="text-danger">*</span>
        <div class="">
            <select name="status" id="status" data-placeholder="Please Select One.." class="form-control select"
                required data-parsley-errors-container="#status_error">
                <option value="">Please Select One .. </option>
                <option value="Active" {{ $model->status == 'Active'?'Selected':'' }}>Active</option>
                <option value="Inactive" {{ $model->status == 'Inactive'?'Selected':'' }}>Inactive</option>
            </select>
            <span id="status_error"></span>
        </div>
    </div>


    <div class="form-group col-md-12" align="right">
        {{-- <input type="hidden" name="type[]" value=" "> --}}
        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Update Info')}}<i
                class="icon-arrow-right14 position-right"></i></button>
        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
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
<script src="{{ asset('js/pages/loan_from_member_account.js') }}"></script>

<script>
    $('.select').select2({
        width: '100%'
    });

</script>


@endpush
