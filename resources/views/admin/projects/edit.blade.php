@extends('layouts.dashboard')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Modifica Progetto</h2>
            </div>
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.projects.update', $project->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <label class="control-label">Nome Progetto</label>
                            <input type="text" name="name" class="form-control form-control-sm"
                                value="{{ old('name', $project->name) }}" placeholder="Nome Progetto">
                        </div>
                        <div class="col-12 py-3">
                            <label for="" class="control-label">Foto Progetto</label>
                            <input type="file" name="project_image" id="project_image">
                            @if ($project->project_image)
                                <div class="mt-2">
                                    <img src="{{ filter_var($project->project_image, FILTER_VALIDATE_URL) ? $project->project_image : asset('storage/' . $project->project_image) }}"
                                        alt="Project Image" style="width: 200px;">
                                </div>
                            @else
                                <div class="mt-2">
                                    <img src="https://picsum.photos/200/300" alt="Default Image" style="width: 200px;">
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="" class="control-label">Descrizione Progetto</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control form-control-sm">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-sm btn-primary">Aggiorna</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
