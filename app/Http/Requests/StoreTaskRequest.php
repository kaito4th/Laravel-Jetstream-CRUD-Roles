<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreTaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'description' => [
            'required', 'string',
            ],
            'start' => [
                'required',
            ],
            'end' => [
                'required',
            ]
        ];
    }

    public function authorize()
    {
        return Gate::allows('task_access');
    }
}