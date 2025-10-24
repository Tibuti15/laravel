<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    public function listar()
    {
        $teachers = Teacher::with('career.faculty')->get();
        return view('teachers.listar', compact('teachers'));
    }

    public function nuevo()
    {
        $careers = Career::all();
        return view('teachers.nuevo', compact('careers'));
    }

    public function guardar(Request $request)
    {
        $data = $request->only(['name_teacher','id_career']);
        Teacher::create($data);
        Session::flash('success', 'Profesor GUARDADO correctamente');
        return redirect()->route('teachers.listar');
    }

    public function editar($id)
    {
        $teacher = Teacher::findOrFail($id);
        $careers = Career::all();
        return view('teachers.editar', compact('teacher','careers'));
    }

    public function procesarEdicion(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->name_teacher = $request->name_teacher;
        $teacher->id_career = $request->id_career;
        $teacher->save();
        Session::flash('success', 'Profesor ACTUALIZADO correctamente');
        return redirect()->route('teachers.listar');
    }

    public function eliminar($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        Session::flash('success', 'Profesor ELIMINADO correctamente');
        return redirect()->route('teachers.listar');
    }

    public function show($id)
    {
        $teacher = Teacher::with('career.faculty')->findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }
}
