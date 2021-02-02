<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'role_id'            => [
                'integer',
                'exists:roles,id',
                'required',
            ],
            'name'               => [
                'string',
                'required',
            ],
            'email'              => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],
            'password'           => [
                'nullable',
            ],
            'roles'              => [
                'required',
                'array',
            ],
            'roles.*.id'         => [
                'integer',
                'exists:roles,id',
            ],
            'phone_primary'      => [
                'string',
                'nullable',
            ],
            'phone_secundary'    => [
                'string',
                'nullable',
            ],
            'birthdate'          => [
                'date_format:' . config('project.date_format'),
                'nullable',
            ],
            'sex'                => [
                'nullable',
                'in:' . implode(',', Arr::pluck(User::SEX_SELECT, 'value')),
            ],
            'active'             => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'customer_user_otrs' => [
                'string',
                'nullable',
            ],
            'first_access'       => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'cliente'            => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'endereco_cliente'   => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'preferencia'        => [
                'string',
                'nullable',
            ],
        ];
    }
}
