<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            'clients' => Client::all()
        ]);
    }

    /**
     * Create a new client.
     *
     * @param  ClientCreateRequest  $request
     * @return JsonResponse
     */
    public function create(ClientCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        $client = new Client($data);
        $client->save();

        return (new ClientResource($client))->response()->setStatusCode(201);
    }

    /**
     * Update a client by id.
     *
     * @param  int  $id
     * @param  ClientUpdateRequest  $request
     * @return ClientResource
     *
     * @throws HttpResponseException
     */
    public function update(int $id, ClientUpdateRequest $request): ClientResource
    {
        $client = Client::findOrFail($id);

        $data = $request->validated();
        $client->fill($data);
        $client->save();

        return new ClientResource($client);
    }

    /**
     * Delete a client by id.
     *
     * @param  int  $id
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function delete(int $id): JsonResponse
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return response()->json([
            "message" => "Client successfully deleted."
        ])->setStatusCode(200);
    }
}
