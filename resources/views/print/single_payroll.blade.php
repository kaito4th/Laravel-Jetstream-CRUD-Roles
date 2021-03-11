<style>

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 11px;
}

th, td {
  padding: 0.1rem;
  text-align: left;
  border: 1px solid #ccc;
}

tr:nth-child(even) {background-color: #f2f2f2;}

hr{
    margin: 0;
    border: 1.5px dashed;
}
</style>
<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8" style="page-break-after: always; @media print and (width: 8.5in) and (height: 5in) {
  @page {
     size: 8.5in 5in portrait;
  }
 }">
                        <div class="">
                            <table class="table-auto">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8 bg-gray-10 font-bold font-sans text-center" style="font-size: 15px; text-align: center;">
                                DRC DREAMS BUILDERS AND CONSTRUCTION, INC.
                            </div>
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8 bg-gray-10 font-bold font-sans text-center" style="font-size: 13px; text-align: center; padding: 0.5rem 0rem 0.5rem 0rem;">
                                Payroll for the Period of {{date('d-m-Y', strtotime($task->start))}} - {{date('d-m-Y', strtotime($task->end))}}
                            </div>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'I.D Number' }}
                                        </td>

                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                        {{ $user->user_id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

       
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'Name' }}
                                        </td>

                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                        {{ $user->name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'Daily Rate' }}
                                        </td>

                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                        {{ $rates->daily_rate }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                        
                                        </td>
                                    </tr>
                                <tr>
                                    <th scope="col" width="50" style="font-size:13px; font-weight:bold"  class="px-6 py-3 bg-gray-50 text-left text-xs text-black font-bold uppercase tracking-wider">
                                        Gross Pay
                                    </th>
                                </tr>
                                    <tr>
                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'Basic Pay' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                        {{ $total_grosses->basic_pay }}
                                        </td>
                                    </tr>
                                
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'Regular Day' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $attendances->regular_day }}&nbsp day(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'Half Day' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $attendances->half_day }} &nbsp day(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                            {{ $total_grosses->total_half_pay }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'SUN/SPL/Legal' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $attendances->sunday }} &nbsp day(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                            {{ $total_grosses->total_spl_pay }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'Allowance' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                        {{ $total_increases->total_increase }}
                                        </td>
                                    </tr>

                                    <!-- <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                            {{ 'Total No. of Days Present' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                        {{ $attendances->attendance_count }}&nbsp day(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>
                                    </tr> -->

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                            {{ 'Total O.T on Regular Day' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                        {{ $total_ot }} hr(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                            {{ $total_grosses->total_ot_pay }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                            {{ 'Total O.T on SUN/SPL/Legal' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                        {{ $total_sot }} hr(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                            {{ $total_grosses->total_sot_pay }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold font-medium">
                                            {{ 'Total Gross Pay' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                        
                                        </td>

                                        <td style="color: #96a505; font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-black-900 font-bold text-xs rounded-full bg-yellow-200">
                                            {{ $total_grosses->total_gross }}
                                        </td>
                                    </tr>

                                <tr>
                                    <th scope="col" width="50" style="font-size:13px; font-weight:bold" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black font-bold uppercase tracking-wider">
                                        Deductions
                                    </th>
                                </tr>

                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'SSS Premium' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $deductions->SSS_premium }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'SSS Loan' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $deductions->SSS_loan }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'Philhealth' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $deductions->philhealth }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'PAG-IBIG' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $deductions->pagibig }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'PAG-IBIG Loan' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $deductions->pagibig_loan }}
                                        </td>
                                    </tr>

                                <tr>
                                    <th scope="col" width="50" style="font-size:13px; font-weight:bold" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black font-bold uppercase tracking-wider">
                                        Other Deductions
                                    </th>
                                </tr>

                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ 'Late' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $total_late }} hr(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $total_late_deduct }}
                                        </td>
                                    </tr>
                            @foreach ($other_deduct as $others)
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $others->deduction_remarks }}&nbsp&nbsp ({{ $others->deduction_date }} - {{ $others->deduction_day }})
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                            {{ $others->deduction_value }}
                                        </td>
                                    </tr>
                            @endforeach
                                    <tr>
                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold font-medium">
                                            {{ 'Total Deduction' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                        
                                        </td>

                                        <td style="color: #c21502; font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-s text-black-900 font-bold rounded-full bg-red-300">
                                            {{ $total_deduct->total_deduction }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-s text-green-900 font-bold font-medium">
                                            {{ 'Net Pay' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-900 font-bold">
                                        
                                        </td>

                                        <td style="color: #137d08; font-size:13px; font-weight:bold" class="px-6 py-4 whitespace-nowrap text-s text-black-900 font-bold rounded-full bg-green-300">
                                            {{ $netpay->netpay }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <!-- <hr style="margin: 9px 0 9px 0;">                 -->
<script type="text/javascript">
    window.onload = function() { window.print(); }
    window.onafterprint = function(){
        window.close();
  // console.log("Printing completed...");
}

</script> 