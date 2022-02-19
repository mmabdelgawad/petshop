<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema()
 */
class UserLogin extends FormRequest
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
    /**
     * @OA\Property(format="string", default="petshop@buckhill.com", description="email", property="email"),
     * @OA\Property(format="string", default="password", description="password", property="password"),
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
