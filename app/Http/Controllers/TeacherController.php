<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    // Listar todos los profesores
    public function listar()
    {
        $teachers = Teacher::with('career.faculty')->get();
        return view('teachers.listar', compact('teachers'));
    }

    // Mostrar formulario para nuevo profesor
    public function nuevo()
    {
        $careers = Career::all();
        return view('teachers.nuevo', compact('careers'));
    }

    // Guardar nuevo profesor
    public function guardar(Request $request)
    {
        $data = $request->only([
            'name_teacher',
            'id_career',
            'email_teacher',
            'phone_teacher'
        ]);

        Teacher::create($data);
        Session::flash('success', 'Profesor GUARDADO correctamente');
        return redirect()->route('teachers.listar');
    }

    // Mostrar formulario para editar profesor
    public function editar($id)
    {
        $teacher = Teacher::findOrFail($id);
        $careers = Career::all();
        return view('teachers.editar', compact('teacher','careers'));
    }

    // Procesar edición de profesor
    public function procesarEdicion(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->name_teacher = $request->name_teacher;
        $teacher->id_career = $request->id_career;
        $teacher->email_teacher = $request->email_teacher;
        $teacher->phone_teacher = $request->phone_teacher;
        $teacher->save();

        Session::flash('success', 'Profesor ACTUALIZADO correctamente');
        return redirect()->route('teachers.listar');
    }

    // Eliminar profesor (mantener wrapper GET)
    public function eliminar($id)
    {
        return $this->destroy($id);
    }

    // Eliminar profesor RESTful
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        Session::flash('success', 'Profesor ELIMINADO correctamente');
        return redirect()->route('teachers.listar');
    }

    // Mostrar detalles de profesor
    public function show($id)
    {
        $teacher = Teacher::with('career.faculty')->findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }
}
