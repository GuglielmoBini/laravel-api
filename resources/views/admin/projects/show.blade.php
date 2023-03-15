@extends('layouts.app')
@section('title', 'Details')
@section('content')
<section id="detail">
    <header>
        <h1 class="my-3">{{ $project->name }}</h1>
        @if ($project->type)
          <div class="badge rounded-pill fs-5 mb-3" style="background-color: {{ $project->type->color }}">{{ $project->type->label }}</div>
        @else
          <div class="fs-5 mb-3 text-warning">Nessuna tipologia</div> 
        @endif
    </header>
    <div class="d-flex flex-column align-items-center">
        <div class="@if ($project->image_url) card @endif mb-4">
          <div class="row g-0 justify-content-center">
            @if ($project->image_url)                
            <div class="col-4">
              <img src="{{ asset('storage/' . $project->image_url) }}" class="img-fluid w-100 h-100 rounded-start" alt="{{ $project->name }}">
            </div>
            @endif
            <div class="col-8 @if (!$project->image_url) card @endif">
              <div class="row g-0 h-100 flex-column">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title">Descrizione</h5>
                  <p class="card-text flex-grow-1">{{ $project->description }}</p>
                  <p class="card-text"><small class="text-muted"><strong>Created: </strong>{{ $project->created_at }}</small></p>
                  <p class="card-text"><small class="text-muted"><strong>Type: </strong>{{ $project->type?->label }}</small></p>
                  <ul class="p-0 m-0">
                    @forelse ($project->technologies as $technology)
                        <li class="badge rounded-pill me-2 bg-{{ $technology->color }}">{{ $technology->label }}</li>
                    @empty
                        -
                    @endforelse
                  </ul>
                </div>
                <div class="card-body border-top d-flex align-items-center justify-content-around">
                  <a href="{{ $project->project_url }}">Project link</a>
                  <a href="{{ $project->image_url }}">Image URL</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex">
          <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna Indietro</a>
          <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning mx-4">
            <i class="fa-solid fa-pencil"></i>
        </a>
          <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
        </form>
        </div>
    </div>
  </section>
@endsection