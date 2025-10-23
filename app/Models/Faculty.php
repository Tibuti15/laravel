<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla (como está en phpMyAdmin)
    protected $table = 'faculty';

    // Primary Key
    protected $primaryKey = 'id_fac';

    // Si la tabla no tiene created_at y updated_at
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name_fac',
        'acronym_fac',
        'dean_name_fac',
        'phone_fac',
        'email_fac',
        'logo_fac',
        'year_foundation_fac'
    ];

    /**
     * Relación One-To-Many:
     * Una facultad tiene muchas carreras
     */
    public function careers()
    {
        return $this->hasMany(Career::class, 'id_fac', 'id_fac');
    }
}
