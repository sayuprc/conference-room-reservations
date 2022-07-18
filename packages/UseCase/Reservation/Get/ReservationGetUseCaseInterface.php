<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Get;

interface ReservationGetUseCaseInterface
{
    /**
     * 予約の詳細を取得する。
     *
     * @param ReservationGetRequest $request
     *
     * @return ReservationGetResponse
     */
    public function handle(ReservationGetRequest $request): ReservationGetResponse;
}
