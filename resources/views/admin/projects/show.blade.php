@extends('layouts.dashboard')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{ $project->name }}</h2>
                <p>{{ $project->slug }}</p>
                <p>{{ $project->description }}</p>
                <p>{{ $project->category ? $project->category->name : 'Nessuna Categoria' }}</p>
                <img src="{{ asset('./storage/' . $project->project_image) }}" alt="{{ $project->name }}">
            </div>
        </div>
    </div>
@endsection
