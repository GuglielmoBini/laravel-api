<div class="card p-4 shadow">
    @if ($project->exists)
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" novalidate>
    @method('PUT')
    @else    
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @endif
    @csrf
        <div class="row">
            <div class="col-9">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome Progetto</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}" minlength="5" maxlength="50" required>
                    <small class="text-muted">Inserisci il nome del progetto</small>
                  </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="type_id" class="form-label">Tipo</label>
                    <select class="form-select" id="type_id" name="type_id">
                        <option value="">--</option>
                        @foreach ($types as $type)
                        <option @if(old('type_id', $project->type_id) == $type->id) selected @endif value="{{ $type->id }}">{{ $type->label }}</option>
                        @endforeach
                      </select>
                    <small class="text-muted">Scegli la tipologia</small>
                  </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="description" rows="7" name="description" required>{{ old('description', $project->description) }}</textarea>
                    <small class="text-muted">Inserisci una descrizione del progetto</small>
                  </div>
            </div>
            <div class="col-5">
                <div class="mb-3">
                    <label for="project_url" class="form-label">Link Progetto</label>
                    <input type="text" class="form-control" id="project_url" name="project_url" value="{{ old('project_url', $project->project_url) }}" required>
                    <small class="text-muted">Inserisci il link del progetto</small>
                  </div>
            </div>
            <div class="col-5">
                <div class="mb-3">
                    <label for="image_url" class="form-label">Carica Immagine</label>
                    <input type="file" class="form-control" id="image_url" name="image_url">
                    <small class="text-muted">Scegli un'immagine per il tuo progetto</small>
                  </div>
            </div>
            <div class="col-2">
                <img id="img-preview" class="img-fluid" src="{{ $project->image_url ? asset('storage/' . $project->image_url) : 'https://marcolanci.it/utils/placeholder.jpg' }}" alt="preview">
            </div>
            <div class="col-12 mb-3">
                <h5 class="mb-3">Tecnologie utilizzate</h5>
                @foreach ($technologies as $technology)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tech-{{ $loop->iteration }}" value="{{ $technology->id }}" name="technologies[]" @if(in_array($technology->id, old('technologies', $project_technologies ?? []))) checked @endif>
                    <label class="form-check-label" for="tech-{{ $loop->iteration }}">{{ $technology->label }}</label>
                  </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center my-3">
            <button type="submit" class="btn btn-success w-25">Salva</button>
        </div>
    </form>
</div>
<a href="{{ route('admin.projects.index') }}" class="btn btn-primary mt-3">Torna Indietro</a>

@section('scripts')
    <script>
        const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';

        const imageInput = document.getElementById('image_url');
        const imagePreview = document.getElementById('img-preview');

        imageInput.addEventListener('change', () => {
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imageInput.files[0]);
                reader.onload = e => {
                    imagePreview.setAttribute('src', e.target.result);
                }
            } else imagePreview.setAttribute('src', placeholder);
        });
    </script>
@endsection