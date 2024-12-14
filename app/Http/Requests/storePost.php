<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storePost extends FormRequest
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
            'nip'=>'numeric|digits:18|bail',
            'nama' =>'required|string|regex:/^[a-zA-Z\s.,]*$/|bail|max:255',
            'tlp' =>'required|numeric|digits_between:10,15|bail',
            'pass' =>'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ];
        if ($this->isMethod('post')) {
            $rules['nip'] .= '|required';
        }
    
        if ($this->isMethod('put')) {
            unset($rules['nip']);
        }
    
        return $rules;
    }
}
