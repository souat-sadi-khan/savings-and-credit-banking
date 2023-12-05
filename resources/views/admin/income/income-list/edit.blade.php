<form action="{{route('admin.income-list.update', $model->id)}}" method="post" id="content_form">
    @csrf
     @method('PATCH')
     <div class="row">

        {{-- income Name --}}
        <div class="col-md-6 form-group">
            <label for="income_category_id">{{_lang('income Type')}} <span class="text-danger">*</span>
            </label>

            <select name="income_category_id" required id="income_category_id" class="from-control select"
                data-placeholder="Please Select One.." data-parsley-errors-container="#income_category_id_error">
                <option value="">Please Select One .. .. </option>

                @foreach ($income_categories as $income_category)
            <option value="{{$income_category->id}}" {{ $model->income_category_id == $income_category->id?'selected':''}}>{{$income_category->name}}</option>
                @endforeach

            </select>
            <span id="income_category_id_error"></span>
        </div>

        {{-- Reference No --}}
        <div class="col-md-6 form-group">
            <label for="reference_no">{{_lang('Reference No')}}
            </label>
        <input type="text" name="reference_no" placeholder="Enter Reference No" class="form-control" value="{{$model->reference_no}}">
        </div>

        {{-- income Amount --}}
        <div class="col-md-6 form-group">
            <label for="income_amt">{{_lang('income Amount')}}
                <span class="text-danger">*</span>
            </label>
            <input type="number" min="0" required name="income_amt" id="income_amt" placeholder="income Amount"
                class="form-control" value="{{$model->income_amt}}">
        </div>

        {{-- Paid Amount --}}
        <div class="col-md-6 form-group">
            <label for="paid_amt">{{_lang('Paid Amount')}}
                <span class="text-danger">*</span>
            </label>
            <input type="number" min="0" required name="paid_amt" id="paid_amt" placeholder="Paid Amount"
                class="form-control" value="{{$model->paid_amt}}" >
        </div>



        {{-- Due Amount --}}
        <div class="col-md-6 form-group">
            <label for="due_amt">{{_lang('Due Amount')}}
                <span class="text-danger">*</span>
            </label>
            <input type="number" min="0" readonly required name="due_amt" id="due_amt" placeholder="Due Amount"
                class="form-control" value="{{$model->due_amt}}">
        </div>

        {{-- income Date --}}
        <div class="col-md-6 form-group">
            <label for="income_date">
                {{_lang('income Date')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required readonly name="income_date" id="income_date" placeholder="Enter income Date" class="form-control date" value="{{ Carbon\Carbon::createFromFormat('Y-m-d', $model->income_date)->format('d/m/Y')}}">
        </div>

    
        {{-- income Note --}}
        <div class="col-md-12 form-group">
            <label for="income_note">
                {{_lang('income Note')}}
               
            </label>
         
                <textarea  name="income_note" id="income_note"  class="form-control">{{$model->income_note}}</textarea>
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
 _componentDatePicker();
</script>