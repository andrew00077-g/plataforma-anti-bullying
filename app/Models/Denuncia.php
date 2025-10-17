<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $fillable = [
        'descripcion','tipo','lugar','fecha','analysis_flagged','analysis_severity'
    ];
}
