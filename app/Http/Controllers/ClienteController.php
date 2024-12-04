<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Repositories\ClienteRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ClienteController extends Controller
{
    public function __construct(private ClienteRepository $repository) {}

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('cliente.index')
            ->with('clientes', $this->repository->getAllPaginated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ClienteStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ClienteStoreRequest $request): RedirectResponse
    {
        $this->repository->store($request->validated());

        return redirect(route('clientes.index'))
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cliente $cliente
     *
     * @return \Illuminate\View\View
     */
    public function edit(Cliente $cliente): View
    {
        return view('cliente.edit')
            ->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\ClienteUpdateRequest $request
     * @param \App\Models\Cliente $cliente
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ClienteUpdateRequest $request, Cliente $cliente): RedirectResponse
    {
        $this->repository->update($request->validated(), $cliente->id);

        return redirect(route('clientes.index'))->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cliente $cliente
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cliente $cliente): RedirectResponse
    {
        $this->repository->destroy($cliente->id);

        return redirect(route('clientes.index'))->with('success', 'Cliente excluído com sucesso!');
    }

    /**
     * Search for clients based on a given term.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        $clientes = $this->repository->getAllPaginated(search: request('search'));

        return response()->json($clientes->items());
    }
}
