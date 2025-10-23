<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher';
    protected $primaryKey = 'id_teacher';
    public $timestamps = false;

    protected $fillable = [
        'name_teacher', 'id_career'
    ];

    public function career()
    {
        return $this->belongsTo(Career::class, 'id_career', 'id_career');
    }
}

