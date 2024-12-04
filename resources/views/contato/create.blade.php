@extends('layouts.default')

@push('scripts')
    <link href="{{ URL::asset('css/suggestions.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <h2>Formulário de Contato</h2>
        <form action="{{ route('contatos.store') }}" method="POST" class="form_contato">
            @csrf
            <div class="row">

                <!-- Nome -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome_contato" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome_contato" name="nome_contato"
                            value="{{ old('nome_contato') }}" required>

                        @error('nome_contato')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email_contato" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_contato" name="email_contato"
                            value="{{ old('email_contato') }}" required>

                        @error('email_contato')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Fone -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fone_contato" class="form-label">Fone</label>
                        <input type="text" class="form-control fone_contato" id="fone_contato" name="fone_contato"
                            value="{{ old('fone_contato') }}" required>

                        @error('fone_contato')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Fone -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control cpf" id="cpf" name="cpf"
                            value="{{ old('cpf') }}" required>

                        @error('cpf')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Clientes -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cliente" class="form-label">Pesquisar Cliente:</label>
                        <input type="text" class="form-control" id="cliente" name="cliente"
                            placeholder="Digite o nome do cliente" required value="{{ old('cliente') }}"
                            autocomplete="off">

                        <ul class="col-md-6" id="suggestions"
                            style="border: 1px solid #ddd; list-style: none; margin-top: 5px; padding: 0; display: none;">
                        </ul>

                        <input type="hidden" id="cliente_id" name="cliente_id" value="{{ old('cliente_id') }}">
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('js/form-contato.js') }}"></script>
@endpush
