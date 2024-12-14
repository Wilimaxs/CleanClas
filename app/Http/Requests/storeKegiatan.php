<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeKegiatan extends FormRequest
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
            'id_keg' => 'numeric|digits_between:1,9999999',
            'nama_keg' => 'required|string|bail|max:255',
            'deskripsi' => 'required|string|min:10|max:500',
            'tanggal' => 'required|date_format:Y-m-d',
            'image' => 'required|image|mimes:png,jpg,jpeg', 
        ];
        if ($this->isMethod('post')) {
            $rules['id_keg'] .= '|required';
        }
    
        if ($this->isMethod('put')) {
            unset($rules['id_keg']);
        }
        return $rules;
    }
}
