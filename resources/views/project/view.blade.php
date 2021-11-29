<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project') }} /
            {{ __('View : ') . $project->name }}
        </h2>
    </x-slot>

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

    <h4 class="text-xl mb-3 font-bold">Veiw Project</h4>

    <div class="flex mb-4">
        <a href="{{ url('project/' . $project->id . '/edit') }}" class="btn btn-primary mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg> Edit
        </a>
        <form method="POST" action="{{ url('/project/' . $project->id) }}">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg> Delete
            </button>
        </form>
    </div>
    <div class="card mb-4">
        <h3 class="card-title">{{ $project->name }}</h3>

        <div class="mb-2">
            <x-status-project status="{{ $project->status }}"></x-status-project>
        </div>
        <p>{{ $project->description }}</p>
        <div class="mb-4">
            Start Date : {{ $project->startDate }}<br />
            Due Date : {{ $project->endDate }}
        </div>
    </div>

    <div class="card mb-4">
        <h3 class="card-title">Project Tasks</h3>
        <div class="mb-4" x-data="{open:  false}">
            <button class="btn btn-primary" @click="open = !open">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Task
            </button>

            <div x-show="open" class="p-3 border bg-gray-100 mt-1 mb-3">
                @include("project.form_task")
            </div>

        </div>
        <div class="block w-full overflow-x-auto">
            <table class="items-center bg-transparent w-full border-collapse ">
                <thead>
                    <tr>
                        <th
                            class="w-10 bg-blueGray-50  px-6 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            #</th>
                        <th
                            class="bg-blueGray-50  px-6 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Task</th>
                        <th
                            class="bg-blueGray-50  px-6 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            Description</th>
                        <th
                            class="bg-blueGray-50  px-6 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            Status</th>
                        <th
                            class="bg-blueGray-50  px-6 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $projectTasks = $project->projectTasks;
                    @endphp
                    @if (count($projectTasks) > 0)
                        @foreach ($projectTasks as $task)
                            <tr class="hover:bg-gray-100">
                                <td
                                    class="border-t-0 px-6 text-center align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                    {{ $loop->index + 1 }}</td>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                    {{ $task->title }}</td>
                                <td
                                    class="border-t-0 px-6 text-left align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                    {{ $task->description }}</td>
                                <td
                                    class="border-t-0 px-6 text-center align-middle border-l-0 border-r-0 whitespace-nowrap p-4">

                                    <x-status-project status="{{ $task->status }}"></x-status-project>
                                </td>
                                <td
                                    class="w-40 border-t-0 px-6 text-center align-middle border-l-0 border-r-0 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        <a href="{{ url('project/' . $project->id . '/edit-task/' . $task->id) }}"
                                            class="btn btn-primary mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form method="POST"
                                            action="{{ url('/project/' . $project->id . '/delete-task/' . $task->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="hover:bg-gray-100">
                            <td colspan="5"
                                class="border-t-0 px-6 text-center align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                Tidak ada data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
