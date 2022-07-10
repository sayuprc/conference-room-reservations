<?php

declare(strict_types=1);

namespace App\Http\Requests\Room;

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
            'id' => ['required', 'string'],
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
            'id' => '会議室ID',
        ];
    }

    /**
     * バリデーション対象データ
     *
     * ルートパラメータをバリデーション対象とするために、リクエストの配列とマージする。
     *
     * /rooms/show/{id}
     *
     * @return array<string, mixed>
     */
    public function validationData(): array
    {
        return [...$this->request->all(), 'id' => $this->id];
    }
}
