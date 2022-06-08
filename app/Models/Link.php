<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    /**
     * 链接所属的用户
     */
    public function FunctionName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
