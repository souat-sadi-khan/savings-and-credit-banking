@extends('layouts.app', ['title' => _lang('Member Qualification Information'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Member Qualification Information for {{$model->name}} ">{{--<i
                class="fa fa-users mr-4"></i>--}} {{_lang('Member Qualification Information')}}</h1>
        <p>{{_lang('Here you can add qualification')}}</p>
    </div>
</div>
@stop


{{-- Main Section --}}
@section('content')

<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Qualification for the Member')}} </h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.member-qualification.store')}}" method="post" id="content_form"
            enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                            <tr>
                                <th class="text-center">{{_lang('Exam Name')}}</th>
                                <th class="text-center">{{_lang('Institute Name')}}</th>
                                <th class="text-center">{{_lang('Board')}}</th>
                                <th class="text-center">{{_lang('Year')}}</th>
                                <th class="text-center">{{_lang('Result')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id='addr0'>
                                <td><input type="text" required name='exam_name[]' placeholder='Enter Exam Name'
                                        class="form-control" /></td>
                                <td><input type="text" required name='institute_name[]' placeholder='Enter Institute Name'
                                        class="form-control" /></td>
                                <td><input type="text" required name='board[]' placeholder='Enter Board Name' class="form-control" />
                                </td>
                                <td><input type="text" required name='year[]' placeholder='Enter Year Name' class="form-control" />
                                </td>
                                <td><input type="text" required name='result[]' placeholder='Enter Result Name'
                                        class="form-control" /></td>
                            </tr>
                            <tr id='addr1'></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <a id="add_row" class="btn btn-success text-light">Add Row</a>
                    <a id='delete_row' class=" btn btn-danger text-light float-right">Delete Row</a>
                </div>
            </div>

            <div class="form-group col-md-12 mt-5" align="right">
                <input type="hidden" name="member_id" value="{{$member_id}}">
                <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
                        class="icon-arrow-right14 position-right"></i></button>
                <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                    <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
            </div>
        </form>
    </div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script>
_formValidation();
	$(document).ready(function(){
    var i=1;
$("#add_row").click(function(){
      $('#tab_logic').append('<tr id="addr'+(i+1)+'"><td><input required type="text" name="exam_name[]" placeholder="Enter Exam Name" class="form-control" /></td><td><input required type="text" name="institute_name[]" placeholder="Enter Institute Name" class="form-control" /></td><td><input required type="text" name="board[]" placeholder="Enter Board Name" class="form-control" /></td><td><input required type="text" name="year[]" placeholder="Enter Year Name" class="form-control" /></td><td><input required type="text" name="result[]" placeholder="Enter Result Name" class="form-control" /></td>');
        i++;
    });

    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i)).remove();
		i--;
		}
	});
});

</script>
@endpush


