<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'cnpj',
        'endereco'
    ];

    public function contatos(): HasMany
    {
        return $this->hasMany(Contato::class, 'id_cliente');
    }
}
