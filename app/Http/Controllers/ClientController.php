<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Country;
use App\Models\Invoice;
use App\Repositories\ClientRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ClientController extends AppBaseController
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @param  ClientRepository  $clientRepo
     */
    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepository = $clientRepo;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        return view('clients.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id');

        return view('clients.create', compact('countries'));
    }

    /**
     * @param  CreateClientRequest  $request
     * @return RedirectResponse
     */
    public function store(CreateClientRequest $request): RedirectResponse
    {
        $input = $request->all();
        try {
            $this->clientRepository->store($input);
            Flash::success('Client created successfully.');
        } catch (Exception $exception) {
            Flash::error($exception->getMessage());

            return redirect()->route('clients.create')->withInput();
        }

        return redirect()->route('clients.index');
    }

    /**
     * @param  Client  $client
     * @param  Request  $request
     * @return Application|Factory|View
     */
    public function show(Client $client, Request $request)
    {
        $client->load('user.media', 'invoices.payments');
        $activeTab = $request->get('Active', 'overview');

        return view('clients.show', compact('client', 'activeTab'));
    }

    /**
     * @param  Client  $client
     * @return Application|Factory|View
     */
    public function edit(Client $client)
    {
        $countries = Country::pluck('name', 'id');
        $client->load('user.media');

        return view('clients.edit', compact('client', 'countries'));
    }

    /**
     * @param  Client  $client
     * @param  UpdateClientRequest  $request
     * @return RedirectResponse
     */
    public function update(Client $client, UpdateClientRequest $request): RedirectResponse
    {
        $input = $request->all();
        $client->load('user');

        try {
            $this->clientRepository->update($input, $client);
            Flash::success('Client updated successfully.');
        } catch (Exception $exception) {
            Flash::error($exception->getMessage());

            return redirect()->back()->withInput();
        }

        return redirect()->route('clients.index');
    }

    /**
     * @param  Client  $client
     * @return JsonResponse
     */
    public function destroy(Client $client): JsonResponse
    {
        $invoiceModels = [
            Invoice::class,
        ];
        $result = canDelete($invoiceModels, 'client_id', $client->id);
        if ($result) {
            return $this->sendError(__('messages.flash.client_cant_deleted'));
        }
        $client->user()->delete();
        $client->delete();

        return $this->sendSuccess('Client Deleted successfully.');
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function getStates(Request $request)
    {
        $countryId = $request->get('countryId');
        $states = getStates($countryId);

        return $this->sendResponse($states, 'States retrieved successfully');
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $stateId = $request->get('stateId');
        $cities = getCities($stateId);

        return $this->sendResponse($cities, 'Cities retrieved successfully');
    }
}
