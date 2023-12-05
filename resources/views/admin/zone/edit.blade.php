<div class="card">
    <div class="card-header">
        <h6>{{_lang('Edit Zone  - ')}} <span class="badge badge-primary">{{$model->zone}} </span>
        </h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.zone.update', $model->id)}}" method="post" class="ajax_form">
            @csrf
            @method('PATCH')
            <div class="row">
                {{-- Zone Name --}}
                <div class="col-md-12 form-group">
                    <label for="calender">{{_lang('Zone Name')}}
                    </label>
                    <span class="text-danger">*</span>
                    <input type="text" name="zone" id="zone" class="form-control" placeholder="Type Zone Name" required
                        value="{{$model->zone}}">
                </div>

                {{-- Thana Name --}}
                <div class="col-md-12 form-group">
                    <label for="area">{{_lang('Area Name')}}
                    </label><span class="text-danger">*</span>

                    <select name="area[]" id="area" class="form-control select" multiple
                        data-placeholder="Please Select One..">
                        <option value="">Please Select One ..</option>
                        @foreach ($areas as $ar)
                        <option value="{{$ar->id}}" @foreach ($model->zone_areas as $zone_area)  {{$zone_area->area->id ==$ar->id ? "selected": ""}} @endforeach >
                            {{$ar->area.', '.$ar->thana.', '.$ar->district}}
                        </option>
                        @endforeach
                    </select>
                </div>





                @can('zone.create')
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
