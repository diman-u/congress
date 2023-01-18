<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
            'nomination_id' => 'required',
            'upload_multiple.*' => [
                'nullable',
                'max:10240', // file size in KB
            ],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title.required' => 'A title is required',
            'description.required' => 'A description is required',
            'body.required' => 'A body is required',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A :attribute is required',
            'description.required' => 'A :attribute is required',
            'body.required' => 'A :attribute is required',
        ];
    }
}
