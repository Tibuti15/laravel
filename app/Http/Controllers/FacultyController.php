<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule; 

class FacultyController extends Controller
{
    public function listar()
    {
        $faculties = Faculty::with('careers.teachers')->get();
        return view('faculties.listar', compact('faculties'));
    }

    public function nuevo()
    {
        return view('faculties.nuevo');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'name_fac' => [
                'required',
                'string',
                'max:255',
                'unique:faculty,name_fac' 
            ],
            'acronym_fac' => [
                'required',
                'string',
                'max:20',
                'unique:faculty,acronym_fac' 
            ], 
            'dean_name_fac' => 'required|string|max:255',
            'phone_fac' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'email_fac' => 'nullable|email|max:255',
            'year_foundation_fac' => [
                'required',
                'integer',
                'min:1994',
                'max:' . date('Y'),
            ], 
            'logo_fac' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name_fac.required' => 'El nombre de la facultad es obligatorio.',
            'name_fac.unique' => 'Este nombre de facultad ya existe.',
            'acronym_fac.required' => 'El acronimo es obligatorio.',
            'acronym_fac.unique' => 'Este acrónimo ya está en uso.',
            'year_foundation_fac.required' => 'El año de fundacion es obligatorio.',
            'year_foundation_fac.integer' => 'El año de fundación debe ser un número entero.',
            'year_foundation_fac.min' => 'El año de fundación no debe ser menor a 1994.',
            'year_foundation_fac.max' => 'El año de fundación no debe ser mayor al año actual.',
            'phone_fac.required' => 'El teléfono es obligatorio.', 
            'phone_fac.min' => 'El telefono debe tener al menos 10 dígitos.',
            'phone_fac.max' => 'El telefono no debe exceder los 15 dígitos.', 
            'phone_fac.regex' => 'El telefono solo puede contener numeros.',
            'logo_fac.required' => 'El logo es obligatorio para crear una nueva facultad.',
            'logo_fac.image' => 'El archivo debe ser una imagen valida.',
            'logo_fac.mimes' => 'La imagen debe ser de tipo: jpg, jpeg, png o webp.',
            'logo_fac.max' => 'La imagen no debe pesar mas de 2MB.',
        ]);

        $data = $request->only([
            'name_fac',
            'acronym_fac',
            'dean_name_fac',
            'phone_fac',
            'email_fac',
            'year_foundation_fac'
        ]);

        if ($request->hasFile('logo_fac')) {
            $data['logo_fac'] = $request->file('logo_fac')->store('logos', 'public');
        }

        Faculty::create($data);

        Session::flash('success', 'Facultad GUARDADA correctamente');
        return redirect()->route('faculties.listar');
    }

    public function editar($id)
    {
        $faculty = Faculty::findOrFail($id);
        return view('faculties.editar', compact('faculty'));
    }

    public function procesarEdicion(Request $request, $id)
    {
        $faculty = Faculty::findOrFail($id);
        
        $request->validate([
            'name_fac' => [
                'required',
                'string',
                'max:255',
                Rule::unique('faculty', 'name_fac')->ignore($faculty->id_fac, 'id_fac')
            ],
            'acronym_fac' => [
                'required',
                'string',
                'max:20',
                Rule::unique('faculty', 'acronym_fac')->ignore($faculty->id_fac, 'id_fac')
            ],
            'dean_name_fac' => 'required|string|max:255',
            'phone_fac' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'email_fac' => 'nullable|email|max:255',
            'year_foundation_fac' => [
                'required',
                'integer',
                'min:1994',
                'max:' . date('Y'),
            ], 
            'logo_fac' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name_fac.required' => 'El nombre de la facultad es obligatorio.',
            'name_fac.unique' => 'Este nombre de facultad ya existe.',
            'acronym_fac.required' => 'El acrónimo es obligatorio.',
            'acronym_fac.unique' => 'Este acrónimo ya está en uso.',
            'year_foundation_fac.required' => 'El año de fundación es obligatorio.',
            'year_foundation_fac.integer' => 'El año de fundación debe ser un número entero.',
            'year_foundation_fac.min' => 'El año de fundación no debe ser menor a 1994.',
            'year_foundation_fac.max' => 'El año de fundación no debe ser mayor al año actual.',
            'phone_fac.required' => 'El telefono es obligatorio.',
            'phone_fac.min' => 'El telefono debe tener al menos 10 dígitos.',
            'phone_fac.max' => 'El telefono no debe exceder los 15 dígitos.',
            'phone_fac.regex' => 'El telefono solo puede contener numeros.',
            'logo_fac.image' => 'El archivo debe ser una imagen valida.',
            'logo_fac.mimes' => 'La imagen debe ser de tipo: jpg, jpeg, png o webp.',
            'logo_fac.max' => 'La imagen no debe pesar mas de 2MB.',
        ]);

        $faculty->name_fac = $request->name_fac;
        $faculty->acronym_fac = $request->acronym_fac;
        $faculty->dean_name_fac = $request->dean_name_fac;
        $faculty->phone_fac = $request->phone_fac;
        $faculty->email_fac = $request->email_fac;
        $faculty->year_foundation_fac = $request->year_foundation_fac;
        
        if ($request->hasFile('logo_fac')) {
            if ($faculty->logo_fac && Storage::disk('public')->exists($faculty->logo_fac)) {
                Storage::disk('public')->delete($faculty->logo_fac);
            }
            $faculty->logo_fac = $request->file('logo_fac')->store('logos', 'public');
        }

        $faculty->save();

        Session::flash('success', 'Facultad ACTUALIZADA exitosamente');
        return redirect()->route('faculties.listar');
    }

    
    public function checkAcronym(Request $request)
    {
        $acronym = $request->input('value');
        $facultyId = $request->input('faculty_id');
        
        $query = Faculty::where('acronym_fac', $acronym);
        
        if ($facultyId) {
            $query->where('id_fac', '!=', $facultyId);
        }
        
        $exists = $query->exists();
        
        return response()->json(['exists' => $exists]);
    }

    public function checkName(Request $request)
    {
        $name = $request->input('value');
        $facultyId = $request->input('faculty_id');
        
        $query = Faculty::where('name_fac', $name);
        
        if ($facultyId) {
            $query->where('id_fac', '!=', $facultyId);
        }
        
        $exists = $query->exists();
        
        return response()->json(['exists' => $exists]);
    }

    public function eliminar($id)
    {
        return $this->destroy($id);
    }

    public function destroy($id)
    {
        $faculty = Faculty::with('careers.teachers')->findOrFail($id);

        if ($faculty->careers->count() > 0) {
            $careerCount = $faculty->careers->count();
            Session::flash('error', "No se puede eliminar la facultad porque tiene {$careerCount} carrera(s) asociada(s). Elimine primero las carreras.");
            return redirect()->route('faculties.listar');
        }

        foreach ($faculty->careers as $career) {
            foreach ($career->teachers as $teacher) {
                $teacher->delete();
            }
            $career->delete();
        }

        if ($faculty->logo_fac && Storage::disk('public')->exists($faculty->logo_fac)) {
            Storage::disk('public')->delete($faculty->logo_fac);
        }

        $faculty->delete();

        Session::flash('success', 'Facultad ELIMINADA correctamente');
        return redirect()->route('faculties.listar');
    }
}