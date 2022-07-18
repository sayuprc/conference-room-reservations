<?php

declare(strict_types=1);

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class DetailRequest extends FormRequest
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
        ];
    }

    /**
     * 要素の名称
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return[
            'room_id' => '会議室ID',
            'reservation_id' => '予約ID',
        ];
    }

    /**
     * バリデーション対象データ
     *
     * ルートパラメータをバリデーション対象とするために、リクエストの配列とマージする。
     *
     * /reservations/show/{room_id}/{reservation_id}
     *
     * @return array<string, mixed>
     */
    public function validationData(): array
    {
        return [...$this->request->all(), 'room_id' => $this->room_id, 'reservation_id' => $this->reservation_id];
    }
}
