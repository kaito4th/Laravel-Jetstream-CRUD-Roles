<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Attendance;
use App\Models\Role;
use App\Models\User;
use App\Models\Task;
use App\Models\Payroll;
use App\Models\Increase;
use App\Models\Deduction;
use App\Models\Remark;
use App\Models\Netpay;
use App\Models\Total_deduction;
use App\Models\Attendance_date;
use App\Models\Total_gross_pay;
use App\Models\Total_increase;
use App\Models\Other_deduction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $users = User::with('roles')->get();

        return view('payroll.staff-index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //select
        $roles = Role::pluck('title', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $rate = Payroll::create([
        'user_id'       => $user->id, 
        'daily_rate'    => $user->daily_rate,
        'overtime_rate' => $user->daily_rate / 8,
        'overtime_pay'  => $user->daily_rate / 8 * 1.25,
        'sunday_rate'   => $user->daily_rate / 8 * 1.3,
        ]);
        Attendance::create([
            'user_id'           => $user->id,
            'attendance_count'  => 0,
            'regular_day'       => 0,
            'half_day'          => 0,
            'sunday'            => 0,
        ]);

        Remark::create([
            'user_id'      => $user->id,
            'late'         => 0,
            'overtime'     => 0,
            'sun_overtime' => 0,
        ]);

        Total_gross_pay::create([
            'user_id'       => $user->id,
            'total_gross'   => 0,
            'basic_pay'     => 0,
            'total_ot_pay'  => 0,
            'total_sot_pay' => 0,
            'total_half_pay'=> 0,
            'total_spl_pay' => 0,
        ]);

        Deduction::create([
            'user_id'        => $user->id,
            'SSS_premium'    => 0,
            'SSS_loan'       => 0,
            'philhealth'     => 0,
            'pagibig'        => 0,
            'pagibig_loan'   => 0,
            'tax'            => 0,
        ]);

        Total_deduction::create([
            'user_id'           => $user->id,
            'total_deduction'   => 0,
        ]);

        Total_increase::create([
            'user_id'       => $user->id,
            'total_increase'=> 0,
        ]);

        Netpay::create([
            'user_id'   => $user->id,
            'netpay'    => 0,
        ]);

        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user             = User::where('id',$id)->delete();
        $attendance       = Attendance::where('user_id',$id)->delete();
        $attendance_date  = Attendance_date::where('user_id',$id)->delete();
        $deduction        = Deduction::where('user_id',$id)->delete();
        $increase         = Increase::where('user_id',$id)->delete();
        $other_deduct     = Other_deduction::where('user_id',$id)->delete();
        $netpay           = Netpay::where('user_id',$id)->delete();
        $payroll          = Payroll::where('user_id',$id)->delete();
        $remark           = Remark::where('user_id',$id)->delete();
        $total_deduct     = Total_deduction::where('user_id',$id)->delete();
        $total_gross      = Total_gross_pay::where('user_id',$id)->delete();
        $total_inc        = Total_increase::where('user_id',$id)->delete();

        return redirect()->route('users.index');
    }
}
