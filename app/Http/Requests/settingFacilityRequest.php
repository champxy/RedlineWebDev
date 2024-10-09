<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class settingFacilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /* alert('swal', 'error', 'กรุณากรอกข้อมูลให้ครบถ้วน', 'ไม่สำเร็จ'); */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'facility'=>'required',
        ];
    }
}
