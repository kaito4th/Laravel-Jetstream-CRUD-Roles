<!-- <link rel="stylesheet" href="{{ url('/payroll-tabs.css') }}"> -->
<style>
/* *{
    box-sizing: border-box;
}

body{
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif; 
    font-size: 16px;
    line-height: 1.6;
}

.container{
    max-width: 800px;
    margin: 50px auto;
}

.tab-trigger{
    /*margin: 0;*/
}

.tab-trigger ul{
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
}

.tab-trigger ul li{
    /*margin: 0;*/
}

.tab-trigger ul li label{
    position: relative;
    display: block;
    margin: 0.1rem;
    padding: 8px 15px;
    cursor: pointer;
    min-width: 100px;
    text-align: center;
    font-weight: 700;
    background-color: bisque;
    border-radius: 8px 8px 0 0;
}

.tab-trigger ul li:nth-child(1) label{
    background: #56ff75;
}

.tab-trigger ul li:nth-child(2) label{
    background: #56ff75;
}

.tab-trigger ul li:nth-child(3) label{
    background: #56ff75;
}

.tab-trigger ul li:nth-child(4) label{
    background: #56ff75;
}

.tab-trigger ul li:nth-child(5) label{
    background: #56ff75;
}

.tab-container-wrap{

}

.tab-container-wrap div + input{
    position: absolute;
    width: 0;
    height: 0;
    margin:  0;
    z-index: -100;
    top: -10000px;
}

.tab-container-wrap input:checked + .tab-content-box{
    display: block;
}

.tab-content-box{
    background: #f0f0f0;
    padding: 20px;
    display: none;
}

.tab-content-box:nth-of-type(1){
    background: #eff0ee;
}

.tab-content-box:nth-of-type(2){
    background: #eff0ee;
}

.tab-content-box:nth-of-type(3){
    background: #eff0ee;
}

.tab-content-box:nth-of-type(4){
    background: #eff0ee;
}


</style>
<x-app-layout>
    <x-slot name="header">
    <h2 class="ml-20 text-lg leading-7 font-semibold inline-block" style="color:green; font-size: 20px;">{{$user->name}}</h2>'s 
    <h3 class="text-lg leading-7 font-semibold inline-block">Payroll for the period of 
        <div class="text-lg leading-7 font-semibold inline-block" style="color:green; font-size: 26px;">
            {{date('d-m-Y', strtotime($task->start))}} - {{date('d-m-Y', strtotime($task->end))}}
        </div>
    </h3>
    </x-slot>

<div class="container">

    <div class="tab-trigger">
        <ul>
            <li>
                <label for="tab1">Rates</label>
            </li>
            <li>
                <label for="tab2">Attendance</label>
            </li>
            <li>
                <label for="tab3">Deductions</label>
            </li>
            <li>
                <label for="tab4">Allowance</label>
            </li>
            <li>
                <label for="tab5">Payslip</label>
            </li>
        </ul>
    </div>
    <div class="tab-container-wrap">
        <input type="radio" checked id="tab1" name="1">
        <div class="tab-content-box">
            <h3 class="ml-4 text-lg leading-7 font-semibold" style="padding: 0 0 40px 0;">Rates</h3>
            <div style="background-color: white;">
                <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <tbody class="bg-white divide-y divide-gray-200">
                                <!--foreach here-->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Daily Rate' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $rates->daily_rate }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Overtime Pay' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $rates->overtime_pay }} / hour
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Sunday Pay' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ number_format($rates->daily_rate * 1.3,'2','.','') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Sunday Overtime Pay' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $rates->sunday_rate }} / hour
                                        </td>
                                    </tr>
                                <!--endforeach-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <input type="radio" id="tab2" name="1">
        <div class="tab-content-box">
            <h3 class="ml-4 text-lg leading-7 font-semibold">Attendance</h3>
                <form action="/{{$user->user_id}}" method="post">
                @csrf
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Date:</label> 
                    <x-jet-input id="date_att" name="date_att" type="date" style="margin: 0 0 0 2rem;" class="mt-1 inline-block"/>
                        <x-jet-input-error for="date_att" class="mt-2" />
                    <div class="inline" style="padding: 0 5rem 0 0; float: right;">
                        <label style="display: inline;">Special:</label> 
                        <select id="select_special" name="select_special" class="w-36 h-8 rounded-lg border-4 border-light-blue-500 border-opacity-100">
                            <option>--select--</option>
                            <option id="holiday" name="holiday" value="holiday">Holiday</option>
                            <!-- <option id="leave" name="leave" value="leave">Leave w/ Pay</option> -->
                        </select>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Time in:</label> 
                    <x-jet-input id="time_in" name="time_in" type="time" style="margin: 3px 0 0 1rem;" class="mt-1 inline-block"/>
                        <x-jet-input-error for="time_in" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                <label style="display: inline-block;">Time out:</label> 
                    <x-jet-input id="time_out" name="time_out" type="time" style="margin: 3px 0 0 0.5rem;" class="mt-1 inline-block"/>
                        <x-jet-input-error for="time_out" class="mt-2" />
                </div>
                <h3 class="ml-4 text-lg leading-7 font-semibold">Late</h3>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-input id="late" name="late" type="number" class="mt-1 inline-block" wire:model.defer="state.number"/>
                        <x-jet-input-error for="late" class="mt-2" /> Minute(s)
                </div>
                <h3 class="ml-4 text-lg leading-7 font-semibold">Overtime</h3>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-input id="overtime" name="overtime" type="number" class="mt-1 inline-block" wire:model.defer="state.number"/>
                        <x-jet-input-error for="overtime" class="mt-2" /> Hour(s)
                </div>
                <div class="col-span-6 sm:col-span-4">
                <x-jet-button class="ml-4" style="float: right;">
                    Submit
                </x-jet-button>
                </div>
                </form>
                <div style="background-color: white; margin-top: 5rem;">
                <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Day
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Time In
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Time Out
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Remarks
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($attendance_dates as $attendance_date)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $attendance_date->date }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           {{ $attendance_date->day }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $attendance_date->time_in }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $attendance_date->time_out }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           @foreach ($remarks as $remark)
                                                @if ($remark->late != null)
                                                <span class="px-2 inline-block text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $remark->late}} mns late
                                                </span>
                                                    
                                                

                                                @elseif ($remark->late == null)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ ' ' }} 
                                                </span>
                                                

                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <form class="inline-block" action="{{ route('attendance.destroy', ['id'=>$user->user_id, 'iid'=>$attendance_date->id] )}}" method="GET" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" style="box-sizing: unset;" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                </div>
        </div>
        <input type="radio" id="tab3" name="1">
        <div class="tab-content-box">
            <h3 class="ml-4 text-lg leading-7 font-semibold">Deductions</h3>
            <form action="otherdeduction/{{$user->user_id}}" method="post">
                @csrf
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Date:</label> 
                    <x-jet-input id="date_ded" name="date_ded" type="date" style="margin: 0 0 0 2rem;" class="mt-1 inline-block"/>
                        <x-jet-input-error for="date_ded" class="mt-2" />
                    <div class="inline" style="padding: 0 5rem 0 0; float: right;">
                        <label style="display: inline;">Others:</label> 
                        <select id="select_deduct" name="select_deduct" class="w-36 h-8 rounded-lg border-4 border-light-blue-500 border-opacity-100">
                            <option id="default" name="default" value="default">--select--</option>
                            <option id="sss_premium" name="sss_premium" value="sss_premium">SSS Premium</option>
                            <option id="sss_loan" name="sss_loan" value="sss_loan">SSS Loan</option>
                            <option id="pagibig" name="pagibig" value="pagibig">PAG-IBIG</option>
                            <option id="pagibig_loan" name="pagibig_loan" value="pagibig_loan">PAG-IBIG Loan</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Value:</label> 
                    <x-jet-input id="deduction_value" name="deduction_value" style="margin: 3px 0 0 1.65rem;" type="number" step="any" class="mt-1 inline-block"/>
                        <x-jet-input-error for="deduction_value" class="mt-2" />PHP
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Remarks:</label> 
                    <x-jet-input id="deduction_remarks" name="deduction_remarks" type="text" style="margin: 3px 0 0 0.5rem;" class="mt-5 inline-block h-24"/>
                        <x-jet-input-error for="deduction_remarks" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                <x-jet-button class="ml-4" style="float: right;">
                    Submit
                </x-jet-button>
                </div>
            </form>
            <div style="background-color: white; margin-top: 5rem;">
                <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <tbody class="bg-white divide-y divide-gray-200">
                                <!--foreach here-->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'SSS Premium' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->SSS_premium }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'SSS Loan' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->SSS_loan }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Philhealth' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->philhealth }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'PAG-IBIG' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->pagibig }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'PAG-IBIG Loan' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->pagibig_loan }}
                                        </td>
                                    </tr>
                                <!--endforeach-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <h3 class="px-6 py-4 whitespace-nowrap text-xl text-black font-bold font-medium">Other Deductions:</h3>
            <div style="background-color: white; margin-top: .5rem;">
                <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Day
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deduction
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Remarks
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($other_deduct as $other_deduc)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $other_deduc->deduction_date }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           {{ $other_deduc->deduction_day }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $other_deduc->deduction_value }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $other_deduc->deduction_remarks }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <form class="inline-block" action="{{ route('otherdeduction.destroy', ['id'=>$user->user_id, 'iid'=>$other_deduc->id] )}}" method="GET" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" style="box-sizing: unset;" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                </div>
        </div>
        <input type="radio" id="tab4" name="1">
        <div class="tab-content-box">
            <h3 class="ml-4 text-lg leading-7 font-semibold">Allowance</h3>
            <form action="increase/{{$user->user_id}}" method="post">
                @csrf
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Date:</label> 
                    <x-jet-input id="inc_date" name="inc_date" type="date" style="margin: 0 0 0 2rem;" class="mt-1 inline-block"/>
                        <x-jet-input-error for="inc_date" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Value:</label> 
                    <x-jet-input id="increase" name="increase" type="number" style="margin: 3px 0 0 1.75rem;" step="any" class="mt-1 inline-block"/>
                        <x-jet-input-error for="increase" class="mt-2" />PHP
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Remarks:</label> 
                    <x-jet-input id="inc_remarks" name="inc_remarks" type="text" style="margin: 3px 0 0 0.5rem;" class="mt-5 inline-block h-24"/>
                        <x-jet-input-error for="inc_remarks" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                <x-jet-button class="ml-4" style="float: right;">
                    Submit
                </x-jet-button>
                </div>
            </form>
            <div style="background-color: white; margin-top: 4rem;">
                <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Day
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Value
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Remarks
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($increases as $increase)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $increase->inc_date }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           {{ $increase->inc_day }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $increase->increase }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $increase->inc_remarks }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <form class="inline-block" action="{{ route('increase.destroy', ['id'=>$user->user_id, 'iid'=>$increase->id] )}}" method="GET" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" style="box-sizing: unset;" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                </div>
        </div>
        <input type="radio" id="tab5" name="1">
        <div class="tab-content-box">
            <h3 class="ml-4 text-lg leading-7 font-semibold">Payslip</h3>
            <x-jet-button class="bg-red-500 hover:bg-red-700" style="float: right;" id="printQuery" onclick="printByQuery()" target="_blank" >PRINT PDF</x-jet-button>
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8 bg-gray-10 font-bold font-sans text-center" style="font-size: 20px;">
                                DRC DREAMS BUILDERS AND CONSTRUCTION, INC.
                            </div>
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8 bg-gray-10 font-bold font-sans text-center" style="font-size: 12px;">
                                Payroll for the Period of {{date('d-m-Y', strtotime($task->start))}} - {{date('d-m-Y', strtotime($task->end))}}
                            </div>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'I.D Number' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->user_id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

       
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Name' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Daily Rate' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-base text-green-900 font-bold">
                                        {{ $rates->daily_rate }}
                                        </td>
                                    </tr>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-s font-medium text-black font-bold uppercase tracking-wider">
                                        Gross Pay:
                                    </th>
                                </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Basic Pay' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                        {{ $total_grosses->basic_pay }}
                                        </td>
                                    </tr>
                                
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Regular Day' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $attendances->regular_day }}&nbsp day(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Half Day' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $attendances->half_day }} &nbsp day(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                            {{ $total_grosses->total_half_pay }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'SUN/SPL/Legal' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $attendances->sunday }} &nbsp day(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                            {{ $total_grosses->total_spl_pay }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Allowance' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                        {{ $total_increases->total_increase }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                            {{ 'Total No. of Days Present' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-base text-green-900 font-bold">
                                        {{ $attendances->attendance_count }}&nbsp day(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                            {{ 'Total O.T on Regular Day' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-base text-green-900 font-bold">
                                        {{ $total_ot }} hrs
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                            {{ $total_grosses->total_ot_pay }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                            {{ 'Total O.T on SUN/SPL/Legal' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-base text-green-900 font-bold">
                                        {{ $total_sot }} hrs
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold">
                                            {{ $total_grosses->total_sot_pay }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold font-medium">
                                            {{ 'Total Gross Pay' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-base text-green-900 font-bold">
                                        
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black-900 font-bold text-xl rounded-full bg-yellow-200">
                                            {{ $total_grosses->total_gross }}
                                        </td>
                                    </tr>

                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-s font-medium text-black font-bold uppercase tracking-wider">
                                        Deductions:
                                    </th>
                                </tr>

                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'SSS Premium' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->SSS_premium }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'SSS Loan' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->SSS_loan }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Philhealth' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->philhealth }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'PAG-IBIG' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->pagibig }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'PAG-IBIG Loan' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $deductions->pagibig_loan }}
                                        </td>
                                    </tr>

                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-s font-medium text-black font-bold uppercase tracking-wider">
                                        Other Deductions:
                                    </th>
                                </tr>

                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ 'Late' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $total_late }} hr(s)
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $total_late_deduct }}
                                        </td>
                                    </tr>
                            @foreach ($other_deduct as $others)
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $others->deduction_remarks }}&nbsp&nbsp ({{ $others->deduction_date }} - {{ $others->deduction_day }})
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $others->deduction_value }}
                                        </td>
                                    </tr>
                            @endforeach
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900 font-bold font-medium">
                                            {{ 'Total Deduction' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-base text-green-900 font-bold">
                                        
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black-900 font-bold text-xl rounded-full bg-red-300">
                                            {{ $total_deduct->total_deduction }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xl text-green-900 font-bold font-medium">
                                            {{ 'Net Pay' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-base text-green-900 font-bold">
                                        
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black-900 font-bold text-xl rounded-full bg-green-300">
                                            {{ $netpay->netpay }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>                             
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>

<script>
function printByQuery(){
    window.location.href = "/payslip/{{$user->user_id}}";
        var url = window.location.href;
        var newUrl = url.substring(url.indexOf("?"));
    // console.log(newUrl == url);
        if(newUrl != url){
    window.open("/print/single_payroll"+newUrl);
        }
    
    }

</script>

    