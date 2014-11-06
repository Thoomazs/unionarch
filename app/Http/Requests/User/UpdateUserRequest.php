<?php namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ 'firstname' => 'required|min:2',
                 'lastname'  => 'required|min:2',
                 'email'     => 'required|email',
                 'password'  => 'confirmed|min:8'
        ];
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

    public function forbiddenResponse()
    {
        return response( view( 'error.403' ), 403 );
    }


}
