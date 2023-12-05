<form action="{{route('admin.savings-account.update', $model->id)}}" method="post" id="content_form">
    @csrf
     @method('PATCH')
     <div class="row">
        <div class="col-md-12">
            <hr>
            <h3 class="text-center">Member And Account Information</h3>
            <hr>
        </div>
        {{-- Select Member --}}
        <div class="col-md-6 form-group">
            <label for="service_name">{{_lang('Select Member')}} <span class="text-danger">*</span>
            </label>

        <select name="member_id" id="member_id"  data-url="{{ route('admin.savings-account.member-info') }}" class="form-control" data-placeholder="Please Select One .." required data-parsley-errors-container="#member_id_error">
                <option value="">Please Select One ..</option>
                @foreach ($members as $member)
            <option value="{{$member->id}}" {{($member->id==$model->member->id)?'selected':''}}>{{ $member->name_in_bangla.', '.$member->contact_number }}</option>
                @endforeach
            </select>
                        <span id="member_id_error"></span>

        </div>
        {{-- Select Member --}}
        <div class="col-md-6 form-group">

        <div align="center"><img src="{{asset('storage/member/'.$model->member->photo)}}" id="member_image" width="180" class="rounded img-thumbnail"></div>
        </div>
            

            {{-- Member  Address --}}
            <div class="col-md-6 form-group mamber_info"  style="display:non">
                <label for="member_permanent_address">{{_lang(' Address')}}
                </label>
                <div class="input-group">

                    <textarea name="member_permanent_address" id="member_permanent_address"
                style="width:100%">Father: {{$model->member->father_name}}, Address: {{$model->member->present_address_line_1}}</textarea>
                </div>
            </div>


        <div class="col-md-3 form-group">
            <label for="prefix">{{_lang('Account Prefix')}} </label>
            <div class="input-group">
            <input type="text" class="form-control" readonly id="prefix" name="prefix" value="{{$model->prefix}}">
            </div>
        </div>
        <div class="col-md-3">
            <label for="code">{{_lang('Account Code')}} </label>
            <div class="input-group">
            <input type="text" readonly class="form-control" id="code" name="code" value="{{numer_padding($model->code, get_option('digits_savings_account_code'))}}">
            </div>
        </div>




        <div class="col-md-12">
            <hr>
            <h3 class="text-center">Nomenee Information</h3>
            <hr>
        </div>

        {{-- Nomenee Name --}}
        <div class="col-md-6 form-group">
            <label for="nomenee_name">{{_lang('Name')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required name="nomenee_name" placeholder="Enter Nomenee Name" class="form-control" value="{{$model->nomenee_name}}">
        </div>

        {{-- Nomenee Father's Name --}}
        <div class="col-md-6 form-group">
            <label for="nomenee_fathers_name">{{_lang('Father\'s Name')}}
            </label>
            <div class="input-group">
                <input type="text"  name="nomenee_fathers_name" placeholder="Enter Father Name" class="form-control" value="{{$model->nomenee_fathers_name}}">
            </div>
        </div>



        {{-- Nomenee Husband's Name --}}
        <div class="col-md-6 form-group">
            <label for="nomenee_husbands_name">{{_lang('Husband\'s Name')}}
            </label>
            <div class="input-group">
                <input type="text"  name="nomenee_husbands_name" placeholder="Enter Husband Name"
                    class="form-control"  value="{{$model->nomenee_husbands_name}}" >
            </div>
        </div>

        {{-- Nomenee Relation with mamber --}}
        <div class="col-md-6 form-group">
            <label for="nomenee_relation_with_member">{{_lang('Relation With Member')}}

                <span class="text-danger">*</span>
            </label>
                <input type="text" required name="nomenee_relation_with_member" placeholder="Enter Relation With Member"
                    class="form-control"  value="{{$model->nomenee_relation_with_member}}" >
        </div>

        {{-- Nomenee Present Address --}}
        <div class="col-md-6 form-group">
            <label for="nomenee_present_address">{{_lang('Present Address')}}
            </label>
            <div class="input-group">

                <textarea name="nomenee_present_address" id="nomenee_present_address"
                    placeholder="Enter Present Address" style="width:100%"> {{$model->nomenee_present_address}} </textarea>
            </div>
        </div>

        {{-- Nomenee Permanent Address --}}
        <div class="col-md-6 form-group">
            <label for="nomenee_permanent_address">{{_lang('Permanent Address')}}
                <span class="text-danger">*</span>
            </label>
            <div class="input-group">

                <textarea name="nomenee_permanent_address" id="nomenee_permanent_address"
                    placeholder="Enter Permanent Address" style="width:100%"> {{$model->nomenee_permanent_address}}</textarea>
            </div>
        </div>




        <div class="col-md-12">
            <hr>
            <h3 class="text-center">Identifier's Information</h3>
            <hr>
        </div>

        {{-- identifier Name --}}
        <div class="col-md-6 form-group">
            <label for="identifier_name">{{_lang('Name')}}
                <span class="text-danger">*</span>
            </label>
                <input type="text" required name="identifier_name" placeholder="Enter Identifier Name" class="form-control" value="{{$model->identifier_name}}" >
        </div>

        {{-- identifier Father's Name --}}
        <div class="col-md-6 form-group">
            <label for="identifier_fathers_name">{{_lang('Father\'s Name')}}
            </label>
            <div class="input-group">
                <input type="text"  name="identifier_fathers_name" placeholder="Enter Father Name" class="form-control" value="{{$model->identifier_fathers_name}}">
            </div>
        </div>



        {{-- identifier Husband's Name --}}
        <div class="col-md-6 form-group">
            <label for="identifier_husbands_name">{{_lang('Husband\'s Name')}}
            </label>
            <div class="input-group">
                <input type="text" name="identifier_husbands_name" placeholder="Enter Husband Name"
                    class="form-control" value="{{$model->identifier_husbands_name}}">
            </div>
        </div>

        {{-- identifier age --}}
        <div class="col-md-6 form-group">
            <label for="identifier_age">{{_lang('Age')}}
                <span class="text-danger">*</span>
            </label>
                <input type="text" required name="identifier_age" placeholder="Enter Age" class="form-control" value="{{$model->identifier_age}}">
        </div>

        {{-- identifier Present Address --}}
        <div class="col-md-6 form-group">
            <label for="identifier_present_address">{{_lang('Present Address')}}
            </label>
            <div class="input-group">

                <textarea name="identifier_present_address" id="identifier_present_address"
            placeholder="Enter Present Address" style="width:100%">{{$model->identifier_present_address}}</textarea>
            </div>
        </div>

        {{-- identifier Permanent Address --}}
        <div class="col-md-6 form-group">
            <label for="identifier_permanent_address">{{_lang('Permanent Address')}}
                <span class="text-danger">*</span>
            </label>
            <div class="input-group">

                <textarea name="identifier_permanent_address" required id="identifier_permanent_address"
                    placeholder="Enter Permanent Address" style="width:100%">{{$model->identifier_permanent_address}}</textarea>
            </div>
        </div>






        {{-- Active Status --}}
        <div class="col-md-12 form-group">
            <label for="status">{{_lang('Active Status')}}
                <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <select name="status" id="status" required data-placeholder="Please Select One.." class="form-control select">
                    <option value="">Please Select One .. </option>
                    <option value="Active" {{ $model->status == 'Active'?"selected":"" }}>Active</option>
                    <option value="Inactive" {{ $model->status == 'Inactive'?"selected":"" }}>Inactive</option>
                </select>
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

<script>
    $('.select').select2({  width: '100%' });

    $(document).on('change','#member_id',function(){
            var member_id = $(this).val(); 
            // alert(member_id);
            var url  = $(this).data('url');
            $("#member_permanent_address").val('');
            $("#member_image").attr('src',"");
            
            $.ajax({
                    url: url,
                    data: {member_id:member_id},
                    type: 'Get',
                    dataType: 'json',
                    success:function(data){
                        $("#member_permanent_address").val('Father: '+data.member_info.father_name+', Address: '+data.member_info.present_address_line_1);
                        $("#member_image").attr('src',data.image);
                        console.log(data.image);
                        
                    }
                }) 
        });

</script>