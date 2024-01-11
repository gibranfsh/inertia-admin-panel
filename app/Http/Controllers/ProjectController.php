<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index(int $idClient)
    {
        $client = Client::findOrFail($idClient);

        $projects = $client->projects;

        return Inertia::render('Projects', [
            'client' => $client,
            'projects' => $projects,
        ]);
    }
}
