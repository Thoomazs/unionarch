<?php namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ 'firstname' => 'required|alpha|min:2',
                 'lastname'  => 'required|alpha|min:2',
                 'email'     => 'required|email|unique:users',
                 'password'  => 'required|confirmed|min:8' ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
