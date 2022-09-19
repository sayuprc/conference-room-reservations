<?php

declare(strict_types=1);

namespace App\Http\Requests\ReservationTemplate;

use Illuminate\Foundation\Http\FormRequest;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Summary;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'template_id' => ['required', 'integer', 'numeric'],
            'summary' => ['required', 'min:1', 'max:' . Summary::MAX_LENGTH],
            'start_at' => ['required', 'date_format:H:i', 'before:end_at'],
            'end_at' => ['required', 'date_format:H:i', 'after:start_at'],
            'note' => ['nullable', 'string', 'min:0', 'max:' . Note::MAX_LENGTH],
        ];
    }
}
