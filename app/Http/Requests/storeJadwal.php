<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeJadwal extends FormRequest
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
        $rules = [
            'id'=>'numeric|digits_between:1,9999999',
        ];

        if ($this->isMethod('post')) {
            $rules['id'] .= 'required|';
        }
    
        if ($this->isMethod('put')) {
            unset($rules['id']);
        }
    
        return $rules;
    }
}
