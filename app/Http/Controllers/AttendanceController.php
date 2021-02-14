<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Role;
use App\Models\User;
use App\Models\Task;
use App\Models\Payroll;
use App\Models\Attendance_date;
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
        $attendance = Attendance::updateOrCreate([
            'user_id'           => $id,
        ],
        [
            'name'              => $name,
            ]);
        DB::table('attendances')->where('user_id', $id)->increment('attendance_count', + 1);

            $date = $request->input('date');
            return $date;

        // $date = $request->date;
        // return $date;
        // $dates = Attendance_date::create([
        //     'user_id'   => $id,
        //     'date'      => '2021/02/02',
        //     'time_in'   => $request->input('time_in'),
        // ]);
        //$user = User::select('id','name')->where('id', $id)->first();
        

        // if(DB::table('attendances')->where('user_id',$user_id)->doesntExists()){
        //     //add new data here
        // } else{
            
        //     return $this->update($request, $attendance);
        //     //update existing data here
        // }
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
