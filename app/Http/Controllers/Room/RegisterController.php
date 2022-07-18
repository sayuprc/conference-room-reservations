<?php

declare(strict_types=1);

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RegisterRequest;
use packages\UseCase\Room\Register\RoomRegisterRequest;
use packages\UseCase\Room\Register\RoomRegisterUseCaseInterface;

class RegisterController extends Controller
{
    /**
     * 会議室の登録画面を表示する。
     */
    public function create()
    {
        return view('rooms.register');
    }

    /**
     * 会議室の登録を実行する。
     *
     * @param RegisterRequest              $request
     * @param RoomRegisterUseCaseInterface $interactor
     */
    public function handle(RegisterRequest $request, RoomRegisterUseCaseInterface $interactor)
    {
        $interactor->handle(new RoomRegisterRequest($request->validated('name')));

        return redirect()->route('index')->with('message', '会議室を登録しました。');
    }
}
