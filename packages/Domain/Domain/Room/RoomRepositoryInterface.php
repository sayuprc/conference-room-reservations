<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Room;

interface RoomRepositoryInterface
{
    /**
     * すべての会議室を取得する。
     *
     * @return array<Room>
     */
    public function findAll(): array;

    /**
     * 会議室の保存。
     *
     * @param Room $room
     *
     * @return void
     */
    public function store(Room $room): void;
}
