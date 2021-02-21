<?php

namespace App\Http\Controllers;

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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OtherDeductionController extends Controller
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
        $date = $request->input('date_ded');
        $day = Carbon::parse($date)->format('l');
        Other_deduction::create([
            'user_id'          => $id,
            'deduction_date'   => $date,
            'deduction_day'    => $day,
            'deduction_value'  => $request->input('deduction_value'),
            'deduction_remarks'=> $request->input('deduction_remarks'),
        ]);

        $total_other_deductions = DB::table('Other_deductions')->where('user_id', $id)->sum('deduction_value');
        $deduction              = Deduction::select('SSS_premium','SSS_loan','philhealth','pagibig','pagibig_loan','tax')->where('user_id', $id)->first();

            Total_deduction::updateOrCreate([
                'user_id'         => $id,
            ],[
                'total_deduction' => $total_other_deductions
            ]);

            //THIS IS FOR NETPAY//
            $total_gross        = Total_gross_pay::select('total_gross')->where('user_id', $id)->first();
            $total_deduction    = Total_deduction::select('total_deduction')->where('user_id', $id)->first();

            Netpay::updateOrCreate([
                'user_id'    => $id,
            ],[
                'netpay'     => $total_gross->total_gross - $total_deduction->total_deduction,
            ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Other_deduction  $other_deduction
     * @return \Illuminate\Http\Response
     */
    public function show(Other_deduction $other_deduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Other_deduction  $other_deduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Other_deduction $other_deduction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Other_deduction  $other_deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Other_deduction $other_deduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Other_deduction  $other_deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Other_deduction $other_deduction)
    {
        //
    }
}
