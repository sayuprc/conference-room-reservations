<?php

declare(strict_types=1);

namespace App\Providers\Slack;

use Illuminate\Support\ServiceProvider;
use packages\Domain\Domain\Slack\SlackAPIRepositoryInterface;
use packages\Infrastructure\Slack\SlackAPIRepository;
use packages\InMemoryInfrastructure\Slack\InMemorySlackAPIRepository;

class SlackServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        if (config('services.slack.is_linked')) {
            // Slack API リポジトリ
            $repository = SlackAPIRepository::class;
        } else {
            // Slack API リポジトリ
            $repository = InMemorySlackAPIRepository::class;
        }

        $this->app->bind(SlackAPIRepositoryInterface::class, $repository);
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
