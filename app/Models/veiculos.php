<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculos extends Model
{
    use HasFactory;
    protected $fillable = [
        'placa',
        'modelo',
        'cor',
        'tipo',
        'user_id'
    ];

    public function usuario(){
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
