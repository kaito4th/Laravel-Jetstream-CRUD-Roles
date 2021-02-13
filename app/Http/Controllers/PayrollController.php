<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Task;
use App\Models\Payroll;
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
        $task = Task::select('start','end')->first();
        $user = User::select('name', 'id')->where('id', $id)->first();
        $rates = Payroll::select('daily_rate' , 'overtime_rate', 'overtime_pay', 'sunday_rate')->where('user_id', $id)->first();

        return view('payroll.staff-payroll-tabs', compact('rates','user','task'));
    
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
