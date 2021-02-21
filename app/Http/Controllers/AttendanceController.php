<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Role;
use App\Models\User;
use App\Models\Task;
use App\Models\Payroll;
use App\Models\Deduction;
use App\Models\Remark;
use App\Models\Netpay;
use App\Models\Total_deduction;
use App\Models\Attendance_date;
use App\Models\Total_gross_pay;
use App\Models\Total_increase;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $name = DB::table('users')->where('id', $id)->pluck('name');
        $date = $request->input('date_att');
        $dayname = Carbon::parse($date)->format('l');
        //THIS IS FOR ATTENDANCE DATES TIME IN AND TIME OUT
        $dates = Attendance_date::create([
            'user_id'   => $id,
            'date'      => $date,
            'day'       => $dayname,
            'time_in'   => $time_in  = $request->input('time_in'),
            'time_out'  => $time_out = $request->input('time_out'),
        ]);
        
        //THIS IS FOR REMARKS(LATE,OVERTIME, ETC.)
        $late    = $request->input('late');
        if ($late > 15){
        if($dayname == 'Sunday'){
        $remarks = Remark::create([
            'user_id'       => $id,
            DB::table('Remarks')->where('user_id',$id)->increment('late', + 1),
            'sun_overtime'  => $sun_overtime_input = $request->input('overtime'),
        ]);
        } else{
            Remark::create([
                'user_id'   => $id,
                DB::table('Remarks')->where('user_id',$id)->increment('late', + 1),
                'overtime'  => $overtime_input = $request->input('overtime'),
            ]);
        }
    }else {
        Remark::create([
            'user_id'   => $id,
            'late'      => null,
            'overtime'  => $overtime_input = $request->input('overtime'),
        ]);
    }
        //THIS IS FOR ATTENDANCE COUNT (REGULAR DAY,HALF DAY,SUNDAY/SPECIAL)
        //dd($dayname);
        if($dayname == 'Sunday'){
            $attendance = Attendance::updateOrCreate([
                'user_id'   => $id,
            
            ],
            [
                DB::table('attendances')->where('user_id', $id)->increment('sunday', + 1),
                ]);
        }else if($late >= 60){
            Attendance::updateOrCreate([
                'user_id'   => $id,
            ],[
                DB::table('attendances')->where('user_id', $id)->increment('half_day', + 1),
            ]);
        }else{
            Attendance::updateOrCreate([
                'user_id'     => $id,

            ],[
                DB::table('attendances')->where('user_id', $id)->increment('regular_day', + 1),
            ]);
        }
        DB::table('attendances')->where('user_id', $id)->increment('attendance_count', + 1);

        //THIS IS FOR GROSS PAY
            $total_increase = Total_increase::select('total_increase')->where('user_id', $id)->first();
            $rate           = Payroll::select('daily_rate', 'overtime_pay', 'sunday_rate')->where('user_id', $id)->first();
            $day            = Attendance::select('regular_day','half_day','sunday')->where('user_id', $id)->first();
            $overtime       = DB::table('Remarks')->where('user_id', $id)->sum('overtime');
            $sun_overtime   = DB::table('Remarks')->where('user_id', $id)->sum('sun_overtime');

                Total_gross_pay::updateOrCreate([
                    'user_id'       => $id,
                ],[
                    'basic_pay'     => $basic_pay = $rate->daily_rate * $day->regular_day,
                    'total_ot_pay'  => $ot_pay    = $rate->overtime_pay * $overtime,
                    'total_sot_pay' => $sot_pay   = $rate->sunday_rate * $sun_overtime,
                    'total_half_pay'=> $half      = $rate->daily_rate / 2 * $day->half_day,
                    'total_spl_pay' => $spl       = $rate->daily_rate * 1.3 * $day->sunday,
                    'total_gross'   => $basic_pay + $ot_pay + $sot_pay + $half + $spl + $total_increase->total_increase,
                ]);

        //THIS IS FOR SSS,PAG-IBIG,PHILHEALTH
            $total_basic = Total_gross_pay::select('basic_pay')->where('user_id', $id)->first();

            Deduction::updateOrCreate([
                'user_id'    => $id,
            ],[
                'philhealth' => $philhealth = $total_basic->basic_pay * 0.0275 / 2,
            ]);

        //THIS IS FOR NETPAY//
            $total_gross        = Total_gross_pay::select('total_gross')->where('user_id', $id)->first();
            $total_deduction    = Total_deduction::select('total_deduction')->where('user_id', $id)->first();

            Netpay::updateOrCreate([
                'user_id'    => $id,
            ],[
                'netpay'     => $total_gross->total_gross - $philhealth,
            ]);

    
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user_id = User::select('id')->first();
        echo $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
