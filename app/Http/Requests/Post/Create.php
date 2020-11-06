<?php

namespace App\Http\Requests\Post;

use Illuminate\Support\Facades\Auth;
use Pearl\RequestValidate\RequestAbstract;

class Create extends RequestAbstract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        var_dump( 'authorize'.Auth::id());
        if (Auth::id() == 2) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|int',
            'title' => 'required|string',
            'body' => 'required|min:5',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }
}
