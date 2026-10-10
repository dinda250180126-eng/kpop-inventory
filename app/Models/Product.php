<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'category',
        'category_id',
        'price',
        'stock',
    ];

    // Relasi ke Category
    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi Many-to-Many ke Supplier
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'product_supplier');
    }

    // Relasi ke Transaksi Stok
    public function transactions()
    {
        return $this->hasMany(StockTransaction::class);
    }
}