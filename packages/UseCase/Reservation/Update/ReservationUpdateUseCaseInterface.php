<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Update;

interface ReservationUpdateUseCaseInterface
{
    /**
     * 予約の更新を行う。
     *
     * @param ReservationUpdateRequest $request
     *
     * @return ReservationUpdateResponse
     */
    public function handle(ReservationUpdateRequest $request): ReservationUpdateResponse;
}
