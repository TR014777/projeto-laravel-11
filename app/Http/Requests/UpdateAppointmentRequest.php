<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
            'client' => 'required|string|max:63',
            'service'=> 'nullable|string|max:255',
            'date'   => 'required|date|after_or_equal:today',
            'start'  => 'nullable|date_format:H:i', 
            'end'    => 'nullable|date_format:H:i',  
            'color'  => 'nullable|string|max:20',
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('end', 'after:start', function ($input) {
            return !empty($input->start) && !empty($input->end);
        });
    }

    public function messages(): array
    {
        return [
            'end.after' => 'O horário de término deve ser depois do início.',
            'date.after_or_equal' => 'Não é possível agendar para uma data passada.',
        ];
    }
}
