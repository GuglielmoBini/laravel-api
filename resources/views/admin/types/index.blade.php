@extends('layouts.app')
@section('title', 'Types')
@section('content')
    <header>
        <h1 class="my-5">Tipi</h1>
        <a href="{{ route('admin.types.create') }}" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Aggiungi</a>
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
            @forelse ($types as $type)
            <tr class="text-center">
                <th scope="row" class="border-start">{{ $type->id }}</th>
                <td>{{ $type->label }}</td>
                <td>{{ $type->color }}</td>
                <td>{{ $type->created_at }}</td>
                <td class="border-end">{{ $type->updated_at }}</td>
                <td class="border-end">
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-warning me-4">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
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
        @if ($types->hasPages())
            {{ $types->links() }}
        @endif
    </div>
@endsection