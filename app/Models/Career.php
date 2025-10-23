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
<<<<<<< HEAD
        'name_career',
        'id_fac'
    ];

    /**
     * Una carrera pertenece a una facultad
     */
=======
        'name_career', 'id_fac'
    ];

>>>>>>> 81be8a41ed8711e58c0ca86cf24a314065de9a04
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'id_fac', 'id_fac');
    }

<<<<<<< HEAD
    /**
     * Una carrera tiene muchos profesores
     */
=======
>>>>>>> 81be8a41ed8711e58c0ca86cf24a314065de9a04
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'id_career', 'id_career');
    }
}
