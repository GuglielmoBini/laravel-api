@extends('layouts.app')
@section('title', 'Technologies')
@section('content')
    <header>
        <h1 class="my-5">Tecnologie</h1>
        <a href="{{ route('admin.technologies.create') }}" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Aggiungi</a>
    </header>
    <table class="table">
        <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">label</th>
              <th scope="col">Colore</th>
              <th scope="col">Creato il</th>
              <th scope="col">Aggiornato il</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse ($technologies as $technology)
            <tr class="text-center">
                <th scope="row" class="border-start">{{ $technology->id }}</th>
                <td>{{ $technology->label }}</td>
                <td>{{ $technology->color }}</td>
                <td>{{ $technology->created_at }}</td>
                <td class="border-end">{{ $technology->updated_at }}</td>
                <td class="border-end">
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-warning me-4">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <form action="{{ route('admin.technologies.destroy', $technology->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr> 
            @empty
                <tr>
                    <th scope="row" colspan="5" class="text-center">Non sono presenti tipi</th>
                </tr>
            @endforelse            
          </tbody>
    </table>
    <div class="mt-5 d-flex justify-content-center">
        @if ($technologies->hasPages())
            {{ $technologies->links() }}
        @endif
    </div>
@endsection