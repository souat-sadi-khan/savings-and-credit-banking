@extends('layouts.app', ['title' => _lang('Sundry Withdraw'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')

<style>
    .table th,
    .table td {
        padding: 0.40rem 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

</style>
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Sundry Withdraw "><i class="fa fa-users mr-4"></i>
            {{_lang('Sundry Withdraw Of Loan From Member ')}}</h1>
        <p>{{_lang('Here You Can Withdraw Sundry Amount Of Loan From Member')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render('loan-repay') }} --}}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <div class="col-md-12" style="margin-top:-10px">
            <hr>
            <h4 class="text-center text-info">Sundry Withdraw: <span class="text-danger">{{$sundry_month}}</span>
            </h4>
            <hr>
        </div>
        <div class="col-md-12">
             <form action="{{route('admin.sundry-withdraw.store')}}" method="post" id="content_form">
            @csrf

           <table class="table table-bordered table-secondary" >
  <thead >
    <tr class="bg-dark text-light text-center" >
      <th scope="col" style="width:25px;vertical-align:middle;">Sl No</th>
      <th scope="col" style="width:200px;vertical-align:middle;">AC No</th>
      <th scope="col"style="vertical-align:middle;" >Member</th>
      <th scope="col" style="width:200px;vertical-align:middle;">Sundry Amount</th>
    </tr>
  </thead>
  <tbody class="bg-info">
      @php
          $i = 0;
          $j=0;
          if ($sundry_info['exist']) {
              # code...
              $no_of_accounts = count($sundry_info['info']);
          }
          
      @endphp
      @if ($sundry_info['exist'])
          
      
      @for ($i=0; $i < $no_of_accounts; $i++)
          @php
              $id = $sundry_info['info'][$i]->id;
              $account_no = get_id_account_no('fdr',$sundry_info['info'][$i]->prefix,$sundry_info['info'][$i]->code);
              $member_ac = '';
              foreach ($sundry_info['info'][$i]->fdrMember as   $value) {
             
                // dd($value->member);
                  $member_ac .= get_id_account_no('member',$value->member->prefix,$value->member->code).', '.$value->member->name_in_bangla.', '.$value->member->contact_number.'  ';
              }
              $sundry_amt = $sundry_info['amt'][$i];
            //   $member_id = $sundry_info['info'][$i]->member->id;
          @endphp
      <tr >
        <th scope="row">{{ ++$j }}</th>
        <input type="hidden" readonly name="sundry_type" id="id" class="form-control"  value="{{ $sundry_type }}">
        <input type="hidden" readonly name="id[]" id="id" class="form-control"  value="{{ $id }}">
         <input type="hidden" readonly name="member_id[]" id="member_id" class="form-control"  value="">
        <td><input type="text" readonly name="account_no[]" id="account_no" class="form-control" placeholder="Share Account No" value="{{ $account_no }}"></td>
        <td><input type="text" readonly name="member[]" id="member" class="form-control" placeholder="Member ID"  value="{{ $member_ac }}"></td>
        <td><input type="text" name="submitted_amt[]" id="submitted_amt" class="form-control" placeholder="Sundry Amount" required value="{{ $sundry_amt }}"></td>
        <input type="hidden" name="calculated_amt[]" id="calculated_amt" class="form-control" placeholder="Sundry Amount" required value="{{ $sundry_amt }}">
      </tr>
      @endfor
         <tr>
        <td colspan="3" class="text-right text-light"><h4 >Total Withdrawable Amount Of Loan From Member</h4></td>
        <td class="text-light"><h4>{{ $sundry_info['total'] }}</h4></td>
    </tr>
    @else 
    <tr>
        <td colspan="4" class="text-center text-light"><h4 >No Withdrawable Amount Of Loan From Member Found</h4></td>
      </tr>
      @endif

 
   

  </tbody>
</table>

@if ($sundry_info['exist'])
    
<div class="row">
    <div class="col-md-6">
         <h5>In Words: {{ucwords(convert_number_to_words($sundry_info['total']))}} Taka Only.</h5>
         {{-- <h5>In Words: Five Hundred Taka Only</h5> --}}
        
        <br><br><br><br>
    </div>
  


    <div class="form-group col-md-6" align="right">
        {{-- <input type="hidden" name="type[]" value=" "> --}}
        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
                class="icon-arrow-right14 position-right"></i></button>
        <button type="button" class="btn btn-link" id="submiting"
            style="display: none;">{{_lang('Processing')}}
            <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
    </div>
</div>
@endif

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
<script src="{{ asset('js/pages/loan_repay.js') }}"></script>

<script>
    $('.select').select2({
        width: '100%'
    });

    $(document).ready(function () {
        // $('#example').DataTable();

        $('#example').DataTable({
            "searching": false,
            "lengthChange": false,
            "pageLength": 15
        });

    });

</script>


@endpush
