<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.index', [
            'projects' => Project::all()
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

        $project->save();
        return redirect('project')->with('success', 'Berhasil menambahkan data.');;
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

        $project->save();
        return redirect('project')->with('success', 'Berhasil menyimpan data.');
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
}
