<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'name' =>['required','string','max:100'],
            'email' => ['required','email'],
            'password' => ['required','required',
//                            Password::min(8)
//                                ->mixedCase()
//                                ->letters()
//                                ->numbers()
//                                ->symbols()
//                                ->uncompromised(),
                        ],
            'status' => ['nullable','string',Rule::in(['active','inactive'])],
        ];
    }
}
