<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'user_id'=>'required',
            'payment'=>'required|numeric',
            'due_date'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => 'Select name',
            'due_date.required' => 'Select Due Date',
        ];
    }
}
