<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contato extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cliente_id',
        'nome_contato',
        'email_contato',
        'fone_contato',
        'cpf'
    ];

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => preg_replace(
                '/^(\d{3})(\d{3})(\d{3})(\d{2})$/',
                '$1.$2.$3-$4',
                $value
            ),
        );
    }

    protected function foneContato(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => preg_replace(
                '/^(\d{2})(\d{5})(\d{4})$/',
                '($1)$2-$3',
                $value
            ),
        );
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id')->withTrashed();
    }
}
