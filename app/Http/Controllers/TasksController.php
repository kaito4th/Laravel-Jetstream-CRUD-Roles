<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Attendance;
use App\Models\Role;
use App\Models\User;
use App\Models\Payroll;
use App\Models\Deduction;
use App\Models\Remark;
use App\Models\Netpay;
use App\Models\Increase;
use App\Models\Total_deduction;
use App\Models\Attendance_date;
use App\Models\Other_deduction;
use App\Models\Total_gross_pay;
use App\Models\Total_increase;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TasksController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //THIS IS FOR ATTENDANCE DELETE AND UPDATE TO 0
        Attendance::where('user_id', '>', 'DRC-D002')
        ->update(['attendance_count' => 0,
                  'regular_day'      => 0,
                  'half_day'         => 0,
                  'sunday'           => 0,
            ]);
        Attendance_date::where('user_id', '>', 'DRC-D002')->delete();

        //THIS IS FOR DEDUCTIONS DELETE AND UPDATE TO 0
        Deduction::where('user_id', '>', 'DRC-D002')
        ->update(['SSS_premium'   => 0,
                  'SSS_loan'      => 0,
                  'philhealth'    => 0,
                  'pagibig'       => 0,
                  'pagibig_loan'  => 0,
                  'tax'           => 0,
            ]);

        Other_deduction::where('user_id', '>', 'DRC-D002')->delete();
        
        Total_deduction::where('user_id', '>', 'DRC-D002')
        ->update(['total_deduction' => 0]);

        //THIS IS FOR DELETE ALL INCREASE INCREASE
        Increase::where('user_id', '>', 'DRC-D002')->delete();

        Total_increase::where('user_id', '>', 'DRC-D002')
        ->update(['total_increase' => 0]);

        //THIS IS FOR REMARKS
        Remark::where('user_id', '>', 'DRC-D002')
        ->update(['late'        => 0,
                  'overtime'    => 0,
                  'sun_overtime'=> 0,]);

        //THIS IS FOR GROSS PAY
        Total_gross_pay::where('user_id', '>', 'DRC-D002')
        ->update(['total_gross'     => 0,
                  'basic_pay'       => 0,
                  'total_ot_pay'    => 0,
                  'total_sot_pay'   => 0,
                  'total_half_pay'  => 0,
                  'total_spl_pay'   => 0,
                  'allowance'       => 0,
            ]);

        //THIS IS FOR NETPAY
        Netpay::where('user_id', '>', 'DRC-D002')
        ->update(['netpay' => 0]);
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
