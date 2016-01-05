<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'username' => 'required|min:6|unique:users,username,' . $this->request->get('id'),
            'email' => 'required|email|unique:users,email,' . $this->request->get('id'),
            'status' => 'required'
        ];
    }
}
