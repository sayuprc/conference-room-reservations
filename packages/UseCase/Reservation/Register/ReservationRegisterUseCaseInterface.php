<?php

namespace packages\UseCase\Reservation\Register;

interface ReservationRegisterUseCaseInterface
{
    public function handle(ReservationRegisterRequest $request): ReservationRegisterResponse;
}
