<?php

declare(strict_types=1);

namespace App\Providers\ReservationTemplate;

use Illuminate\Support\ServiceProvider;
use packages\Domain\Application\ReservationTemplate\ReservationTemplateRegisterInteractor;
use packages\Domain\Domain\ReservationTemplate\ReservationTemplateRepositoryInterface;
use packages\Infrastructure\ReservationTemplate\ReservationTemplateRepository;
use packages\InMemoryInfrastructure\ReservationTemplate\InMemoryReservationTemplateRepository;
use packages\MockInteractor\ReservationTemplate\MockReservationTemplateRegisterInteractor;
use packages\UseCase\ReservationTemplate\Register\ReservationTemplateRegisterUseCaseInterface;

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
        } else {
            // 予約テンプレートリポジトリ
            $repository = ReservationTemplateRepository::class;

            // 予約テンプレート登録ユースケース
            $registerInteractor = ReservationTemplateRegisterInteractor::class;
        }

        $this->app->bind(ReservationTemplateRepositoryInterface::class, $repository);

        $this->app->bind(ReservationTemplateRegisterUseCaseInterface::class, $registerInteractor);
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
