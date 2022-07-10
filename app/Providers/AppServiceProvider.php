<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use packages\Domain\Application\Room\RoomGetListInteractor;
use packages\Domain\Domain\Room\RoomRepositoryInterface;
use packages\Infrastructure\Room\RoomRepository;
use packages\InMemoryInfrastructure\Room\InMemoryRoomRepository;
use packages\MockInteractor\Room\MockRoomGetListInteractor;
use packages\UseCase\Room\GetList\RoomGetListUseCaseInterface;

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
        } else {
            // 会議室リポジトリ
            $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);

            // 会議室一覧取得ユースケース
            $this->app->bind(RoomGetListUseCaseInterface::class, RoomGetListInteractor::class);
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
