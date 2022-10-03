<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'species_id' => 'required',
            'grade_id' => 'required',
            'drying_method_id' => 'required',
            'thickness' => 'required|integer',
            'width' => 'required|integer',
            'length' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'species_id.required' => 'Please select species',
            'grade_id.required' => 'Please select grade',
            'drying_method_id.required' => 'Please select drying method',
            'thickness.required' => 'Please enter thickness',
            'width.required' => 'Please enter width',
            'length.required' => 'Please enter length',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
