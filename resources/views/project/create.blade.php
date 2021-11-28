<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project') }} / {{ __('Create Project') }}
        </h2>
    </x-slot>

    <div>
        <div class="mb-4 flex">
            <a href="{{ url('project') }}" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>
        <hr />
        <br />

        <h4 class="text-xl mb-3 font-bold">Tambah Project</h4>
        <form method="POST" action="{{ url('project') }}">
            @csrf


            <div class="mb-4">
                <label for="project-title" class="block">Name</label>
                <input name="name" type="text" value="{{ old('name') }}" class="rounded" id="project-title" />

                @error('name')
                    <div class="text-red-700">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="project-description" class="block">Description</label>
                <textarea name="description" class="rounded w-1/2"
                    id="project-description">{{ old('description') }}</textarea>

                @error('description')
                    <div class="text-red-700">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 w-1/2 flex">
                <div class="mr-2">
                    <label for="project-startDate" class="block">Start Date</label>
                    <input name="startDate" value="{{ old('startDate') }}" type="date" class="rounded"
                        id="project-startDate" />

                    @error('startDate')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="project-endDate" class="block">End Date</label>
                    <input name="endDate" value="{{ old('endDate') }}" type="date" class="rounded"
                        id="project-endDate" />

                    @error('endDate')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</x-app-layout>
