<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ownerable_id', 'ownerable_type'];

    public function owner()
    {
        return $this->morphTo();
    }
}
