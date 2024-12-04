@extends('layouts.default')

@section('content')
    <div class="mt-3 col-md-12">
        <h2>Clientes</h2>
        <div class="col-md-12 row mt-3">
            <div class="col-md-6">
                <a href="{{ route('clientes.create') }}" class="btn btn-primary">Novo Cliente</a>
            </div>
            <div class="col-md-6 mt-3">
                <form class="form-horizontal" method="GET" action="#">
                    <label for="search">Pesquisar</label>
                    <input type="text" name="search" value="{{ request('search') }}">
                </form>
            </div>
        </div>
        <div class="table-responsive small mt-3">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td style="white-space: nowrap;">{{ $cliente->nome }}</td>
                            <td style="white-space: nowrap;">{{ $cliente->cnpj }}</td>
                            <td style="white-space: nowrap;">{{ $cliente->endereco }}</td>
                            <td class="d-flex justify-content-center align-items-center gap-1">
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-sm"
                                    title="Editar Cliente">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $cliente->id }}" title="Excluir Cliente">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Nenhum Registro encontrado.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $clientes->links() }}
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Remoção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja remover este cliente?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Remover</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#deleteModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let action = '/clientes/' + button.data('id');

                $('#deleteForm').attr('action', action);
            });

        });
    </script>
@endpush
