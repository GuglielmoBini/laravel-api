<div class="card p-4 shadow">
    @if ($technology->exists)
    <form action="{{ route('admin.technologies.update', $technology->id) }}" method="POST" enctype="multipart/form-data" novalidate>
    @method('PUT')
    @else    
    <form action="{{ route('admin.technologies.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @endif
    @csrf
        <div class="row justify-content-around">
            <div class="col-5">
                <div class="mb-3">
                    <label for="label" class="form-label">Label</label>
                    <input type="text" class="form-control" id="label" name="label" value="{{ old('label', $technology->label) }}" minlength="5" maxlength="15" required>
                    <small class="text-muted">Inserisci il nome del label</small>
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="color" class="form-label">Bootstrap Class Color</label>
                    <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $technology->color) }}" minlength="5" maxlength="20" required>
                    <small class="text-muted">Inserisci il nome della classe bootstrap per cambiare colore</small>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-2">
            <button type="submit" class="btn btn-success w-25">Salva</button>
        </div>
    </form>
</div>
<a href="{{ route('admin.technologies.index') }}" class="btn btn-primary mt-3">Torna Indietro</a>
