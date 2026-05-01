<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
        return [
            'client' => 'required|string|max:255',
            'date'   => 'required|date|after_or_equal:today',
            'start'  => 'required|date_format:H:i',
            'end'    => 'required|date_format:H:i|after:start',
            'color'  => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'end.after' => 'O horário de término deve ser depois do início.',
            'date.after_or_equal' => 'Não é possível agendar para uma data passada.',
        ];
    }
}
