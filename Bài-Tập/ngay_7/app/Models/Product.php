<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * Các trường có thể được mass assignment
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url'
    ];

    /**
     * Các trường được cast sang kiểu dữ liệu cụ thể
     */
    protected $casts = [
        'price' => 'decimal:2', // Cast price thành decimal với 2 chữ số thập phân
    ];

    /**
     * Validation rules cho model
     */
    public static $rules = [
        'name' => 'required|string|max:255|unique:products,name',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image_url' => 'nullable|url'
    ];

    /**
     * Validation rules cho update (bỏ qua unique constraint cho chính record hiện tại)
     */
    public static function getUpdateRules($id)
    {
        return [
            'name' => 'required|string|max:255|unique:products,name,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url'
        ];
    }
}
