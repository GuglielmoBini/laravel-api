@extends('layouts.app')
@section('title', 'Projects')
@section('content')
    <header>
        <h1 class="my-5">Projects</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Aggiungi</a>
    </header>
    <table class="table">
        <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Tipo</th>
              <th scope="col">Creato il</th>
              <th scope="col">Aggiornato il</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($projects as $project)
            <tr class="text-center">
                <th scope="row" class="border-start">{{ $project->id }}</th>
                <td>{{ $project->name }}</td>
                <td>
                    @if ($project->type)
                        <span class="badge rounded-pill fs-6" style="background-color: {{ $project->type->color }}">{{ $project->type->label }}</span>
                    @else
                     - 
                    @endif
                </td>
                <td>{{ $project->created_at }}</td>
                <td class="border-end">{{ $project->updated_at }}</td>
                <td class="border-end">
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-success">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning mx-4">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr> 
            @empty
                <tr>
                    <th scope="row" colspan="5" class="text-center">Non sono presenti progetti</th>
                </tr>
            @endforelse            
          </tbody>
    </table>
    <div class="mt-5 d-flex justify-content-center">
        @if ($projects->hasPages())
            {{ $projects->links() }}
        @endif
    </div>
@endsection