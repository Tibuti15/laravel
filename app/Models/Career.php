<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'career';
    protected $primaryKey = 'id_career';
    public $timestamps = false;

    protected $fillable = [
        'name_career',
        'id_fac'
    ];

    /**
     * Una carrera pertenece a una facultad
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'id_fac', 'id_fac');
    }

    /**
     * Una carrera tiene muchos profesores
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'id_career', 'id_career');
    }
}
