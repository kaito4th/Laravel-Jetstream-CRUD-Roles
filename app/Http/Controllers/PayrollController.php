<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Task;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Remark;
use App\Models\Netpay;
use App\Models\Deduction;
use App\Models\Increase;
use App\Models\Other_deduction;
use App\Models\Total_deduction;
use App\Models\Total_increase;
use App\Models\Total_gross_pay;
use App\Models\Attendance_date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;


class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $users = User::with('roles')->get();

        return view('payroll.staff-index', compact('users'));
    }

    // public function tabs()
    // {
    //     abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
    //     $users = User::with('roles')->get();

    //     return view('payroll.staff-payroll-tabs', compact('users'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rates = new Payroll;
        // $dailyrate    = $rates->daily_rate    = $request->daily_rate;
        // $overtimerate = $rates->overtime_rate = $dailyrate / 8;
        // $overtimepay  = $rates->overtime_pay  = $overtimerate * 1.25;
        // $sundayrate   = $rates->sunday_rate    = $overtimerate * 1.3;
        // $rates->save();
        // return redirect('/payroll/{id}', compact('rates'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //MAIN TABS
        $task             = Task::select('start','end')->first();
        $user             = User::select('name', 'id')->where('id', $id)->first();
        $rates            = Payroll::select('daily_rate' , 'overtime_rate', 'overtime_pay', 'sunday_rate')->where('user_id', $id)->first();
        $attendances      = Attendance::select('attendance_count', 'regular_day', 'half_day', 'sunday')->where('user_id', $id)->first();
        $attendance_dates = Attendance_date::where('user_id', $id)->get();
        $remarks          = Remark::select('late','overtime','sun_overtime')->where('user_id', $id)->get();
        $total_grosses    = Total_gross_pay::select('total_gross', 'total_ot_pay','total_sot_pay', 'total_spl_pay','total_half_pay', 'basic_pay')->where('user_id', $id)->first();
        $deductions       = Deduction::select('SSS_premium','SSS_loan','philhealth','pagibig','pagibig_loan','tax')->where('user_id',$id)->first();
        $other_deduct     = Other_deduction::select('deduction_date','deduction_value','deduction_remarks','deduction_day')->where('user_id', $id)->get();
        $total_deduct     = Total_deduction::select('total_deduction')->where('user_id', $id)->first();
        $netpay           = Netpay::select('netpay')->where('user_id', $id)->first();
        $increases        = Increase::select('inc_date','inc_day','increase','inc_remarks')->where('user_id', $id)->get();
        $total_increases  = Total_increase::select('total_increase')->where('user_id', $id)->first();
        $counter          = $remarks->count();

        //TO GET TOTAL O.T AND LATE
        $total_ot   = DB::table('Remarks')->where('user_id',$id)->sum('overtime');
        $total_sot  = DB::table('Remarks')->where('user_id',$id)->sum('sun_overtime');
        $total_late = DB::table('Remarks')->where('user_id',$id)->sum('late');

        //MAIN VIEW
        if($attendance_dates == null){
            return view('payroll.staff-payroll-tabs', compact('rates','user','task','attendances','attendance_dates',
            'remarks','counter','total_grosses','total_ot','total_late','total_sot','deductions','other_deduct','total_deduct',
            'netpay','increases','total_increases'));
        } else if($total_grosses->basic_pay == null){
            return view('payroll.staff-payroll-tabs', compact('rates','user','task','attendances','attendance_dates',
            'remarks','counter','total_grosses','total_ot','total_late','total_sot','deductions','other_deduct','total_deduct',
            'netpay','increases','total_increases'));
        }else if($total_deduct->total_deduction == null){ 
            return view('payroll.staff-payroll-tabs', compact('rates','user','task','attendances','attendance_dates',
            'remarks','counter','total_grosses','total_ot','total_late','total_sot','deductions','other_deduct','total_deduct',
            'netpay','increases','total_increases'));
        }else{
            return view('payroll.staff-payroll-tabs', compact('rates','user','task','attendances','attendance_dates',
            'remarks','counter','total_grosses','total_ot','total_late','total_sot','deductions','other_deduct','total_deduct',
            'netpay','increases','total_increases'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
