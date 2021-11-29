<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(2);
        $projects->withPath('/project');
        return view('project.index', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Project();
        return view('project.create', [
            'model' => $model
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'startDate' => 'date|required',
            'endDate' => 'date',
            'status' => Rule::in(array_keys(Project::getStatusList()))
        ], [
            'max' => 'max panjang 255 karakter.',
            'required' => 'Field :attribute tidak boleh kosong.',
            'date' => 'format tanggal tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect('project/create')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $project = new Project();
        $project->name = $validated['name'];
        $project->description = $validated['description'];
        $project->startDate = $validated['startDate'];
        $project->endDate = $validated['endDate'];
        $project->status = $validated['status'];

        $project->save();
        return redirect('project')->with('success', 'Berhasil menambahkan data.');;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('project.view', [
            'project' => $project
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('project.edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'startDate' => 'date|required',
            'endDate' => 'date',
            'status' => Rule::in(array_keys(Project::getStatusList()))
        ], [
            'max' => 'max panjang 255 karakter.',
            'required' => 'Field :attribute tidak boleh kosong.',
            'date' => 'format tanggal tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect('project/create')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $project->name = $validated['name'];
        $project->description = $validated['description'];
        $project->startDate = $validated['startDate'];
        $project->endDate = $validated['endDate'];
        $project->status = $validated['status'];

        $project->save();
        return redirect('project/' . $project->id)->with('success', 'Berhasil menyimpan data.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect('project')->with('success', 'Berhasil menghapus data.');;
    }



    ##### TASK
    public function addTask(Project $project, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'string',
            'status' => Rule::in(array_keys(ProjectTask::getStatusList()))
        ], [
            'max' => 'max panjang 255 karakter.',
            'required' => 'Field :attribute tidak boleh kosong.',
            'in' => 'Tidak valid',
            'string' => 'Tidak valid',
        ]);


        if ($validator->fails()) {
            return redirect('project/' . $project->id)
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $projectTask = new ProjectTask();
        $projectTask->project_id = $project->id;
        $projectTask->title = $validated['title'];
        $projectTask->description = $validated['description'];
        $projectTask->status = $validated['status'];
        $projectTask->save();


        return redirect('project/' . $project->id)->with('success', 'Berhasil menambahkan task.');
    }

    public function editTask(Project $project, ProjectTask $projectTask)
    {
        return view('project.edit_task', [
            'project' => $project,
            'projectTask' => $projectTask
        ]);
    }

    public function updateTask(Project $project, ProjectTask $projectTask, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'string',
            'status' => Rule::in(array_keys(ProjectTask::getStatusList()))
        ], [
            'max' => 'max panjang 255 karakter.',
            'required' => 'Field :attribute tidak boleh kosong.',
            'in' => 'Tidak valid',
            'string' => 'Tidak valid',
        ]);


        if ($validator->fails()) {
            return redirect('project/' . $project->id . '/edit-task/' . $projectTask->id)
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $projectTask->title = $validated['title'];
        $projectTask->description = $validated['description'];
        $projectTask->status = $validated['status'];
        $projectTask->save();

        return redirect('project/' . $project->id)->with('success', 'Berhasil menyimpan task.');
    }

    public function deleteTask(Project $project, ProjectTask $projectTask)
    {
        $projectTask->delete();
        return redirect('project/' . $project->id)->with('success', 'Berhasil menghapus data.');;
    }
}
