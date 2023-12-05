<div class="card">
    <div class="card-header">
        <h6>{{_lang('Edit Area  - ')}} <span class="badge badge-primary">{{$model->area}} </span>
        </h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.area.update', $model->id)}}" method="post" class="ajax_form">
            @csrf
            @method('PATCH')
            <div class="row">
                        {{-- Area Name --}}
                        <div class="col-md-12 form-group">
                            <label for="area">{{_lang('Area Name')}}
                            </label>
                            <span class="text-danger">*</span>
                        <input type="text" name="area" id="area" class="form-control" placeholder="Type Area Name"  required value="{{$model->area}}">
                        </div>

                       

                        {{-- Thana Name --}}
                        <div class="col-md-12 form-group">
                            <label for="thana">{{_lang('Thana Name')}}
                            </label>
                            <span class="text-danger">*</span>
                            <input type="text" name="thana" id="thana" class="form-control" placeholder="Type District Name"  required value="{{$model->thana}}">
                        </div>

                         {{-- District Name --}}
                        <div class="col-md-12 form-group">
                            <label for="district">{{_lang('District Name')}}
                            </label>
                            <span class="text-danger">*</span>
                            <input type="text" name="district" id="district" class="form-control" placeholder="Type District Name"  required value="{{$model->district}}">
                        </div>

                @can('area.update')
                <div class="form-group col-md-12" align="right">
                    {{-- <input type="hidden" name="type[]" value=" "> --}}
                    <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i
                            class="icon-arrow-right14 position-right"></i></button>
                    <button type="button" class="btn btn-link" id="submiting"
                        style="display: none;">{{_lang('Processing')}}<img src="{{ asset('ajaxloader.gif') }}"
                            width="80px"></button>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
                </div>
                @endcan
            </div>
        </form>
    </div>
</div>

<script>

</script>
