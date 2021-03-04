<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'user_id'     => [
                'required',
                'unique:users',
            ],
            'email'    => [
                'required',
                'unique:users',
            ],
            'roles.*'  => [
                'integer',
            ],
            'roles'    => [
                'required',
                'array',
            ],
            'address'    => [
                'required',
                'string',
            ],
            'number'    => [
                'required',
                'string',
            ],
            'daily_rate'    => [
                'required',
            ],
            // 'attendance_count'    => [
            //     'required',
            //     'integer',
            // ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}