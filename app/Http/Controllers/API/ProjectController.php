<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Throwable;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $parents = Project::all();
        return response()->json([
            $parents
        ]);
    }


    public function show(Project $project)
    {
        return response()->json([
            $project
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            Project::create(array_merge($request->all(), ['user_id' =>  $request->user()->id]))
        ]);
    }


    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        return response()->json([
            $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return response()->json(['message' => 'deleted']);
        } catch (Throwable $e) {
            return response()->json(['error' => 'something went wrong'], 400);
        }
    }
}
