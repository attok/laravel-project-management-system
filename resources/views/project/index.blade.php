<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project List') }}
        </h2>
    </x-slot>

    <div class="mb-4">
        <a href="{{ url('project/create') }}" class="btn btn-primary">
            Tambah Project
        </a>
    </div>
    @foreach ($projects as $project)
        <div class="card mb-4">
            <h3 class="card-title">{{ $project->name }}</h3>
            <p>{{ $project->description }}</p>
            <div class="mb-4">
                Start Date : {{ $project->startDate }}<br />
                Due Date : {{ $project->endDate }}
            </div>

            <div class="flex">
                <a href="{{ url('project/' . $project->id . '/edit') }}" class="btn mr-2">
                    Edit Project
                </a>
                <form method="POST" action="{{ url('/project/' . $project->id) }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn"
                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        Delete Project
                    </button>
                </form>
            </div>

        </div>
    @endforeach
</x-app-layout>
