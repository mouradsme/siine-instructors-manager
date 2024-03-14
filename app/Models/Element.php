<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $fillable = array(
        "title",
        "description",
        "video",
        "status",
        "added_by",
        "order",
        "category"
    );
}
