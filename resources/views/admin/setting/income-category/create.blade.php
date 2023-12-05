<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Income Category')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.income-category.store')}}" method="post" id="content_form">
            @csrf
            <div class="row">
                {{-- Income Category Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Income Category Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control"
                        placeholder="Enter income Category Name" required>
                </div>
                {{-- Income Category Code --}}
                <div class="col-md-6 form-group">
                    <label for="code">{{_lang('income Category Code')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="code" id="code" class="form-control"
                        placeholder="Enter Income Category Code" required>
                </div>
        
                {{-- Income Category Description --}}
                <div class="col-md-12 form-group">
                    <label for="description">{{_lang('income Category Description')}}
                    </label>
                    <textarea name="description" class="form-control" id="description"
                        placeholder="Enter Income Category Description"></textarea>
        
                </div>
        
                @can('income_category.create')
                    <div class="form-group col-md-12" align="right">
                        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i class="icon-arrow-right14 position-right"></i></button>
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}<img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                @endcan
            </div>
        </form>
    </div>
</div>