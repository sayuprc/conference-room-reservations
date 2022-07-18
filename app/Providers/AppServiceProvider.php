<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use packages\Domain\Application\Reservation\ReservationGetInteractor;
use packages\Domain\Application\Reservation\ReservationRegisterInteractor;
use packages\Domain\Application\Room\RoomGetInteractor;
use packages\Domain\Application\Room\RoomGetListInteractor;
use packages\Domain\Application\Room\RoomRegisterInteractor;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\Infrastructure\Room\RoomRepository;
use packages\InMemoryInfrastructure\Room\InMemoryRoomRepository;
use packages\MockInteractor\Reservation\MockReservationGetInteractor;
use packages\MockInteractor\Reservation\MockReservationRegisterInteractor;
use packages\MockInteractor\Room\MockRoomGetInteractor;
use packages\MockInteractor\Room\MockRoomGetListInteractor;
use packages\MockInteractor\Room\MockRoomRegisterInteractor;
use packages\UseCase\Reservation\Get\ReservationGetUseCaseInterface;
use packages\UseCase\Reservation\Register\ReservationRegisterUseCaseInterface;
use packages\UseCase\Room\Get\RoomGetUseCaseInterface;
use packages\UseCase\Room\GetList\RoomGetListUseCaseInterface;
use packages\UseCase\Room\Register\RoomRegisterUseCaseInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('app.env') === 'local') {
            // 会議室リポジトリ
            $this->app->bind(RoomRepositoryInterface::class, InMemoryRoomRepository::class);

            // 会議室一覧取得ユースケース
            $this->app->bind(RoomGetListUseCaseInterface::class, MockRoomGetListInteractor::class);

            // 会議室登録ユースケース
            $this->app->bind(RoomRegisterUseCaseInterface::class, MockRoomRegisterInteractor::class);

            // 会議室取得ユースケース
            $this->app->bind(RoomGetUseCaseInterface::class, MockRoomGetInteractor::class);

            // 予約登録ユースケース
            $this->app->bind(ReservationRegisterUseCaseInterface::class, MockReservationRegisterInteractor::class);

            // 予約詳細取得ユースケース
            $this->app->bind(ReservationGetUseCaseInterface::class, MockReservationGetInteractor::class);
        } else {
            // 会議室リポジトリ
            $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);

            // 会議室一覧取得ユースケース
            $this->app->bind(RoomGetListUseCaseInterface::class, RoomGetListInteractor::class);

            // 会議室登録ユースケース
            $this->app->bind(RoomRegisterUseCaseInterface::class, RoomRegisterInteractor::class);

            // 会議室取得ユースケース
            $this->app->bind(RoomGetUseCaseInterface::class, RoomGetInteractor::class);

            // 予約登録ユースケース
            $this->app->bind(ReservationRegisterUseCaseInterface::class, ReservationRegisterInteractor::class);

            // 予約詳細取得ユースケース
            $this->app->bind(ReservationGetUseCaseInterface::class, ReservationGetInteractor::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
