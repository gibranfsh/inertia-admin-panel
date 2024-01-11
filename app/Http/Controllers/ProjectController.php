<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     *
     * @param  int  $idClient
     * @return \Inertia\Response
     */
    public function index(int $idClient): \Inertia\Response
    {
        $client = Client::findOrFail($idClient);

        $projects = $client->projects;

        return Inertia::render('Projects', [
            'client' => $client,
            'projects' => $projects,
        ]);
    }

    /**
     * Create a new project.
     *
     * @param  int  $idClient
     * @param  ProjectCreateRequest  $request
     * @return JsonResponse
     *
     * @throws HttpResponseException
     */
    public function create(int $idClient, ProjectCreateRequest $request): JsonResponse
    {
        $client = Client::findOrFail($idClient);

        $data = $request->validated();
        $project = new Project($data);
        $project->client_id = $client->id;
        $project->save();

        return (new ProjectResource($project))->response()->setStatusCode(201);
    }

    /**
     * Update a specific project by client ID and project ID.
     *
     * @param  int  $idClient
     * @param  int  $idProject
     * @param  ProjectUpdateRequest  $request
     *
     * @return JsonResponse
     *
     * @throws HttpResponseException
     */
    public function update(int $idClient, int $idProject, ProjectUpdateRequest $request): JsonResponse
    {
        Client::findOrFail($idClient);
        $project = Project::findOrFail($idProject);

        $data = $request->validated();
        $project->fill($data);
        $project->save();

        return (new ProjectResource($project))->response()->setStatusCode(200);
    }

    /**
     * Delete a specific project by client ID and project ID.
     *
     * @param  int  $idClient
     * @param  int  $idProject
     *
     * @return JsonResponse
     *
     * @throws HttpResponseException
     */
    public function delete(int $idClient, int $idProject): JsonResponse
    {
        Client::findOrFail($idClient);
        $project = Project::findOrFail($idProject);

        $project->delete();

        return response()->json([
            "message" => "Project successfully deleted."
        ])->setStatusCode(200);
    }
}
