<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'nome',
        'cnpj',
        'endereco'
    ];

    protected function cnpj(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => preg_replace(
                '/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/',
                '$1.$2.$3/$4-$5',
                $value
            ),
        );
    }
}
