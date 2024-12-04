@extends('layouts.default')

@section('content')
    <div class="container">
        <h2>Formulário de Cliente</h2>
        <form action="{{ route('clientes.store') }}" method="POST" id="form_cliente_cadastro">
            @csrf
            <div class="row">
                <!-- Nome -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}"
                            required>

                        @error('nome')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- CNPJ -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="{{ old('cnpj') }}"
                            required>

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
                            value="{{ old('endereco') }}" required>

                        @error('endereco')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
@endsection
