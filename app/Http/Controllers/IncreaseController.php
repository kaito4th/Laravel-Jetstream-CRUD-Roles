<?php

namespace App\Http\Controllers;

use App\Models\Increase;
use App\Models\Other_deduction;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Role;
use App\Models\User;
use App\Models\Task;
use App\Models\Payroll;
use App\Models\Deduction;
use App\Models\Remark;
use App\Models\Netpay;
use App\Models\Attendance_date;
use App\Models\Total_gross_pay;
use App\Models\Total_deduction;
use App\Models\Total_increase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IncreaseController extends Controller
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
        $date = $request->input('inc_date');
        $day = Carbon::parse($date)->format('l');
        $newdate = Carbon::createFromFormat('Y-m-d', $date)
                    ->format('m/d/Y');
        Increase::create([
            'user_id'       => $id,
            'inc_date'      => $newdate,
            'inc_day'       => $day,
            'increase'      => $increase_input = $request->input('increase'),
            'inc_remarks'   => $request->input('inc_remarks'),
        ]);

        //THIS IS FOR TOTAL INCREASE
        $total_inc = Increase::where('user_id', $id)->sum('increase');

        Total_increase::updateOrCreate([
            'user_id'       => $id,
        ],
        [
            'total_increase'=> $total_inc,
        ]);

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

            //THIS IS FOR NETPAY
            $deduction   = Deduction::select('SSS_premium','SSS_loan','philhealth','pagibig','pagibig_loan','tax')->where('user_id', $id)->first();
            $total_gross = Total_gross_pay::select('total_gross')->where('user_id', $id)->first();

            Netpay::updateOrCreate([
                'user_id'     => $id,
            ],[
                DB::table('netpays')->where('user_id',$id)->increment('netpay', $increase_input),
            ]);

            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Increase  $increase
     * @return \Illuminate\Http\Response
     */
    public function show(Increase $increase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Increase  $increase
     * @return \Illuminate\Http\Response
     */
    public function edit(Increase $increase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Increase  $increase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Increase $increase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Increase  $increase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$iid)
    {
        //echo $id. ' - '.$iid;

        $delete = Increase::findOrFail($iid);
        
        // $total_gross        = Total_gross_pay::select('total_gross')->where('user_id', $id)->first();
        // $total_deduction    = Total_deduction::select('total_deduction')->where('user_id', $id)->first();
        // $total_late_count   = DB::table('remarks')->where('user_id', $id)->sum('late');
        // $deduct_rate        = Payroll::select('daily_rate')->where('user_id',$id)->first();
        // $total_late_deduct  = $deduct_rate->daily_rate / 8 * $total_late_count;

        // $total_deds = $total_late_deduct + $total_deduction->total_deduction;

        // Total_gross_pay::updateOrCreate([
        //     'user_id'    => $id,
        // ],
        // [
        //     'total_gross'=> $total_gross->total_gross,
        // ]);
            
            Netpay::updateOrCreate([
                'user_id'    => $id,
            ],[
                DB::table('netpays')->where('user_id',$id)->decrement('netpay', $delete->increase),
            ]);
            $delete->delete();
        //SCAN INCREASE
        $increase = DB::table('increases')->where('user_id',$id)->sum('increase');

        Total_increase::updateOrCreate([
            'user_id'           => $id,
        ],
        [
            'total_increase'    => $increase,
        ]);

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
        return back();
    }
}
