<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    // Listar todos los profesores
    public function listar()
    {
        $teachers = Teacher::with('career')->get();
        return view('teachers.listar', compact('teachers'));
    }

    // Mostrar formulario para nuevo profesor
    public function nuevo()
    {
        return view('teachers.nuevo');
    }

    // Guardar nuevo profesor
    public function guardar(Request $request)
    {
        $data = $request->only([
            'name_teacher',
            'id_career'
        ]);

        Teacher::create($data);

        Session::flash('success', 'Profesor GUARDADO correctamente');
        return redirect()->route('teachers.listar');
    }

    // Eliminar profesor
    public function eliminar($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        Session::flash('success', 'Profesor ELIMINADO correctamente');
        return redirect()->route('teachers.listar');
    }

    // Mostrar formulario para editar profesor
    public function editar($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.editar', compact('teacher'));
    }

    // Procesar edición de profesor
    public function procesarEdicion(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $teacher->name_teacher = $request->name_teacher;
        $teacher->id_career = $request->id_career;

        $teacher->save();

        Session::flash('success', 'Profesor ACTUALIZADO exitosamente');
        return redirect()->route('teachers.listar');
    }
}
