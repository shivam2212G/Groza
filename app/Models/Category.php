<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
    'category_name',
    'category_image',
    'category_description',
    'admin_id',
    ];

    public function subcategories()
    {
    return $this->hasMany(Subcategory::class, 'category_id', 'category_id');
    }


}
