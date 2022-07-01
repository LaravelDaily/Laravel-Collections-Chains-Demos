<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->description, $matches);

        return $matches[1];
    }
}
