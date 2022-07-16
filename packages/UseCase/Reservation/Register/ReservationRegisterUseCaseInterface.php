<?php

declare(strict_types=1);

namespace packages\UseCase\Reservation\Register;

interface ReservationRegisterUseCaseInterface
{
    /**
     * 予約の登録を実行する。
     *
     * @param ReservationRegisterRequest $request
     *
     * @return ReservationRegisterResponse
     */
    public function handle(ReservationRegisterRequest $request): ReservationRegisterResponse;
}
