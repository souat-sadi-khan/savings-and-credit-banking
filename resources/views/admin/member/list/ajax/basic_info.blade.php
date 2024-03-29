<div class="row p-4">
    <div class="col-md-12">
        <form action="{{route('admin.member.basic_info.update')}}" id="content_form" method="POST">
            @csrf 
        
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="prefix">{{_lang('Prefix & Code')}} <span class="text-danger">*</span>
                    </label>
                    <div class="row">
                        <div class="col-md-4"><input readonly type="text" name="prefix" id="prefix" class="form-control" placeholder="Prefix" value="{{$model->prefix}}"  required></div>
                        <div class="col-md-8"> <input readonly type="text" name="code" id="code" class="form-control" placeholder="Code Here" required value="{{$model->code}}"></div>
                    </div>
                </div>
        
                {{-- Name In Bangla--}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Name In Bangla')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name_in_bangla" id="name_in_bangla" class="form-control"
                    placeholder="Enter Name In Bangla" required value="{{$model->name_in_bangla}}">
                </div>

                {{-- Name In English --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Name In English')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name_in_english" id="name_in_english" class="form-control"
                    placeholder="Enter Name In English" value="{{$model->name_in_english}}">
                </div>
        
                {{-- Date Of Birth --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Date Of Birth')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" autocomplete="off" readonly="" name="date_of_birth" id="date_of_birth" class="form-control date"  value="{{$model->date_of_birth}}">
                </div>

                {{-- Date Of Anniversary --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Date Of Anniversary')}}
                    </label>
                    <input type="text" name="date_of_anniversary" autocomplete="off" readonly="" id="date_of_anniversary" class="form-control date"  value="{{$model->date_of_anniversary}}">
                </div>
        
                {{-- Gender --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Gender')}} <span class="text-danger">*</span>
                    </label>
                    
                    <select data-placeholder="Please Select One" name="gender" id="gender" class="form-control select" required>
                        <option value="">Please Select One..</option>
                        <option {{$model->gender == 'Male' ? 'selected' : ''}} value="Male">Male</option>
                        <option {{$model->gender == 'Female' ? 'selected' : ''}} value="Female">Female</option>
                    </select>
                </div>    
        
                {{-- Marital Status --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang(' Marital Status')}}
                    </label>
                    
                    <select data-placeholder="Please Select One" name="marital_status" id="marital_status" class="form-control select" >
                        <option value="">Please Select One..</option>
                        <option {{$model->marital_status == 'Unmarried' ? 'selected' : ''}} value="Unmarried">Unmarried</option>
                        <option {{$model->marital_status == 'Married' ? 'selected' : ''}} value="Married">Married</option>
                        <option {{$model->marital_status == 'Separete' ? 'selected' : ''}} value="Separete">Separete</option>
                        <option {{$model->marital_status == 'Divorced' ? 'selected' : ''}} value="Divorced">Divorced</option>
                        <option {{$model->marital_status == 'Widow' ? 'selected' : ''}} value="Widow">Widow</option>
                    </select>
                </div>

                {{-- Nationality --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Nationality')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_error_select_nationality_for_update_member"
                        name="nationality" data-placeholder="Please Select One.." class="form-control select"
                        id="nationality" required>
                        <option value="">Please Select One..</option>
                        @foreach($nationality as $item){
                        <option {{$model->nationality_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                        }
                        @endforeach
                    </select>
                    <span id="parsley_error_select_nationality_for_update_member"></span>
                </div>

                {{-- Religious --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Religious')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_error_select_religious_for_update_member"
                        name="religious" data-placeholder="Please Select One.." class="form-control select"
                        id="religious" required>
                        <option value="">Please Select One..</option>
                        @foreach($religious as $item){
                        <option {{$model->religious_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                        }
                        @endforeach
                    </select>
                    <span id="parsley_error_select_religious_for_update_member"></span>
                </div>

                {{-- Occupation --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Occupation')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_error_select_occupation_for_update_member"
                        name="occupation" data-placeholder="Please Select One.." class="form-control select"
                        id="occupation" required>
                        <option value="">Please Select One..</option>
                        @foreach($occupation as $item){
                        <option {{$model->occupation_id == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                        }
                        @endforeach
                    </select>
                    <span id="parsley_error_select_occupation_for_update_member"></span>
                </div>
        
                {{-- Father Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Father Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="father_name" id="father_name" class="form-control"
                    placeholder="Enter Father Name" required value="{{$model->father_name}}">
                </div>
        
                {{-- Mother Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Mother Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="mother_name" id="mother_name" class="form-control"
                    placeholder="Enter Mother Name" required value="{{$model->mother_name}}" >
                </div>
        
                <div class="form-group col-md-12" align="right">
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update')}}<i class="icon-arrow-right14 position-right"></i></button>
                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                </div>
                
            </div>
        </form>
    </div>
</div>

<script>
    $('.select').select2({ width: '100%' });
    _formValidation();
    _componentDatefPicker();
</script>