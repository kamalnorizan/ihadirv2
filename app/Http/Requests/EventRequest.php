<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|min:5',
            'location'=>'required',
            'event_category_id'=>'required|exists:event_categories,id',
            'pax'=>'required|integer',
            'description'=>'required',
            'tarikh'=>'required|array',
            'tarikh.*'=>'required|date'
        ];
    }
}
