<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Room;

interface RoomRepositoryInterface
{
    /**
     * 特定の会議室を取得する。
     *
     * @param RoomId $roomId
     *
     * @return Room
     */
    public function find(RoomId $roomId): Room;

    /**
     * すべての会議室を取得する。
     *
     * @return array<Room>
     */
    public function findAll(): array;

    /**
     * 会議室の保存を行う。
     *
     * @param Room $room
     *
     * @return void
     */
    public function store(Room $room): void;
}
