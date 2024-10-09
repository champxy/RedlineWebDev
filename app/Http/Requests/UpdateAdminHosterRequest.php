<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminHosterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        alert('swal', 'error', 'กรุณากรอกข้อมูลให้ถูกต้อง', 'ไม่สำเร็จ');
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
            'est_name'=>'required',
            'est_type'=>'required',
            'est_region'=>'required',
            'est_province'=>'required',
            'est_district'=>'required',
            'area_zone'=>'required',
            'using_zone'=>'required',
            'price'=>'required',
            'facilities'=>'required',
        ];
    }
}
