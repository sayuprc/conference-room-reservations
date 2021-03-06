<?php

declare(strict_types=1);

namespace App\Http\Requests\Reservation;

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
            'room_id' => ['required', 'string'],
            'reservation_id' => ['required', 'string'],
            'summary' => ['required', 'min:1', 'max:' . Summary::MAX_LENGTH],
            'start_at' => ['required', 'date_format:Y-m-d H:i', 'before:end_at'],
            'end_at' => ['required', 'date_format:Y-m-d H:i', 'after:start_at'],
            'note' => ['nullable', 'string', 'min:0', 'max:' . Note::MAX_LENGTH],
        ];
    }

    /**
     * バリデーション対象データ
     *
     * start_atとend_atは日付と時間が別々で飛んでくるので、それぞれ合体して検証する。
     *
     * @return array<string, mixed>
     */
    public function validationData(): array
    {
        $request = $this->all();

        return [
            ...$request,
            'start_at' => sprintf('%s %s', $request['start_at_date'], $request['start_at_time']),
            'end_at' => sprintf('%s %s', $request['end_at_date'], $request['end_at_time']),
        ];
    }
}
