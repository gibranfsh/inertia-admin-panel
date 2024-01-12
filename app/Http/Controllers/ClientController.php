<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Clients', [
            'clients' => ClientResource::collection(Client::all())
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
