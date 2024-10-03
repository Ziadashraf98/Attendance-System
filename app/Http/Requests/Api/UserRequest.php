<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $routeName = $this->route()->getName();
        
        return [
            'name'=>[$routeName == 'user.register' ? 'required' : 'nullable' , 'min:3' , 'max:35' , 'string'],
            'email'=>[$routeName == 'user.register' ? 'required' : 'nullable' , 'unique:users,email' , 'email'],
            'ID_no'=>[$routeName == 'user.register' ? 'unique:users,ID_no' : 'nullable' , 'digits:5' , 'required'],
            'password'=>'required|between:8,30',
            'c_password'=>[$routeName == 'user.register' ? 'required' : 'nullable' , 'same:password'],
        ];
    }
}
