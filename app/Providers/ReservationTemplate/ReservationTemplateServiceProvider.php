<?php

declare(strict_types=1);

namespace App\Providers\ReservationTemplate;

use Illuminate\Support\ServiceProvider;
use packages\Domain\Application\ReservationTemplate\ReservationTemplateGetInteractor;
use packages\Domain\Application\ReservationTemplate\ReservationTemplateGetListInteractor;
use packages\Domain\Application\ReservationTemplate\ReservationTemplateRegisterInteractor;
use packages\Domain\Application\ReservationTemplate\ReservationTemplateUpdateInteractor;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\Infrastructure\ReservationTemplate\ReservationTemplateRepository;
use packages\InMemoryInfrastructure\ReservationTemplate\InMemoryReservationTemplateRepository;
use packages\MockInteractor\ReservationTemplate\MockReservationTemplateGetInteractor;
use packages\MockInteractor\ReservationTemplate\MockReservationTemplateGetListInteractor;
use packages\MockInteractor\ReservationTemplate\MockReservationTemplateRegisterInteractor;
use packages\MockInteractor\ReservationTemplate\MockReservationTemplateUpdateInteractor;
use packages\UseCase\ReservationTemplate\Get\ReservationTemplateGetUseCaseInterface;
use packages\UseCase\ReservationTemplate\GetList\ReservationTemplateGetListUseCaseInterface;
use packages\UseCase\ReservationTemplate\Register\ReservationTemplateRegisterUseCaseInterface;
use packages\UseCase\ReservationTemplate\Update\ReservationTemplateUpdateUseCaseInterface;

class ReservationTemplateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        if (config('app.env') === 'local') {
            // 予約テンプレートリポジトリ
            $repository = InMemoryReservationTemplateRepository::class;

            // 予約テンプレート登録ユースケース
            $registerInteractor = MockReservationTemplateRegisterInteractor::class;

            // 予約テンプレート一覧取得ユースケース
            $getListInteractor = MockReservationTemplateGetListInteractor::class;

            // 予約テンプレート取得ユースケース
            $getInteractor = MockReservationTemplateGetInteractor::class;

            // 予約テンプレート更新ユースケース
            $updateInteractor = MockReservationTemplateUpdateInteractor::class;
        } else {
            // 予約テンプレートリポジトリ
            $repository = ReservationTemplateRepository::class;

            // 予約テンプレート登録ユースケース
            $registerInteractor = ReservationTemplateRegisterInteractor::class;

            // 予約テンプレート一覧取得ユースケース
            $getListInteractor = ReservationTemplateGetListInteractor::class;

            // 予約テンプレート取得ユースケース
            $getInteractor = ReservationTemplateGetInteractor::class;

            // 予約テンプレート更新ユースケース
            $updateInteractor = ReservationTemplateUpdateInteractor::class;
        }

        $this->app->bind(ReservationTemplateRepositoryInterface::class, $repository);

        $this->app->bind(ReservationTemplateRegisterUseCaseInterface::class, $registerInteractor);
        $this->app->bind(ReservationTemplateGetListUseCaseInterface::class, $getListInteractor);
        $this->app->bind(ReservationTemplateGetUseCaseInterface::class, $getInteractor);
        $this->app->bind(ReservationTemplateUpdateUseCaseInterface::class, $updateInteractor);
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
