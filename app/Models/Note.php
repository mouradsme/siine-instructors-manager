<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = array(
        "message",
        "video_id",
        "status",
        "closed_by",
        "closed_message"
    );
}
