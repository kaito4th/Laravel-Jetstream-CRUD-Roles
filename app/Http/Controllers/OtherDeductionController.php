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
use App\Models\Total_increase;
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
        $date    = $request->input('date_ded');
        $select  = $request->input('select_deduct');
        $day     = Carbon::parse($date)->format('l');
        $deduct_value = $request->input('deduction_value');
        $newdate = Carbon::createFromFormat('Y-m-d', $date)
                    ->format('d-m-Y');

        //THIS  IS FOR BENEFITS DEDUCTION
        if($select == 'sss_premium'){
            Deduction::updateOrCreate([
                'user_id'       => $id,
            ],
            [
                'SSS_premium'   => $deduct_value,
            ]);
        }else if($select == 'sss_loan'){
            Deduction::updateOrCreate([
                'user_id'       => $id,
            ],
            [
                'SSS_loan'   => $deduct_value,
            ]);
        }else if($select == 'phils'){
            Deduction::updateOrCreate([
                'user_id'       => $id,
            ],
            [
                'philhealth'   => $deduct_value,
            ]);
        }else if($select == 'pagibig'){
            Deduction::updateOrCreate([
                'user_id'       => $id,
            ],
            [
                'pagibig'   => $deduct_value,
            ]);
        }else if($select == 'pagibig_loan'){
            Deduction::updateOrCreate([
                'user_id'       => $id,
            ],
            [
                'pagibig_loan'   => $deduct_value,
            ]);
        }else if($select == 'philhealth'){
            Deduction::updateOrCreate([
                'user_id'       => $id,
            ],
            [
                'philhealth'   => $deduct_value,
            ]);
        }
        else{
            Other_deduction::create([
                'user_id'          => $id,
                'deduction_date'   => $newdate,
                'deduction_day'    => $day,
                'deduction_value'  => $deduct_value,
                'deduction_remarks'=> $request->input('deduction_remarks'),
            ]);
        }
        
        //THIS IS FOR TOTAL DEDUCTIONS
        $deduct_rate            = Payroll::select('daily_rate')->where('user_id',$id)->first();
        $total_late_count       = DB::table('remarks')->where('user_id', $id)->sum('late');
        $total_late_deduct      = $deduct_rate->daily_rate / 8 * $total_late_count;
        $total_other_deductions = DB::table('Other_deductions')->where('user_id', $id)->sum('deduction_value');
        $deduction              = Deduction::select('SSS_premium','SSS_loan','philhealth','pagibig','pagibig_loan','tax')->where('user_id', $id)->first();

        Total_deduction::updateOrCreate([
            'user_id'         => $id,
        ],[
            'total_deduction' => $total_other_deductions + $deduction->SSS_premium + $deduction->SSS_loan
                                + $deduction->philhealth + $deduction->pagibig + $deduction->pagibig_loan + $deduction->tax + $total_late_deduct,
        ]);

    //THIS IS FOR NETPAY//
        $total_gross        = Total_gross_pay::select('total_gross')->where('user_id', $id)->first();
        $total_deduction    = Total_deduction::select('total_deduction')->where('user_id', $id)->first();
        $netpay             = Netpay::select('netpay')->where('user_id',$id)->first();
        $total_increase     = Total_increase::select('total_increase')->where('user_id',$id)->first();
        

        $total_deds = $total_deduction->total_deduction;
        $total_incs = $total_increase->total_increase;
        
        //dd($total_deds,$total_incs,$total_gross->total_gross);
        Netpay::updateOrCreate([
            'user_id'    => $id,
        ],[
            'netpay'     => $total_gross->total_gross - $total_deds,
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
    public function destroy($id,$iid)
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //echo $id. ' - ' .$iid;
        $delete = Other_deduction::findOrFail($iid);
        Netpay::updateOrCreate([
            'user_id'    => $id,
        ],[
            DB::table('netpays')->where('user_id',$id)->increment('netpay', $delete->deduction_value),
        ]);

        Total_deduction::updateOrCreate([
            'user_id'   => $id,
        ],
        [
            DB::table('total_deductions')->where('user_id',$id)->decrement('total_deduction', $delete->deduction_value),
        ]);
        $delete->delete();
            

            return back();
    }
}
