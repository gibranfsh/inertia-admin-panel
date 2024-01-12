<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ClientResource;
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
            'client' => new ClientResource($client),
            'projects' => ProjectResource::collection($projects)
        ]);
    }

    /**
     * Create a new project.
     *
     * @param  int  $idClient
     * @param  ProjectCreateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws HttpResponseException
     */
    public function create(int $idClient, ProjectCreateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $client = Client::findOrFail($idClient);

        $data = $request->validated();
        $project = new Project($data);
        $project->client_id = $client->id;
        $project->save();

        return to_route('clients.projects.index', $client->id)->with('message', 'Project created successfully!');
    }

    /**
     * Update a specific project by client ID and project ID.
     *
     * @param  int  $idClient
     * @param  int  $idProject
     * @param  ProjectUpdateRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws HttpResponseException
     */
    public function update(int $idClient, int $idProject, ProjectUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        Client::findOrFail($idClient);
        $project = Project::findOrFail($idProject);

        $data = $request->validated();
        $project->fill($data);
        $project->save();

        return to_route('clients.projects.index', $idClient)->with('message', 'Project updated successfully!');
    }

    /**
     * Delete a specific project by client ID and project ID.
     *
     * @param  int  $idClient
     * @param  int  $idProject
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws HttpResponseException
     */
    public function delete(int $idClient, int $idProject): \Illuminate\Http\RedirectResponse
    {
        Client::findOrFail($idClient);
        $project = Project::findOrFail($idProject);

        $project->delete();

        return to_route('clients.projects.index', $idClient)->with('message', 'Project deleted successfully!');
    }
}
