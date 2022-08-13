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
            'reservation_id' => ['required', 'string'],
        ];
    }

    /**
     * バリデーション対象データ
     *
     * ルートパラメータをバリデーション対象とするために、リクエストの配列とマージする。
     *
     * /reservations/show/{reservation_id}
     *
     * @return array<string, mixed>
     */
    public function validationData(): array
    {
        return [...$this->request->all(), 'reservation_id' => $this->reservation_id];
    }
}
