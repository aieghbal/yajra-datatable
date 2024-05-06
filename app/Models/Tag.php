<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
class Tag extends Model
{
    use HasFactory;
    public function articles(): MorphToMany
    {

        return $this->morphedByMany(Article::class,'taggable');
    }
}
