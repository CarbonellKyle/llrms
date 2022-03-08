<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(auth()->user()->google_id!=null){
            return [
                'username' => ['required', 'min:3'],
                'first_name' => ['required'],
                'last_name' => ['required'],
            ];
        }

        return [
            'username' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
            'first_name' => ['required'],
            'last_name' => ['required'],
        ];
    }
}
