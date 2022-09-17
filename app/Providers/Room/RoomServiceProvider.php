<?php

declare(strict_types=1);

namespace App\Providers\Room;

use Illuminate\Support\ServiceProvider;
use packages\Domain\Application\Room\RoomGetInteractor;
use packages\Domain\Application\Room\RoomGetListInteractor;
use packages\Domain\Application\Room\RoomRegisterInteractor;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\Infrastructure\Room\RoomRepository;
use packages\InMemoryInfrastructure\Room\InMemoryRoomRepository;
use packages\MockInteractor\Room\MockRoomGetInteractor;
use packages\MockInteractor\Room\MockRoomGetListInteractor;
use packages\MockInteractor\Room\MockRoomRegisterInteractor;
use packages\UseCase\Room\Get\RoomGetUseCaseInterface;
use packages\UseCase\Room\GetList\RoomGetListUseCaseInterface;
use packages\UseCase\Room\Register\RoomRegisterUseCaseInterface;

class RoomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        if (config('app.env') === 'local') {
            // 会議室リポジトリ
            $repository = InMemoryRoomRepository::class;

            // 会議室一覧取得ユースケース
            $getListInteractor = MockRoomGetListInteractor::class;

            // 会議室登録ユースケース
            $registerInteractor = MockRoomRegisterInteractor::class;

            // 会議室取得ユースケース
            $getInteractor = MockRoomGetInteractor::class;
        } else {
            // 会議室リポジトリ
            $repository = RoomRepository::class;

            // 会議室一覧取得ユースケース
            $getListInteractor = RoomGetListInteractor::class;

            // 会議室登録ユースケース
            $registerInteractor = RoomRegisterInteractor::class;

            // 会議室取得ユースケース
            $getInteractor = RoomGetInteractor::class;
        }

        $this->app->bind(RoomRepositoryInterface::class, $repository);

        $this->app->bind(RoomGetListUseCaseInterface::class, $getListInteractor);
        $this->app->bind(RoomRegisterUseCaseInterface::class, $registerInteractor);
        $this->app->bind(RoomGetUseCaseInterface::class, $getInteractor);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
