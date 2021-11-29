<form method="POST" action="{{ url('project/' . $project->id . '/add-task') }}">
    @csrf
    <div class="mb-4">
        <label for="project-title" class="block">Title</label>
        <input name="title" type="text" value="{{ old('title') }}" class="rounded" id="project-title" />

        @error('title')
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

    <div class="mb-4">
        <label for="project-status" class="block">Status</label>
        <select name="status" class="rounded" id="project-status">
            @foreach (App\Models\ProjectTask::getStatusList() as $code => $status)
                <option value="{{ $code }}" {{ $code == old('status') ? 'selected' : '' }}>{{ $status }}
                </option>
            @endforeach
        </select>

        @error('status')
            <div class="text-red-700">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
