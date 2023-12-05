@extends('layouts.app', ['title' => _lang('Double Benifit Application Form'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Double Benifit Application Form ">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Double Benefit Application Form ')}}</h1>
        <p>{{_lang('Here You Can Submit Double Benefit Application')}}</p>
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
        <form action="{{route('admin.double-benifit-application.store')}}" method="post" id="content_form">
            @csrf
            <div class="col-md-12">
                <hr>
                <h3 class="text-center">Member Information</h3>
                <hr>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="member_id">{{_lang('Select Member')}} <span class="text-danger">*</span>
                            </label>
                            <select name="member_id" id="member_id"
                                data-url="{{ route('admin.loan-account.member-info') }}" class="form-control select"
                                data-placeholder="Please Select One .." required
                                data-parsley-errors-container="#member_id_error">
                                <option value="">Please Select One ..</option>
                                @foreach ($model as $member)
                                <option value="{{$member->id}}">
                                    {{ $member->name_in_bangla.', '.$member->contact_number }}
                                </option>
                                @endforeach
                            </select>
                            <span id="member_id_error"></span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="prefix">{{_lang('Account Prefix')}} </label>
                            <div class="">
                                <input type="text" class="form-control" id="prefix" name="prefix"
                                    value="{{$code_prefix}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="code">{{_lang('Account Code')}} </label>
                            <div class="">
                                <input type="text" class="form-control" id="code" name="code" value="{{$uniqu_id}}">
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
                                    id="member_permanent_address" readonly style="width:100%"></textarea>
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
                                    <a href="" target="_blank"> <img src="" id="member_image" width="60%"
                                            class="rounded img-thumbnail" alt="Photo Not Found"></a>
                                </div>
                            </div>

                        </div>

                        <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="member_permanent_address">{{_lang(' Signature')}}
                                </label>
                                <div>
                                    <a href="" target="_blank"> <img src="" id="member_sign" width="60%"
                                            class="rounded img-thumbnail" alt="Signature Not Found"></a>
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
                            <input type="checkbox" id="round" name="round"><span class="label-text"></span>
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
                            placeholder="Enter Double Benifit Opening Balance" class="form-control">
                    </div>
                </div>

                {{--  double_benifit_type --}}
                <div class="col-md-6 form-group">
                    <label for="double_benifit_type"> {{_lang('Double Benifit Type')}} </label><span
                        class="text-danger">*</span>
                    <div class="">
                        <select name="double_benifit_type" id="double_benifit_type"
                            data-placeholder="Please Select One.." class="form-control select"
                            data-url="{{ route('admin.double-benifit-application.double_benifit_type')}}" required
                            data-parsley-errors-container="#double_benifit_type_error">
                            <option value="">Please Select One .. </option>
                            @foreach ($double_benifit_types as $double_benifit_type)
                            <option value="{{$double_benifit_type->id}}">
                                {{$double_benifit_type->service_name.', '.$double_benifit_type->duration.' '.$double_benifit_type->duration_type.', '.$double_benifit_type->rate.'%'}}
                            </option>
                            @endforeach
                        </select>
                        <span id="double_benifit_type_error"></span>
                    </div>
                </div>

                {{-- Interest Rate --}}
                <div class="col-md-4 form-group">
                    <label for="interest_rate">{{_lang('Interest Rate(%)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="number" min='0' step='0.01' readonly required name="interest_rate"
                            id="interest_rate" placeholder="Interest Rate(%)" class="form-control">
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
                            <input type="number" min='0' step="1" required name="double_benifit_duration"
                                id="double_benifit_duration" placeholder="Enter Double Benifit Duration"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <select name="double_benifit_duration_type" required id="double_benifit_duration_type"
                                data-placeholder="Please Select One.." class="form-control select"
                                data-parsley-errors-container="#double_benifit_duration_type_error">
                                <option value="">Please Select One .. </option>
                                <option value="Month">Month</option>
                                <option value="Year">Year</option>
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
                            placeholder="Total Interest Amount (Taka)" class="form-control">
                    </div>
                </div>

                {{--  grand_total_double_benifit --}}
                <div class="col-md-4 form-group">
                    <label for="grand_total_double_benifit">{{_lang('Grand Total Amt(Taka)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" readonly required name="grand_total_double_benifit"
                            id="grand_total_double_benifit" placeholder="Grand Total Amt (Taka) At The End"
                            class="form-control">
                    </div>
                </div>



                {{--  double_benifit_reason --}}
                <div class="col-md-4 form-group">
                    <label for="double_benifit_reason">{{_lang('Double Benifit Reason')}}
                    </label>
                    <div class="">
                        <textarea name="double_benifit_reason" class="form-control" id="double_benifit_reason"
                            placeholder="Describe Double Benifit Resoan" style="width:100%"></textarea>
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
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Father's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_fathers_name1">{{_lang('Father\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_fathers_name1" placeholder="Enter Father Name"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Husband's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_husbands_name1">{{_lang('Husband\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_husbands_name1" placeholder="Enter Husband Name"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Relation with mamber --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_relation_with_member1">{{_lang('Relation With Member')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" required name="nomenee_relation_with_member1"
                            placeholder="Enter Relation With Member" class="form-control">
                    </div>
                </div>

                {{-- nomenee's Age --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_age1">{{_lang('Age')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_age1" placeholder="Enter Age" class="form-control">
                    </div>
                </div>

                {{-- nomenee's part_asset --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_part_asset1">{{_lang('Part Of Asset (%)')}}
                    </label><span class="text-danger">*</span>
                    <div class="">
                        <input type="text" required name="nomenee_part_asset1" placeholder="Enter Part Of Asset (%)"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Permanent Address --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_permanent_address1">{{_lang('Permanent Address')}}
                    </label><span class="text-danger">*</span>
                    <div class="">

                        <textarea required name="nomenee_permanent_address1" class="form-control"
                            id="nomenee_permanent_address1" placeholder="Enter Permanent Address"
                            style="width:100%"></textarea>
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
                        <input type="text" name="nomenee_name2" placeholder="Enter nomenee Name" class="form-control">
                    </div>
                </div>

                {{-- nomenee's Father's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_fathers_name2">{{_lang('Father\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_fathers_name2" placeholder="Enter Father Name"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Husband's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_husbands_name2">{{_lang('Husband\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_husbands_name2" placeholder="Enter Husband Name"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Relation with mamber --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_relation_with_member2">{{_lang('Relation With Member')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_relation_with_member2" placeholder="Enter Relation With Member"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Age --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_age2">{{_lang('Age')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_age2" placeholder="Enter Age" class="form-control">
                    </div>
                </div>

                {{-- nomenee's part_asset --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_part_asset2">{{_lang('Part Of Asset (%)')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_part_asset2" placeholder="Enter Part Of Asset (%)"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Permanent Address --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_permanent_address2">{{_lang('Permanent Address')}}
                    </label>
                    <div class="">

                        <textarea name="nomenee_permanent_address2" class="form-control" id="nomenee_permanent_address2"
                            placeholder="Enter Permanent Address" style="width:100%"></textarea>
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
                        <input type="text" name="nomenee_name3" placeholder="Enter nomenee Name" class="form-control">
                    </div>
                </div>

                {{-- nomenee's Father's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_fathers_name3">{{_lang('Father\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_fathers_name3" placeholder="Enter Father Name"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Husband's Name --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_husbands_name3">{{_lang('Husband\'s Name')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_husbands_name3" placeholder="Enter Husband Name"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Relation with mamber --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_relation_with_member3">{{_lang('Relation With Member')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_relation_with_member3" placeholder="Enter Relation With Member"
                            class="form-control">
                    </div>
                </div>

                {{-- nomenee's Age --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_age3">{{_lang('Age')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_age3" placeholder="Enter Age" class="form-control">
                    </div>
                </div>

                {{-- nomenee's part_asset --}}
                <div class="col-md-2 form-group">
                    <label for="nomenee_part_asset3">{{_lang('Part Of Asset (%)')}}
                    </label>
                    <div class="">
                        <input type="text" name="nomenee_part_asset3" placeholder="Enter Part Of Asset (%)"
                            class="form-control">
                    </div>
                </div>
                {{-- nomenee's Permanent Address --}}
                <div class="col-md-4 form-group">
                    <label for="nomenee_permanent_address3">{{_lang('Permanent Address')}}
                    </label>
                    <div class="">

                        <textarea name="nomenee_permanent_address3" class="form-control" id="nomenee_permanent_address3"
                            placeholder="Enter Permanent Address" style="width:100%"></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <h3 class="text-center">Identity Provider</h3>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="identity_provider_id">{{_lang('Select Member')}} <span
                                            class="text-danger">*</span>
                                    </label>
                                    <select name="identity_provider_id" id="identity_provider_id" required
                                        data-url="{{ route('admin.loan-account.member-info') }}"
                                        class="form-control select" data-placeholder="Please Select One .." required
                                        data-parsley-errors-container="#identity_provider_error">
                                        <option value="">Please Select One ..</option>
                                        @foreach ($model as $member)
                                        <option value="{{$member->id}}">
                                            {{ $member->name_in_bangla.', '.$member->contact_number }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span id="identity_provider_error"></span>

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
                                    id="identity_provider_address" readonly style="width:100%"></textarea>
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
                                    <a href="" target="_blank"> <img src="" id="identity_provider_photo" width="60%"
                                            class="rounded img-thumbnail" alt="Photo Not Found"></a>
                                </div>
                            </div>

                        </div>

                        <div align="center" class="col-md-6">
                            <div class="col-md-12 form-group mamber_info">
                                <label for="identity_provider_signature">{{_lang(' Signature')}}
                                </label>
                                <div>
                                    <a href="" target="_blank"> <img src="" id="identity_provider_signature" width="60%"
                                            class="rounded img-thumbnail" alt="Signature Not Found"></a>
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
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
            <span id="status_error"></span>
        </div>
    </div>


    <div class="form-group col-md-12" align="right">
        {{-- <input type="hidden" name="type[]" value=" "> --}}
        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
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
