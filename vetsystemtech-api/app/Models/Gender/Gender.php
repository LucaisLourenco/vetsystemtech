<?php

namespace App\Models\Gender;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use HasFactory, SoftDeletes;

    public static string $id = 'id';
    public static string $name = 'name';

    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];

    public function insertIfDoesNotExist()
    {
        return static::firstOrCreate($this->getAttributes());
    }
}
