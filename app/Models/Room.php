<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * 主キーの名前
     */
    protected $primaryKey = 'room_id';

    /**
     * 主キーの型
     */
    protected $keyType = 'string';

    /**
     * @var array<string> $guarded 代入不可属性
     */
    protected $guarded = [];

    /**
     * 会議室の予約を取得する。
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class, $this->primaryKey);
    }
}
