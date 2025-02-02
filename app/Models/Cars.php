<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model {

    // Nome da tabela que esse modelo referencia
    protected $table = 'cars';

    // Campos que virão no POST que realmente tem que ser inseridos no banco. Evita SQL Injection.
    protected $fillable = [
        'name',
        'description',
        'model',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    // Quando utilizamos Laravel e/ou Lumen, temos a opção de utilizar migrations, é uma forma de fazer o controle de versão da base de dados, neste exemplo, não utilizaremos, então desabilitaremos. Por padrão, ele cria as colunas: created_at, updated_at, deleted_at
    public $timestamps = false;

}
