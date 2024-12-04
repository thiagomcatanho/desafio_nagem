@extends('layouts.default')

@section('content')
    <div class="container">
        <h2>Formulário de Contato</h2>
        <form action="{{ route('clientes.update', $cliente) }}" method="POST" id="form_cliente_alteracao">
            @csrf
            @method('patch')
            <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
            <div class="row">
                <!-- Nome -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome"
                            value="{{ old('nome') ?? $cliente->nome }}" required>

                        @error('nome')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- CNPJ -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" class="form-control cnpj" id="cnpj" name="cnpj"
                            value="{{ old('cnpj') ?? $cliente->cnpj }}" required>

                        @error('cnpj')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Endereço -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" maxlength="100"
                            value="{{ old('cnpj') ?? $cliente->endereco }}" required>

                        @error('endereco')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
@endsection
