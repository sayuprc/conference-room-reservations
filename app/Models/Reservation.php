<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * 主キーの名前
     */
    protected $primaryKey = 'reservation_id';

    /**
     * 主キーの型
     */
    protected $keyType = 'string';

    /**
     * @var array<string> $guarded 代入不可属性
     */
    protected $guarded = [];

    /**
     * 予約が属する会議室を取得する。
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
