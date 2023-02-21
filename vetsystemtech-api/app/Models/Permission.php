<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['role_id', 'resource_id'];

    public function resource() {
        return $this->belongsTo('\App\Models\Resource');
    }

    public function role() {
        return $this->belongsTo('\App\Models\Role');
    }
}
