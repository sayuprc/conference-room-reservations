<?php

declare(strict_types=1);

namespace packages\MockInteractor\Reservation;

use packages\UseCase\Reservation\Delete\ReservationDeleteRequest;
use packages\UseCase\Reservation\Delete\ReservationDeleteResponse;
use packages\UseCase\Reservation\Delete\ReservationDeleteUseCaseInterface;

class MockReservationDeleteInteractor implements ReservationDeleteUseCaseInterface
{
    /**
     * 予約を削除する。
     *
     * @param ReservationDeleteRequest $request
     *
     * @return ReservationDeleteResponse
     */
    public function handle(ReservationDeleteRequest $request): ReservationDeleteResponse
    {
        return new ReservationDeleteResponse('1');
    }
}
