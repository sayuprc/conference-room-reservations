<?php

declare(strict_types=1);

namespace App\Http\Controllers\ReservationTemplate;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationTemplate\RegisterRequest;
use packages\UseCase\ReservationTemplate\Register\ReservationTemplateRegisterRequest;
use packages\UseCase\ReservationTemplate\Register\ReservationTemplateRegisterUseCaseInterface;

class RegisterReservationTemplateController extends Controller
{
    /**
     * 予約テンプレート登録画面を表示する。
     */
    public function create()
    {
        return view('templates.register');
    }

    /**
     * 予約テンプレートの登録を実行する。
     *
     * @param RegisterRequest                             $request
     * @param ReservationTemplateRegisterUseCaseInterface $interactor
     */
    public function handle(RegisterRequest $request, ReservationTemplateRegisterUseCaseInterface $interactor)
    {
        $validated = $request->validated();

        $interactor->handle(new ReservationTemplateRegisterRequest(
            $validated['summary'],
            $validated['start_at'],
            $validated['end_at'],
            $validated['note'] ?? ''
        ));

        return redirect()->route('templates.register')->with('message', '予約テンプレートの登録が完了しました。');
    }
}
