<form action="{{route('admin.expense-list.update', $model->id)}}" method="post" id="content_form">
    @csrf
     @method('PATCH')
     <div class="row">

        {{-- Expense Name --}}
        <div class="col-md-6 form-group">
            <label for="expense_category_id">{{_lang('Expense Type')}} <span class="text-danger">*</span>
            </label>

            <select name="expense_category_id" required id="expense_category_id" class="from-control select"
                data-placeholder="Please Select One.." data-parsley-errors-container="#expense_category_id_error">
                <option value="">Please Select One .. .. </option>

                @foreach ($expense_categories as $expense_category)
            <option value="{{$expense_category->id}}" {{ $model->expense_category_id == $expense_category->id?'selected':''}}>{{$expense_category->name}}</option>
                @endforeach

            </select>
            <span id="expense_category_id_error"></span>
        </div>

        {{-- Reference No --}}
        <div class="col-md-6 form-group">
            <label for="reference_no">{{_lang('Reference No')}}
            </label>
        <input type="text" name="reference_no" placeholder="Enter Reference No" class="form-control" value="{{$model->reference_no}}">
        </div>

        {{-- Expense Amount --}}
        <div class="col-md-6 form-group">
            <label for="expense_amt">{{_lang('Expense Amount')}}
                <span class="text-danger">*</span>
            </label>
            <input type="number" min="0" required name="expense_amt" id="expense_amt" placeholder="Expense Amount"
                class="form-control" value="{{$model->expense_amt}}">
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


        {{-- Expense For --}}
        <div class="col-md-6 form-group">
            <label for="expense_for">
                {{_lang('Expense For')}}
            </label>
            <select name="expense_for" required id="expense_for" class="from-control select"
                date-placeholder="Please Select One.." data-parsley-errors-container="#expense_for_error">
                <option value="">Please Select One .. .. </option>
                @foreach ($employees as $employee)
                <option value="{{$employee->id}}" {{ $model->expense_for == $employee->id?'selected':''}}>{{$employee->name}}</option>
                @endforeach
            </select>
            <span class="text-danger" id="expense_for_error"></span>
        </div>


        {{-- Expense Date --}}
        <div class="col-md-6 form-group">
            <label for="expense_date">
                {{_lang('Expense Date')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required readonly name="expense_date" id="expense_date" placeholder="Enter Expense Date" class="form-control date" value="{{ Carbon\Carbon::createFromFormat('Y-m-d', $model->expense_date)->format('d/m/Y')}}">
        </div>

    
        {{-- Expense Note --}}
        <div class="col-md-6 form-group">
            <label for="expense_note">
                {{_lang('Expense Note')}}
               
            </label>
         
                <textarea  name="expense_note" id="expense_note"  class="form-control">{{$model->expense_note}}</textarea>
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