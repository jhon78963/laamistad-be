<?php

declare(strict_types=1);

namespace App\Auth\Interfaces\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'required|string',
            'otherNames' => 'required|string',
            'fatherSurname' => 'required|string',
            'motherSurname' => 'required|string',
            'cellphoneCodeId' => 'required|integer',
            'cellphoneNumber' => 'required|string',
            'documentTypeId' => 'required|integer',
            'documentNumber' => 'required|string|unique:general_profiles,document_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'headquarterId' => 'required|integer',
            'userTypeId' => 'required|integer',
        ];
    }
}
