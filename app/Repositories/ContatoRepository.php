<?php

namespace App\Repositories;

use App\Models\Contato;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ContatoRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Contato::class);
    }

    /**
     * Retrieves a paginated list of "contatos" with optional search filtering.
     *
     * @param int $perPage
     * @param string|null $search
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPaginated($perPage = 10, $search = null): LengthAwarePaginator
    {
        $page = request('page', 1);
        $offset = ($page - 1) * $perPage;

        $sql = "SELECT
                    c.*,
                    (CASE WHEN cli.deleted_at IS NOT NULL THEN cli.nome || ' (excluído)' ELSE cli.nome END) cliente_nome
                FROM contatos c
                INNER JOIN clientes cli ON c.cliente_id = cli.id
                WHERE c.deleted_at IS NULL";

        if ($search) {
            $sql .= " AND (
                c.nome_contato LIKE '%$search%'
                OR c.email_contato LIKE '%$search%'
                OR c.fone_contato LIKE '%$search%'
                OR c.cpf LIKE '%$search%'
                OR cli.nome LIKE '%$search%'
            )";
        }

        $countSql = "SELECT COUNT(*) as total FROM ($sql) as sub";
        $total = DB::selectOne($countSql)->total;

        $sql .= " LIMIT $perPage OFFSET $offset";

        $results = DB::select($sql);

        return new LengthAwarePaginator(
            $results,
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

}
