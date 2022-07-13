<?php

declare(strict_types=1);

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use packages\Domain\Domain\Reservation\Note;
use packages\Domain\Domain\Reservation\Summary;

class RegisterRequest extends FormRequest
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
            'room_id' => ['required', 'string', 'exists:rooms'],
            'summary' => ['required', 'min:1', 'max:' . Summary::MAX_LENGTH],
            'start_at' => ['required', 'date_format:Y-m-d H:i', 'before:end_at'],
            'end_at' => ['required', 'date_format:Y-m-d H:i', 'after:start_at'],
            'note' => ['nullable', 'string', 'min:0', 'max:' . Note::MAX_LENGTH],
        ];
    }

    /**
     * 要素の名称
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'room_id' => '会議室ID',
            'summary' => '概要',
            'start_at' => '開始日時',
            'end_at' => '終了日時',
            'note' => '備考',
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
