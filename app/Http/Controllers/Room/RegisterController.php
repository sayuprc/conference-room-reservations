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
     * 登録画面表示
     */
    public function create()
    {
        return view('rooms.register');
    }

    /**
     * 登録実行
     */
    public function handle(RegisterRequest $request, RoomRegisterUseCaseInterface $interactor)
    {
        $interactor->handle(new RoomRegisterRequest($request->validated('name')));

        return redirect()->route('index')->with('message', '会議室を登録しました。');
    }
}
