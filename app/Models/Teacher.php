<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla en la base de datos
    protected $table = 'teacher';

    // Llave primaria
    protected $primaryKey = 'id_teacher';

    // No usa timestamps (created_at, updated_at)
    public $timestamps = false;

    // Campos que permiten asignación masiva
    protected $fillable = [
        'name_teacher',
        'id_career'
    ];

    /**
     * Relación: un profesor pertenece a una carrera
     */
    public function career()
    {
        return $this->belongsTo(Career::class, 'id_career', 'id_career');
    }
}
