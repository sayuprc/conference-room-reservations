<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTemplate extends Model
{
    use HasFactory;

    /**
     * 主キーの名前
     */
    protected $primaryKey = 'template_id';
}
