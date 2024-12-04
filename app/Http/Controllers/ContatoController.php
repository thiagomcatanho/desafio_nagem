<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoStoreRequest;
use App\Http\Requests\ContatoUpdateRequest;
use App\Models\Contato;
use App\Repositories\ContatoRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContatoController extends Controller
{
    public function __construct(private ContatoRepository $repository) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('contato.index')
            ->with('contatos', $this->repository->getAllPaginated(search: request('search')));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('contato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ContatoStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContatoStoreRequest $request): RedirectResponse
    {
        $this->repository->store($request->validated());

        return redirect(route('contatos.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contato $contato
     * 
     * @return \Illuminate\View\View
     */
    public function edit(Contato $contato): View
    {
        return view('contato.edit')
            ->with('contato', $contato);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ContatoUpdateRequest $request
     * @param \App\Models\Contato $contato
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContatoUpdateRequest $request, Contato $contato): RedirectResponse
    {
        $this->repository->update($request->validated(), $contato->id);

        return redirect(route('contatos.index'))
            ->with('success', 'Contato atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contato $contato
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Contato $contato): RedirectResponse
    {
        $this->repository->destroy($contato->id);

        return redirect(route('contatos.index'))
            ->with('success', 'Cliente removido com sucesso!');
    }
}
