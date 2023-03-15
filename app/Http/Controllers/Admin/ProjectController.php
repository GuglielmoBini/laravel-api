<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('updated_at', 'DESC')->simplePaginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();
        $technologies = Technology::select('id', 'label')->orderBy('id')->get();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:projects|min:5|max:50',
                'project_url' => 'required|string',
                'image_url' => 'nullable|image|mimes:jpeg,jpg,png',
                'description' => 'required|string',
                'type_id' => 'nullable|exists:types,id',
                'technologies' => 'nullable|exists:technologies,id'
            ],
            [
                'name.required' => 'Il nome del progetto è obbligatorio.',
                'name.unique' => 'Non possono esserci due nomi progetto uguali.',
                'name.min' => 'Il nome del progetto deve avere almeno 5 caratteri.',
                'name.max' => 'Il nome del progetto deve avere massimo 50 caratteri.',
                'project_url.required' => 'Il link progetto è obbligatorio.',
                'image_url.image' => 'L\'immagine deve essere un file di tipo immagine.',
                'image_url.mimes' => 'Le estensioni accettate sono: jpeg, jpg, png.',
                'description.required' => 'La descrizione è obbligatoria.',
                'type_id' => 'Tipo non valido.',
                'technologies' => 'le tecnologie selezionate non sono valide.'
            ]
        );

        $data = $request->all();
        $project = new Project();

        if (Arr::exists($data, 'image_url')) {
            $img_url = Storage::put('projects', $data['image_url']);
            $data['image_url'] = $img_url;
        }

        $project->fill($data);
        $project->save();
        // relaziono il progetto con le tecnologie
        if (Arr::exists($data, 'technologies')) $project->technologies()->attach($data['technologies']);

        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('msg', 'Nuovo progetto creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::select('id', 'label')->orderBy('id')->get();
        $project_technologies = $project->technologies->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'project_technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate(
            [
                'name' => ['required', 'string', Rule::unique('projects')->ignore($project->id), 'min:5', 'max:50'],
                'project_url' => 'required|string',
                'image_url' => 'nullable|image|mimes:jpeg,jpg,png',
                'description' => 'required|string',
                'type_id' => 'nullable|exists:types,id',
                'technologies' => 'nullable|exists:technologies,id'
            ],
            [
                'name.required' => 'Il nome del progetto è obbligatorio.',
                'name.unique' => 'Non possono esserci due nomi progetto uguali.',
                'name.min' => 'Il nome del progetto deve avere almeno 5 caratteri.',
                'name.max' => 'Il nome del progetto deve avere massimo 50 caratteri.',
                'project_url.required' => 'Il link progetto è obbligatorio.',
                'image_url.image' => 'L\'immagine deve essere un file di tipo immagine.',
                'image_url.mimes' => 'Le estensioni accettate sono: jpeg, jpg, png.',
                'description.required' => 'La descrizione è obbligatoria.',
                'type_id' => 'Tipo non valido.',
                'technologies' => 'le tecnologie selezionate non sono valide.'
            ]
        );

        $data = $request->all();

        if (Arr::exists($data, 'image_url')) {
            if ($project->image_url) Storage::delete($project->image_url);
            $img_url = Storage::put('projects', $data['image_url']);
            $data['image_url'] = $img_url;
        }


        $project->fill($data);
        $project->save();
        // assegno le tecnologie
        if (Arr::exists($data, 'technologies')) $project->technologies()->sync($data['technologies']);
        else if (count($project->technologies)) $project->technologies()->detach();

        return to_route('admin.projects.show', $project->id)->with('type', 'warning')->with('msg', 'Modifica avvenuta con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image_url) Storage::delete($project->image_url);
        if (count($project->technologies)) $project->technologies()->detach();

        $project->delete();

        return to_route('admin.projects.index')->with('type', 'danger')->with('msg', "Il progetto $project->name è stato cancellato con successo.");
    }
}
