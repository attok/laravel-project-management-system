<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Http\Request;

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
        $project = new Project();
        $validated = $project->validate($request, 'project/create');
        $project->loadData($validated);
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
        $validated = $project->validate($request, 'project/' . $project . '/edit');
        $project->loadData($validated);
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
        $projectTask = new ProjectTask();

        $validated = $projectTask->validate($request, 'project/' . $project->id);
        $projectTask->loadData($validated);
        $projectTask->project_id = $project->id;
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
        $validated = $projectTask->validate($request, 'project/' . $project->id . '/edit-task/' . $projectTask->id);
        $projectTask->loadData($validated);
        $projectTask->save();

        return redirect('project/' . $project->id)->with('success', 'Berhasil menyimpan task.');
    }

    public function deleteTask(Project $project, ProjectTask $projectTask)
    {
        $projectTask->delete();
        return redirect('project/' . $project->id)->with('success', 'Berhasil menghapus data.');;
    }
}
