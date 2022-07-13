<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class FeatureTestCase extends TestCase
{
    /**
     * @var bool $isSetuped
     */
    private static bool $isSetuped = false;

    /**
     * テストデータ挿入
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (! self::$isSetuped) {
            Artisan::call('db:seed --env=testing');
            self::$isSetuped = true;
        }
    }
}
