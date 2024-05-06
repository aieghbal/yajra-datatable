<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Scopes\isActiveScope;    //global scope

use Illuminate\Database\Eloquent\Builder;   //local scope

use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','description','category_id','isActive'
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class,'taggable','');
    }

    //global scope
    protected static function booted(): void
    {
        static::addGlobalScope(new isActiveScope());
    }

    //local scope
    public function scopePopular(Builder $query,$id): void
    {
        $query->where('id', '=', $id);
    }


    //mutator description
    protected function description(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                if (strlen($value) >= 30) {
                    $value = mb_substr($value, 0, 29, 'UTF-8') . '***';
                }
                return $value;
            }
        );
    }
}
