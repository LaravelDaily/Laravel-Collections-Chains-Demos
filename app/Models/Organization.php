<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function repositories()
    {
        return $this->morphMany(Repository::class, 'owner');
    }

    public function members()
    {
        return $this->hasMany(User::class, 'organization_id');
    }
}
