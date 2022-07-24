<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Delete;

interface ReservationDeleteUseCaseInterface
{
    /**
     * 予約を削除する。
     *
     * @param ReservationDeleteRequest $request
     *
     * @return ReservationDeleteResponse
     */
    public function handle(ReservationDeleteRequest $request): ReservationDeleteResponse;
}
