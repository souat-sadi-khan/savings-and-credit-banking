@extends('layouts.app', ['title' => _lang('Employee Payroll Template'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Employee Payroll Template.">{{--<i class="fa fa-universal-access mr-4"></i>--}}
            {{_lang('Employee Payroll Template')}}</h1>
        <p>{{_lang('Create Employee Payroll Template. Here you can Add, Edit & Delete The Employee Payroll Template')}}
        </p>
    </div>
    {{--<ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('employee-payroll-template') }}
    </ul>--}}
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="row">
    <div class="col-md-12">
        <div class="card border-right">
            <div class="card-body">
                <form action="{{route('admin.employee-payroll-template.store')}}" method="post" id="content_form">
                    @csrf
                    <div class="row">
                        {{-- Name --}}
                        <div class="col-md-6 form-group">
                            <label for="name">{{_lang('Name')}} <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Type Template Name" required>
                        </div>

                        {{-- Active Status --}}
                        <div class="col-md-6 form-group">
                            <label for="name">{{_lang('Is Active ?')}} <span class="text-danger">*</span>
                            </label>
                            <select data-parsley-errors-container="#parsley_error_active_status_create_for_templating" data-placeholder="Select Active Status" name="is_active" class="form-control select" id="is_active" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span id="parsley_error_active_status_create_for_templating"></span>
                        </div>

                        {{--Description --}}
                        <div class="col-md-12 form-group">
                            <label for="name">{{_lang('Description')}}
                            </label>
                            <textarea name="description" class="form-control" id=""placeholder="Enter Description"></textarea>
                        </div>
                    </div>


                    <div class="list-group">
                        <ul class="" id="sortable">
                        @foreach ($models as $item)
                        <li class="list-group-item ui-state-default" id="item_{{$loop->index}}" data-id="{{$loop->index}}">
                        <input type="hidden" name="position[{{$item->id}}]" id="position_{{$loop->index}}" value="{{$loop->index}}">
                            <div class="row" draggable="false">
                                <div class="col-12 col-sm-3"><i class="fa fa-arrows-alt pointer mr-2"></i> <span
                                        class="{{$item->type== 'Earning'?'text-success':'text-danger'}}">{{$item->name}} ({{$item->alias}})</span>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div  class="form-group"><select required id="{{$item->id}}"
                                            name="pay_head_category[{{$item->id}}]" class="pay_head_category custom-select col-12">
                                            <option value="">Select One</option>
                                            <option value="not_applicable">
                                                Not Applicable
                                            </option>
                                            <option value="attendance">
                                                On Attendance
                                            </option>
                                            <option value="flat_rate">
                                                Flat Rate
                                            </option>
                                            <option value="user_defined">
                                                User Defined
                                            </option>
                                        </select>
                                        <!---->
                                    </div>
                                </div>

                                {{-- Computation Formula --}}
                                <div class="col-12 col-sm-5" id="computation_{{$item->id}}" style="display:none">
                                    <div class="form-group">
                                        <input type="text" id="pay_head_{{$item->id}}" name="pay_head_computation[{{$item->id}}]"
                                            placeholder="Computation Formula" class="pay_head form-control">
                                    </div>
                                </div>

                                {{-- Attendance Type --}}
                                <div class=" col-12 col-sm-5 form-group" id="attendance_type_{{$item->id}}"
                                    style="display:none">
                                    <select data-placeholder="Select Attendance Type" id="attendance_{{$item->id}}" name="attendance_type[{{$item->id}}]"
                                        class="attendance form-control select">
                                        <option value="">Select Attendance Type</option>
                                        @foreach ($type as $model)
                                        <option value="{{$model->id}}">{{$model->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="form-group col-md-12" align="right">
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
<script src="{{ asset('js/employee/payroll-template.js') }}"></script>
<script src="{{asset('backend/js/jquery.sortable.js')}} "></script>
<script>
    $(function() {
        $('.list-group-sortable-connected').sortable({
                placeholderClass: 'list-group-item',
                connectWith: '.connected'
            });
    })
    $(document).on('change', '.pay_head_category', function () {
        var payhead = $(this).val();
        var id = $(this).attr('id');

        if (payhead == 'computation') {
            $('#computation_' + id).show('slow');
            $('#attendance_type_' + id).hide('slow');
            $('#pay_head_' + id).attr('required',true);
            $('#attendance_' + id).val('').trigger("change");
            $('#attendance_' + id).attr('required',false);
        } else if (payhead == 'production') {
            $('#computation_' + id).hide('slow');
            $('#attendance_type_' + id).show('slow');
            $('#attendance_' + id).attr('required',true);
            $('#pay_head_' + id).val('');
            $('#pay_head_' + id).attr('required',false);
        }else{
            $('#computation_' + id).hide('slow');
            $('#attendance_type_' + id).hide('slow');
            $('.pay_head').attr('required',false);
            $('.attendance').attr('required',false);
            $('#pay_head_' + id).attr('required',false);
            $('#attendance_' + id).attr('required',false);
        }
        $('.select').select2({
            width: '100%'
        });

    });
</script>
@endpush
