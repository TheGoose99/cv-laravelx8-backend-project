<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // E fillable pentru toate coloanele, dar nu e tocmai safe:
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Mutator:
    public function setPostImageAttribute($value) {
        $this->attributes['post_image'] = asset('storage/'. $value);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Mutator:
    // public function setPostImageAttribute($value) {

    //     // Adaugam asset() la poze pentru a identifica pozele din public/images:
    //     $this->attributes['post_image'] = asset($value);

    // }

    // Accesor:
    // public function getPostImageAttribute($value) {
    //     return asset($value);
    // }
}
