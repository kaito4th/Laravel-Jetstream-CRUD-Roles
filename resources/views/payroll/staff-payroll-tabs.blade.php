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
} */


</style>
<x-app-layout>
    <x-slot name="header">
    <h2 class="ml-20 text-lg leading-7 font-semibold inline-block" style="color:green; font-size: 20px;">{{$user->name}}</h2>'s 
    <h3 class="text-lg leading-7 font-semibold inline-block">Payroll for the period of 
        <div class="text-lg leading-7 font-semibold inline-block" style="color:green; font-size: 26px;">
            {{$task->start}} - {{$task->end}}
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
                <label for="tab4">Something</label>
            </li>
        </ul>
    </div>
    <div class="tab-container-wrap">
        <input type="radio" checked id="tab1" name="1">
        <div class="tab-content-box">
            <h3 class="ml-4 text-lg leading-7 font-semibold" style="padding: 0 0 40px 0;">Rates</h3>
             <form action="/{id}" method="post">
             @csrf
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    Daily Rate: <x-jet-input id="daily_rate" value="{{ $rates->daily_rate }}" name="daily_rate" type="text" class="mt-1 inline-block" style="margin: 30px 0 0 20px;" readonly/>
                        <x-jet-input-error for="daily_rate" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    Overtime Rate: <x-jet-input id="overtime_rate" value="{{ $rates->overtime_rate }}" name="overtime_rate" type="text" class="mt-1 inline-block" style="margin: 30px 0 0 20px;" readonly/>
                        <x-jet-input-error for="overtime_rate" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    Overtime Pay: <x-jet-input id="overtime_pay" value="{{ $rates->overtime_pay }}" name="overtime_pay" type="text" class="mt-1 inline-block" style="margin: 30px 0 0 20px;" readonly/>
                        <x-jet-input-error for="overtime_pay" class="mt-2" /> / hour
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    Sunday Rate: <x-jet-input id="sunday_rate" value="{{ $rates->sunday_rate }}" name="sunday_rate" type="text" class="mt-1 inline-block" style="margin: 30px 0 0 20px;" readonly/>
                        <x-jet-input-error for="sunday_rate" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                <x-jet-button class="ml-4" style="float: right;">
                    Submit
                </x-jet-button>
                </div>
            </form>
        </div>
        <input type="radio" id="tab2" name="1">
        <div class="tab-content-box">
            <h3 class="ml-4 text-lg leading-7 font-semibold">Attendance</h3>
                <form action="{{ route('attendance.store', $user->id) }}" method="GET">
                @csrf
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Date:</label> 
                    <x-jet-input id="date" type="date" class="mt-1 inline-block"/>
                        <x-jet-input-error for="date" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                    <label style="display: inline-block;">Time in:</label> 
                    <x-jet-input id="time_in" type="time_in" class="mt-1 inline-block"/>
                        <x-jet-input-error for="time_in" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4" style="margin: 0 0 0 3rem;">
                <label style="display: inline-block;">Time out:</label> 
                    <x-jet-input id="time_out" type="time" class="mt-1 inline-block"/>
                        <x-jet-input-error for="time_out" class="mt-2" />
                </div>
                <h3 class="ml-4 text-lg leading-7 font-semibold">Late</h3>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-input id="late_time" type="number" class="mt-1 inline-block" wire:model.defer="state.number"/>
                        <x-jet-input-error for="late_time" class="mt-2" /> Minutes
                </div>
                <div class="col-span-6 sm:col-span-4">
                <x-jet-button class="ml-4" style="float: right;">
                    Submit
                </x-jet-button>
                </div>
                </form>
        </div>
        <input type="radio" id="tab3" name="1">
        <div class="tab-content-box">
            <h3 class="ml-4 text-lg leading-7 font-semibold">Deductions</h3>
                <p>sample content</p>
        </div>
        <input type="radio" id="tab4" name="1">
        <div class="tab-content-box">
            <h3 class="ml-4 text-lg leading-7 font-semibold">Something</h3>
                <p>sample content</p>
        </div>
    </div>
</div>
</x-app-layout>

    