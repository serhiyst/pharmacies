<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Pharmacy;
use App\User;

class ValidatePharmacy extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(User $user, Pharmacy $pharmacy)
    {
        return $pharmacy->sales_rep == $user->name;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'legal_entity' => ['required', 'min:2', 'max:100'],
            'address' => ['required', 'min:2', 'max:255'],
            'city' => ['required', 'min:2', 'max:50'],
            'district' => ['required', 'min:2', 'max:50'],
            'sales_rep' => ['required', 'min:2', 'max:50'],
            'category' => ['required', 'size:2'],
            'day_of_order' => ['required', 'min:5', 'max:11'],
            'day_of_delivery' => ['required', 'min:5', 'max:11'],
            'equipment' => ['nullable', 'max:255'],
            'pharmacy_manager' => ['nullable', 'max:255'],
            'phone_number' => ['nullable', 'numeric'],
            'email' => ['nullable', 'email:rfc,dns']
        ];
    }
}
