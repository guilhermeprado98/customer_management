<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Customer extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'email', 'image_path', 'telefone', 'tipo_cliente', 'vendedores'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($customer) {
            $customer->sellers()->detach();
        });
    }

    public function image()
    {
        return $this->hasOne(CustomerImage::class);
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'customer_seller', 'customer_id', 'seller_id');
    }

    public function scopeSearchByName($query, $name)
    {
        return $query->where('name', 'like', "%$name%");
    }

    public function resultsFetched(array $customers)
    {
        $this->results = $customers;
    }

    public function updateVendedores()
    {
        $vendedorIds = $this->sellers()->pluck('id')->toArray();
        $this->vendedores = implode(',', $vendedorIds);
        $this->save();

    }

    public function getFormattedVendedoresAttribute()
    {
        return $this->sellers->pluck('name')->implode(', ');
    }

    public function setImageAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            $this->attributes['image_path'] = $value->hashName(); // Usar o nome gerado aleatoriamente pela imagem
        }
    }

    public function getImagePathAttribute($value)
    {

        return asset('storage/' . $value);
    }

}
