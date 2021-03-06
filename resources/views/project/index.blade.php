<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Project') }}
        </h2>
    </x-slot>

    <div class="mb-4 flex">
        <a href="{{ url('project/create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
            Tambah Project
        </a>
    </div>
    @foreach ($projects as $project)
        <div class="card mb-4">
            <h3 class="card-title">{{ $project->name }}</h3>
            <div class="mb-2">
                <x-status-project status="{{ $project->status }}"></x-status-project>
            </div>
            <p>{{ $project->description }}</p>
            <div class=" mb-4">
                Start Date : {{ $project->startDate }}<br />
                Due Date : {{ $project->endDate }}
            </div>

            <div class="flex">
                <a href="{{ url('project/' . $project->id . '') }}" class="btn btn-info mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd"
                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="{{ url('project/' . $project->id . '/edit') }}" class="btn btn-primary mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </a>
                <form method="POST" action="{{ url('/project/' . $project->id) }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger"
                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    @endforeach


    {{ $projects->links() }}
</x-app-layout>
