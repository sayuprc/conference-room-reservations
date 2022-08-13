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
     * @return Room|null
     */
    public function find(RoomId $roomId): ?Room;

    /**
     * すべての会議室を取得する。
     *
     * @return array<Room>
     */
    public function findAll(): array;

    /**
     * 会議室の新規保存を行う。
     *
     * @param Room $room
     *
     * @return void
     */
    public function insert(Room $room): void;

    /**
     * 会議室の更新を行う。
     *
     * @param Room $room
     *
     * @return void
     */
    public function update(Room $room): void;

    /**
     * 会議室の削除を行う。
     *
     * @param RoomId $roomId
     *
     * @return void
     */
    public function delete(RoomId $roomId): void;
}
