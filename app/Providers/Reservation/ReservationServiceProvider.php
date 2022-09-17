<?php

declare(strict_types=1);

namespace App\Providers\Reservation;

use Illuminate\Support\ServiceProvider;
use packages\Domain\Application\Reservation\ReservationDeleteInteractor;
use packages\Domain\Application\Reservation\ReservationGetInteractor;
use packages\Domain\Application\Reservation\ReservationRegisterInteractor;
use packages\Domain\Application\Reservation\ReservationUpdateInteractor;
use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Infrastructure\Reservation\ReservationRepository;
use packages\InMemoryInfrastructure\Reservation\InMemoryReservationRepository;
use packages\MockInteractor\Reservation\MockReservationDeleteInteractor;
use packages\MockInteractor\Reservation\MockReservationGetInteractor;
use packages\MockInteractor\Reservation\MockReservationRegisterInteractor;
use packages\MockInteractor\Reservation\MockReservationUpdateInteractor;
use packages\UseCase\Reservation\Delete\ReservationDeleteUseCaseInterface;
use packages\UseCase\Reservation\Get\ReservationGetUseCaseInterface;
use packages\UseCase\Reservation\Register\ReservationRegisterUseCaseInterface;
use packages\UseCase\Reservation\Update\ReservationUpdateUseCaseInterface;

class ReservationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        if (config('app.env') === 'local') {
            // 予約リポジトリ
            $repository = InMemoryReservationRepository::class;

            // 予約登録ユースケース
            $registerInteractor = MockReservationRegisterInteractor::class;

            // 予約詳細取得ユースケース
            $getInteractor = MockReservationGetInteractor::class;

            // 予約更新ユースケース
            $updateInteractor = MockReservationUpdateInteractor::class;

            // 予約削除ユースケース
            $deleteInteractor = MockReservationDeleteInteractor::class;
        } else {
            // 予約リポジトリ
            $repository = ReservationRepository::class;

            // 予約登録ユースケース
            $registerInteractor = ReservationRegisterInteractor::class;

            // 予約詳細取得ユースケース
            $getInteractor = ReservationGetInteractor::class;

            // 予約更新ユースケース
            $updateInteractor = ReservationUpdateInteractor::class;

            // 予約削除ユースケース
            $deleteInteractor = ReservationDeleteInteractor::class;
        }

        $this->app->bind(ReservationRepositoryInterface::class, $repository);

        $this->app->bind(ReservationRegisterUseCaseInterface::class, $registerInteractor);
        $this->app->bind(ReservationGetUseCaseInterface::class, $getInteractor);
        $this->app->bind(ReservationUpdateUseCaseInterface::class, $updateInteractor);
        $this->app->bind(ReservationDeleteUseCaseInterface::class, $deleteInteractor);
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
