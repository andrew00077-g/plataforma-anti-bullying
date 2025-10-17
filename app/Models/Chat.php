<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['usuario','mensaje','analyzed','flagged','severity'];
    protected $casts = [
        'analyzed' => 'boolean',
        'flagged' => 'boolean',
    ];
}
