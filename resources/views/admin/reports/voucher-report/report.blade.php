
<br>
 <hr>

 <div id="print_table" style="color:black">
     <span class="text-center">
         <h3><b class="text-uppercase">Faith Saving and Credit Co-Operative Society Ltd.</b></h3>
         <h5>Address</h5>

     </span>
     <div class="text-center col-md-12">
         <h4
             style="margin:0px ; margin-top: 5px; border:solid 1px #000; border-radius:50px; display:inline-block; padding:10px;">
             <b>INCOME & EXPENCE INVOICE</b></h4>
     </div>
     <br>
     <div class="table-responsive">
         <table class="table">
             <tbody>
                 <tr>
                     <td>

                         <p style="margin:0px ; margin-top: -8px;">
                             Report Of Date : <span class="ml-1">10-03-2020</span>  <span class="badge badge-danger mx-2"> TO </span>
                             13-03-2020 </p>

                     </td>
                     <td class="text-center">

                     </td>
                     <td class="text-right">
                         <p style="margin:0px ; margin-top: -8px;">Printing Date :
                             <span></span> {{ date('d F, Y') }} </span></p>
                         <p style="margin:0px ; margin-top: -4px;">Time : <span></span>{{date('h:i:s A')}}</span></p>
                     </td>
                 </tr>

             </tbody>
         </table>
     </div>


     <div class="table-responsive border-dark">
         <table class="table table-bordered ">
             <thead class="table-head-bg">
                 <tr>
                     <th scope="col">Sl No</th>
                     <th scope="col">Invoice Type</th>
                     <th scope="col">Zone Name</th>
                     <th scope="col">Name</th>
                     <th scope="col">Designation</th>
                     <th scope="col">Phone no</th>
                     <th scope="col">Amount</th>
                     <th scope="col">Date</th>
                 </tr>
             </thead>
             <tbody>

                 <tr>
                     <td class="borde-dark">01</td>
                     <td>icnome</td>
                     <td>Raj</td>
                     <td>Sohag</td>
                     <td>soft eng</td>
                     <td>01753474401</td>
                     <td>500</td>
                     <td>12-03-2020</td>
                 </tr>
                 <tr>
                     <td colspan="8" align="center" style="color:red">No Record Found</td>
                 </tr>
                 <tr>
                     <td colspan="6" align="right">Total Buy Invoice Amount</td>
                     <td colspan="2" style="text-align:left">'500</td>

                 </tr>
             </tbody>
         </table>

     </div>
     <br>
     <br><br>

     <div class="row">
         <div class="col-md-4 text-center">
             <hr class="border-dark">
             <p> Prepered By </p>
         </div>
         <div class="col-md-4 text-center">
             <hr class="border-dark">
             <p> Officer </p>
         </div>
         <div class="col-md-4 text-center">
             <hr class="border-dark">
             <p> Officer </p>
         </div>
     </div>


 </div>
 <div>
     @php
     $print_table = 'print_table';

     @endphp

     <a class="text-light btn-success btn" onclick="printContent('{{ $print_table }}')" name="print" id="print_receipt">
         <i class="fa fa-print" aria-hidden="true"></i>
         {{_lang('Print Voucher')}}

     </a>

 </div>
