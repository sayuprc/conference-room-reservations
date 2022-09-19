<?php

declare(strict_types=1);

namespace App\Http\Requests\ReservationTemplate;

use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
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
        ];
    }

    /**
     * バリデーション対象データ
     *
     * ルートパラメータをバリデーション対象とするために、リクエストの配列とマージする。
     *
     * /templates/show/{template_id}
     *
     * @return array<string, mixed>
     */
    public function validationData(): array
    {
        return [...$this->request->all(), 'template_id' => $this->template_id];
    }
}
