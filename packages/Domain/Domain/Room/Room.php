<?php

declare(strict_types=1);

namespace packages\Domain\Domain\Room;

class Room
{
    /**
     * @var RoomId $roomId
     */
    private RoomId $roomId;

    /**
     * @var RoomName $roomName
     */
    private RoomName $roomName;

    /**
     * @param RoomId   $roomId
     * @param RoomName $roomName
     *
     * @return void
     */
    public function __construct(RoomId $roomId, RoomName $roomName)
    {
        $this->roomId = $roomId;
        $this->roomName = $roomName;
    }

    /**
     * 会議室IDのValueObjectを取得する。
     *
     * @return RoomId
     */
    public function getRoomId(): RoomId
    {
        return $this->roomId;
    }

    /**
     * 会議室名のValueObjectを取得する。
     *
     * @return RoomName
     */
    public function getRoomName(): RoomName
    {
        return $this->roomName;
    }
}
