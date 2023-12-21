<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subpage extends Model
{
    use HasFactory;

     // The table associated with the model.
     protected $table = 'subpages';

     // The attributes that are mass assignable.
     protected $fillable = [
         'title',
         'description',
         'owner_id'
     ];
 
     /**
      * The user who authored the post.
      */
    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function subscribers() {
        return $this->belongsToMany(User::class, 'subscriptions');
    }

}
