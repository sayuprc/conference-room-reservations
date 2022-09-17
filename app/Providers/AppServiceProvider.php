<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use packages\Domain\Application\Reservation\ReservationDeleteInteractor;
use packages\Domain\Application\Reservation\ReservationGetInteractor;
use packages\Domain\Application\Reservation\ReservationRegisterInteractor;
use packages\Domain\Application\Reservation\ReservationUpdateInteractor;
use packages\Domain\Application\ReservationTemplate\ReservationTemplateRegisterInteractor;
use packages\Domain\Application\Room\RoomGetInteractor;
use packages\Domain\Application\Room\RoomGetListInteractor;
use packages\Domain\Application\Room\RoomRegisterInteractor;
use packages\Domain\Domain\Reservation\ReservationRepositoryInterface;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\Domain\Domain\Slack\SlackAPIRepositoryInterface;
use packages\Infrastructure\Reservation\ReservationRepository;
use packages\Infrastructure\ReservationTemplate\ReservationTemplateRepository;
use packages\Infrastructure\Room\RoomRepository;
use packages\Infrastructure\Slack\SlackAPIRepository;
use packages\InMemoryInfrastructure\Reservation\InMemoryReservationRepository;
use packages\InMemoryInfrastructure\ReservationTemplate\InMemoryReservationTemplateRepository;
use packages\InMemoryInfrastructure\Room\InMemoryRoomRepository;
use packages\InMemoryInfrastructure\Slack\InMemorySlackAPIRepository;
use packages\MockInteractor\Reservation\MockReservationDeleteInteractor;
use packages\MockInteractor\Reservation\MockReservationGetInteractor;
use packages\MockInteractor\Reservation\MockReservationRegisterInteractor;
use packages\MockInteractor\Reservation\MockReservationUpdateInteractor;
use packages\MockInteractor\ReservationTemplate\MockReservationTemplateRegisterInteractor;
use packages\MockInteractor\Room\MockRoomGetInteractor;
use packages\MockInteractor\Room\MockRoomGetListInteractor;
use packages\MockInteractor\Room\MockRoomRegisterInteractor;
use packages\UseCase\Reservation\Delete\ReservationDeleteUseCaseInterface;
use packages\UseCase\Reservation\Get\ReservationGetUseCaseInterface;
use packages\UseCase\Reservation\Register\ReservationRegisterUseCaseInterface;
use packages\UseCase\Reservation\Update\ReservationUpdateUseCaseInterface;
use packages\UseCase\ReservationTemplate\Register\ReservationTemplateRegisterUseCaseInterface;
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

            // 予約リポジトリ
            $this->app->bind(ReservationRepositoryInterface::class, InMemoryReservationRepository::class);

            // 予約登録ユースケース
            $this->app->bind(ReservationRegisterUseCaseInterface::class, MockReservationRegisterInteractor::class);

            // 予約詳細取得ユースケース
            $this->app->bind(ReservationGetUseCaseInterface::class, MockReservationGetInteractor::class);

            // 予約更新ユースケース
            $this->app->bind(ReservationUpdateUseCaseInterface::class, MockReservationUpdateInteractor::class);

            // 予約削除ユースケース
            $this->app->bind(ReservationDeleteUseCaseInterface::class, MockReservationDeleteInteractor::class);

            // 予約テンプレートリポジトリ
            $this->app->bind(ReservationTemplateRepositoryInterface::class, InMemoryReservationTemplateRepository::class);

            // 予約テンプレート登録ユースケース
            $this->app->bind(ReservationTemplateRegisterUseCaseInterface::class, MockReservationTemplateRegisterInteractor::class);
        } else {
            // 会議室リポジトリ
            $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);

            // 会議室一覧取得ユースケース
            $this->app->bind(RoomGetListUseCaseInterface::class, RoomGetListInteractor::class);

            // 会議室登録ユースケース
            $this->app->bind(RoomRegisterUseCaseInterface::class, RoomRegisterInteractor::class);

            // 会議室取得ユースケース
            $this->app->bind(RoomGetUseCaseInterface::class, RoomGetInteractor::class);

            // 予約リポジトリ
            $this->app->bind(ReservationRepositoryInterface::class, ReservationRepository::class);

            // 予約登録ユースケース
            $this->app->bind(ReservationRegisterUseCaseInterface::class, ReservationRegisterInteractor::class);

            // 予約詳細取得ユースケース
            $this->app->bind(ReservationGetUseCaseInterface::class, ReservationGetInteractor::class);

            // 予約更新ユースケース
            $this->app->bind(ReservationUpdateUseCaseInterface::class, ReservationUpdateInteractor::class);

            // 予約削除ユースケース
            $this->app->bind(ReservationDeleteUseCaseInterface::class, ReservationDeleteInteractor::class);

            // 予約テンプレートリポジトリ
            $this->app->bind(ReservationTemplateRepositoryInterface::class, ReservationTemplateRepository::class);

            // 予約テンプレート登録ユースケース
            $this->app->bind(ReservationTemplateRegisterUseCaseInterface::class, ReservationTemplateRegisterInteractor::class);
        }

        if (config('services.slack.is_linked')) {
            // Slack API リポジトリ
            $this->app->bind(SlackAPIRepositoryInterface::class, SlackAPIRepository::class);
        } else {
            // Slack API リポジトリ
            $this->app->bind(SlackAPIRepositoryInterface::class, InMemorySlackAPIRepository::class);
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
