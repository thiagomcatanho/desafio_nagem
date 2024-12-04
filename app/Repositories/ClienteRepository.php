<?php

namespace App\Repositories;

use App\Models\Cliente;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClienteRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Cliente::class);
    }

    /**
     * Retrieves a paginated list of "clientes" with optional search filtering.
     *
     * @param int $perPage
     * @param string|null $search
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($perPage = 10, $search = null): LengthAwarePaginator
    {
        return $this->model::query()
            ->when($search, function ($query, $term) {
                $query->where(function ($query) use ($term) {
                    $query->where('nome', 'like', "%{$term}%")
                        ->orWhere('cnpj', 'like', "%{$term}%")
                        ->orWhere('endereco', 'like', "%{$term}%");
                });
            })
            ->whereNull('deleted_at')
            ->paginate($perPage);
    }
}
