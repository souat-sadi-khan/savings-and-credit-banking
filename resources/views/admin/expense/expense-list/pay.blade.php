<form action="{{route('admin.expense-list.submit-pay', $model->id)}}" method="post" id="content_form">
    @csrf
     @method('PATCH')
     <div class="row">

        


        {{-- expense Amount --}}
        <div class="col-md-6 form-group">
            <label for="current_due">{{_lang('Expense Amount')}}
               
            </label>
            <input type="number" min="0" readonly  name="current_due" id="current_due" placeholder="Expense Amount"
                class="form-control" value="{{$model->due_amt}}">
        </div>

        {{-- New Paid Amount --}}
        <div class="col-md-6 form-group">
            <label for="new_pay">{{_lang('Payment Amount')}}
                <span class="text-danger">*</span>
            </label>
            <input type="number" min="0" required name="new_pay" id="new_pay" placeholder="Enter New Payment Amount"
                class="form-control" value="0" >
        </div>



        {{-- Due Amount --}}
        <div class="col-md-6 form-group">
            <label for="new_due_amt">{{_lang('Due Amount')}}
                <span class="text-danger">*</span>
            </label>
            <input type="number" min="0" readonly  name="new_due_amt" id="new_due_amt" placeholder="Due Amount"
                class="form-control" value="{{$model->due_amt}}">
        </div>

           {{-- Reference No --}}
        <div class="col-md-6 form-group">
            <label for="reference_no">{{_lang('Reference No')}}
            </label>
            <input type="text" name="reference_no" placeholder="Enter Reference No" class="form-control">
        </div>


        {{-- payment Date --}}
        <div class="col-md-6 form-group">
            <label for="payment_date">
                {{_lang('Payment Date')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required readonly name="payment_date" id="payment_date" placeholder="Enter income Date" class="form-control date" value="{{ date('d/m/Y') }}" >
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


 $(document).on('keyup blur', '#new_pay', function () {

      $("#new_due_amt").val(calculate_due());
    });


function calculate_due() {
    var current_due = parseInt(check_null($("#current_due").val()));
    var new_pay = parseInt(check_null($("#new_pay").val()));

    var due = current_due - new_pay;

    if (due < 0) {
        $("#new_pay").val('');
        swal("Remember!", "Paid Amount Cannot be Greater Than The Due Amount.", "error");
        return current_due
    } else {
        return due;
    }
}

function null_check(value) {
    if (value == null || value == '' || isNaN(value)) {
        return 0;
    } else {
        return value;
    }
}
</script>