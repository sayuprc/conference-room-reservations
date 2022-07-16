<?php

declare(strict_types=1);

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use packages\Domain\Domain\Room\RoomName;

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
            'name' => ['required', 'string', 'min:1', 'max:' . RoomName::MAX_LENGTH],
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
            'name' => '会議室名',
        ];
    }
}
