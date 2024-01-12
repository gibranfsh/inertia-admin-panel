<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        $searchTerm = $request->input('search');

        $clients = Client::when($searchTerm, function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('email', 'like', "%{$searchTerm}%")
                ->orWhere('phone', 'like', "%{$searchTerm}%");
        })->get();

        return Inertia::render('Clients', [
            'clients' => ClientResource::collection($clients),
            'searchTerm' => $searchTerm,
        ]);
    }

    /**
     * Create a new client.
     *
     * @param  ClientCreateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(ClientCreateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        $client = new Client($data);
        $client->save();

        return to_route('clients.index')->with('message', 'Client created successfully!');
    }

    /**
     * Update a client by id.
     *
     * @param  int  $id
     * @param  ClientUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws HttpResponseException
     */
    public function update(int $id, ClientUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $client = Client::findOrFail($id);

        $data = $request->validated();
        $client->fill($data);
        $client->save();

        return to_route('clients.index')->with('message', 'Client updated successfully!');
    }

    /**
     * Delete a client by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function delete(int $id): \Illuminate\Http\RedirectResponse
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return to_route('clients.index')->with('message', 'Client deleted successfully!');
    }
}
