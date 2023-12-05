@extends('layouts.app', ['title' => _lang('Edit Double Benifit Application Form'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Edit Double Benifit Application Form ">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Edit Double Benifit Application Form ')}}</h1>
        <p>{{_lang('Here You Can Submit Edited Double Benifit Applicaiton')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render('double-benifit-application') }} --}}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <form action="{{route('admin.approved-double-benifit.update',$model->uuid)}}" method="post" id="content_form">
            @method('patch')
            @csrf
            <div class="col-md-12" align="center">
                <hr>
                <h3 class="text-center">Member Information</h3>
                <div class="btn-group mt-1" role="group">

                <a data-placement="bottom" title="Go Back To Previous Page"
                    href="{{ url()->previous() != url()->full() ? url()->previous() : route('admin.pending-application.index') }}"
                    class="btn btn-secondary text-light btn-sm mr-2" title="{{ _lang('Back To Previous Page') }}" data-popup="tooltip"
                    data-placement="bottom">
                    <i class="fa fa-arrow-left"></i>Back
                </a>

                @can('double-benifit-pending-application.delete')
                    <a data-placement="bottom" title="Delete Double Benifit." href="" id="delete_item" data-id="{{$model->id}}"
                        data-url="{{route('admin.pending-application.destroy',$model->id) }}" class="btn btn-danger btn-sm"
                        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i> Delete</a>
                @endcan
                    @can('double-benifit-pending-application.approval')
                    <a data-placement="bottom" title="Approve Account" href="{{ route('admin.approved-double-benifit.approval',$model->uuid) }}"
                        class="btn btn-success text-light btn-sm ml-1" title="{{ _lang('Approve') }}" data-popup="tooltip"
                        data-placement="bottom">
                        <i class="fa fa-check-circle"></i>Approve
                    </a>
                    @endcan

            </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="member_id">{{_lang('Select Member')}} <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="member_id" name="member_id"
                                    value="{{ $model->member->name_in_bangla.', '.$model->member->contact_number }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="prefix">{{_lang('Account Prefix')}} </label>
                            <div class="">
                                <input type="text" class="form-control" id="prefix" name="prefix"
                                    value="{{$model->prefix}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="code">{{_lang('Account Code')}} </label>
                            <div class="">
                                <input type="text" class="form-control" id="code" name="code"
                                    value="{{numer_padding($model->code, get_option('digits_double_benifit_code'))}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Member  Address --}}
                        <div class="col-md-12 form-group mamber_info">
                            <label for="member_permanent_address">{{_lang(' Address')}}
                            </label>
                            <div class="">

                                <textarea name="member_permanent_address" class="form-control"
                                    id="member_permanent_address" readonly
                                    style="width:100%">Father: {{$model->member->father_name}}, Address: {{$model->member->present_address_line1}}</textarea>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="col-md-6">
                    <div class="row">
                        <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="member_permanent_address">{{_lang(' Photo')}}
                                </label>
                                <div>
                                    <a href="{{asset('storage/member/'.$model->member->photo)}}" target="_blank"> <img
                                            src="{{asset('storage/member/'.$model->member->photo)}}" id="member_image"
                                            width="60%" class="rounded img-thumbnail" alt="Photo Not Found"></a>
                                </div>
                            </div>

                        </div>

                        <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="member_permanent_address">{{_lang(' Signature')}}
                                </label>
                                <div>
                                    <a href="{{asset('storage/member/'.$model->member->signature)}}" target="_blank">
                                        <img src="{{asset('storage/member/'.$model->member->signature)}}"
                                            id="member_sign" width="60%" class="rounded img-thumbnail"
                                            alt="Signature Not Found"></a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-md-12">
                    <hr>
                    <div class="animated-checkbox text-center">
                        <span style="font-size:27px"> <b> Double Benifit Information || </b></span>
                        <span class="text-danger ml-2" style="font-size:18px">Round Floating values ?</span>
                        <label class="ml-2">
                            <input type="checkbox" {{ $model->round == 1?'checked':'' }} id="round" name="round">
                            <span class="label-text"></span>
                        </label>
                    </div>
                    <hr>
                </div>

                {{--  double_benifit_amt --}}
                <div class="col-md-6 form-group">
                    <label for="double_benifit_amt">{{_lang('Double Benifit Amount (One Time)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min="0" step="1" required name="double_benifit_amt" id="double_benifit_amt"
                            placeholder="Enter Submit Amt Per Month" class="form-control" value="{{$model->double_benifit_amt}}">
                    </div>
                </div>

                {{--  double_benifit_type --}}
                <div class="col-md-6 form-group">
                    <label for="double_benifit_type"> {{_lang('Double Benifit Type')}} </label><span class="text-danger">*</span>
                    <div class="">
                        <select name="double_benifit_type" id="double_benifit_type" data-placeholder="Please Select One.."
                            class="form-control select" data-url="{{ route('admin.double-benifit-application.double_benifit_type')}}" required data-parsley-errors-container="#double_benifit_type_error">
                            <option value="">Please Select One .. </option>
                            @foreach ($double_benifit_types as $double_benifit_type)
                            <option value="{{$double_benifit_type->id}}" {{$model->double_benifit_type == $double_benifit_type->id ? 'selected':''}}>
                                {{$double_benifit_type->service_name.', '.$double_benifit_type->duration.' '.$double_benifit_type->duration_type.', '.$double_benifit_type->rate.'%'}}
                            </option>
                            @endforeach
                        </select>
                        <span id="double_benifit_type_error"></span>
                    </div>
                </div>

                {{--  Interest Rate --}}
                <div class="col-md-4 form-group">
                    <label for="interest_rate">{{_lang('Interest Rate(%)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" readonly min='0' step="0.01" required name="interest_rate" id="interest_rate"
                            placeholder="Interest Rate(%)" class="form-control" value="{{$model->interest_rate}}">
                    </div>
                </div>

                {{--  Double Benifit Duration --}}
                <div class="col-md-8 form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="double_benifit_duration">{{_lang('Double Benifit Duration')}}
                            </label><span class="text-danger">*</span>
                        </div>
                        <div class="col-md-6">
                            <input type="number" min='0' step="1" required name="double_benifit_duration" id="double_benifit_duration"
                        placeholder="Enter Double Benifit Duration" class="form-control" value="{{$model->double_benifit_duration}}">
                        </div>
                        <div class="col-md-6">
                             <select name="double_benifit_duration_type" required id="double_benifit_duration_type" data-placeholder="Please Select One.."
                            class="form-control select" data-parsley-errors-container="#double_benifit_duration_type_error">
                            <option value="">Please Select One .. </option>
                            <option value="Month" {{$model->double_benifit_duration_type == 'Month'? "selected":''}}>Month</option>
                            <option value="Year" {{$model->double_benifit_duration_type == 'Year'? "selected":''}}>Year</option>
                        </select>
                        <span id="double_benifit_duration_type_error"></span>
                        </div>
                    </div>

                </div>

                {{--  total_interest_amt --}}
                <div class="col-md-4 form-group">
                    <label for="total_interest_amt">{{_lang('Total Interest (Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" readonly required name="total_interest_amt" id="total_interest_amt"
                    placeholder="Total Interest Amount (Taka)" class="form-control" value="{{$model->total_interest_amt}}">
                    </div>
                </div>

                {{--  grand_total_double_benifit --}}
                <div class="col-md-4 form-group">
                    <label for="grand_total_double_benifit">{{_lang('Grand Total Amt(Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" readonly required name="grand_total_double_benifit" id="grand_total_double_benifit"
                    placeholder="Grand Total Amt (Taka) At The End" class="form-control" value="{{$model->grand_total_double_benifit}}">
                    </div>
                </div>



                {{--  double_benifit_reason --}}
                <div class="col-md-4 form-group">
                    <label for="double_benifit_reason">{{_lang('Double Benifit Reason')}}
                    </label>
                    <div class="">
                        <textarea name="double_benifit_reason" class="form-control" id="double_benifit_reason" placeholder="Describe Double Benifit Resoan"
                    style="width:100%">{{$model->double_benifit_reason}}</textarea>
                    </div>
                </div>


                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Nomenee Information (01)</h3>
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


                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Nomenee Information (02)</h3>
                    <hr>
                </div>

                {{-- nomenee's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_name2">{{_lang('Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_name2" placeholder="Enter nomenee Name" class="form-control"
                            value="{{$model->nomenee_name2}}">
                    </div>
                </div>

                {{-- nomenee's Father's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_fathers_name2">{{_lang('Father\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_fathers_name2" placeholder="Enter Father Name"
                            class="form-control" value="{{$model->nomenee_fathers_name2}}">
                    </div>
                </div>

                {{-- nomenee's Husband's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_husbands_name2">{{_lang('Husband\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_husbands_name2" placeholder="Enter Husband Name"
                            class="form-control" value="{{$model->nomenee_husbands_name2}}">
                    </div>
                </div>

                {{-- nomenee's Relation with mamber --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_relation_with_member2">{{_lang('Relation With Member')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_relation_with_member2" placeholder="Enter Relation With Member"
                            class="form-control" value="{{$model->nomenee_relation_with_member2}}">
                    </div>
                </div>

                {{-- nomenee's Age --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_age2">{{_lang('Age')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_age2" placeholder="Enter Age" class="form-control"
                            value="{{$model->nomenee_age2}}">
                    </div>
                </div>

                {{-- nomenee's part_asset --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_part_asset2">{{_lang('Part Of Asset (%)')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_part_asset2" placeholder="Enter Part Of Asset (%)"
                            class="form-control" value="{{$model->nomenee_part_asset2}}">
                    </div>
                </div>

                {{-- nomenee's Permanent Address --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_permanent_address2">{{_lang('Permanent Address')}}
                    </label>
                    <div class="">

                        <textarea name="nomenee_permanent_address2" class="form-control" id="nomenee_permanent_address2"
                            placeholder="Enter Permanent Address"
                            style="width:100%">{{$model->nomenee_permanent_address2}}</textarea>
                    </div>
                </div>


                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Nomenee Information (03)</h3>
                    <hr>
                </div>

                {{-- nomenee's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_name3">{{_lang('Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_name3" placeholder="Enter nomenee Name" class="form-control"
                            value="{{$model->nomenee_name3}}">
                    </div>
                </div>

                {{-- nomenee's Father's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_fathers_name3">{{_lang('Father\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_fathers_name3" placeholder="Enter Father Name"
                            class="form-control" value="{{$model->nomenee_fathers_name3}}">
                    </div>
                </div>

                {{-- nomenee's Husband's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_husbands_name3">{{_lang('Husband\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_husbands_name3" placeholder="Enter Husband Name"
                            class="form-control" value="{{$model->nomenee_husbands_name3}}">
                    </div>
                </div>

                {{-- nomenee's Relation with mamber --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_relation_with_member3">{{_lang('Relation With Member')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_relation_with_member3" placeholder="Enter Relation With Member"
                            class="form-control" value="{{$model->nomenee_relation_with_member3}}">
                    </div>
                </div>

                {{-- nomenee's Age --}}
                <div class="col-md-3 form-group">
                    <label for="nomenee_age3">{{_lang('Age')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_age3" placeholder="Enter Age" class="form-control"
                            value="{{$model->nomenee_age3}}">
                    </div>
                </div>

                {{-- nomenee's part_asset --}}
                <div class="col-md-3 form-group">
                    <label for="nomenee_part_asset3">{{_lang('Part Of Asset (%)')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_part_asset3" placeholder="Enter Part Of Asset (%)"
                            class="form-control" value="{{$model->nomenee_part_asset3}}">
                    </div>
                </div>

                {{-- nomenee's Permanent Address --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_permanent_address3">{{_lang('Permanent Address')}}
                    </label>
                    <div class="">

                        <textarea name="nomenee_permanent_address3" class="form-control" id="nomenee_permanent_address3"
                            placeholder="Enter Permanent Address"
                            style="width:100%">{{$model->nomenee_permanent_address3}}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Identity provider</h3>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="identity_provider_id">{{_lang('Select Identity Provider')}} <span
                                            class="text-danger">*</span>
                                    </label>
                                    <select name="identity_provider_id" id="identity_provider_id" required
                                        data-url="{{ route('admin.loan-account.member-info') }}"
                                        class="form-control select" data-placeholder="Please Select One .." required>
                                        <option value="">Please Select One ..</option>
                                        @foreach ($members as $member)
                                        <option value="{{$member->id}}"
                                            {{ ($model->identity_provider_id == $member->id)?'selected':'' }}>
                                            {{ $member->name_in_bangla.', '.$member->contact_number }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="identity_provider_savings_account">{{_lang('Savings Account No')}} </label>
                            <div class="">
                                <input type="text" readonly class="form-control" id="identity_provider_savings_account"
                                    name="prefix" value="{{$code_prefix}}">
                            </div>
                        </div>

                    </div> --}}
                    <div class="row">
                        {{-- Member  Address --}}
                        <div class="col-md-12 form-group mamber_info">
                            <label for="identity_provider_address">{{_lang(' Address')}}
                            </label>
                            <div class="">

                                <textarea name="identity_provider_address" class="form-control"
                                    id="identity_provider_address" readonly
                                    style="width:100%">Father: {{$model->identity_provider->father_name}}, Address: {{$model->identity_provider->present_address_line1}}</textarea>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="col-md-6">
                    <div class="row">
                        <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="identity_provider_photo">{{_lang(' Photo')}}
                                </label>
                                <div>
                                    <a href="{{asset('storage/member/'.$model->identity_provider->photo)}}"
                                        target="_blank"> <img
                                            src="{{asset('storage/member/'.$model->identity_provider->photo)}}"
                                            id="identity_provider_photo" width="60%" class="rounded img-thumbnail"
                                            alt="Photo Not Found"></a>
                                </div>
                            </div>

                        </div>

                        <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="identity_provider_signature">{{_lang(' Signature')}}
                                </label>
                                <div>
                                    <a href="{{asset('storage/member/'.$model->identity_provider->signature)}}"
                                        target="_blank"> <img
                                            src="{{asset('storage/member/'.$model->identity_provider->signature)}}"
                                            id="identity_provider_signature" width="60%" class="rounded img-thumbnail"
                                            alt="Signature Not Found"></a>
                                </div>

                            </div>

                        </div>
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
<script src="{{ asset('js/pages/double_benifit_account.js') }}"></script>

<script>
    $('.select').select2({
        width: '100%'
    });

</script>


@endpush
