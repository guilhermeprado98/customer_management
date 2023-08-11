<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'email', 'telefone', 'tipo_cliente', 'vendedores'];

    public function image()
    {
        return $this->hasOne(CustomerImage::class);
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class);
    }

    public function scopeSearchByName($query, $name)
    {
        return $query->where('name', 'like', "%$name%");
    }
}
