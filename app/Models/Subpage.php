<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subpage extends Model
{
    use HasFactory;

     // The table associated with the model.
     protected $table = 'posts';

     // The attributes that are mass assignable.
     protected $fillable = [
         'title',
         'description',
         'user_id', // Make sure this is the name of the foreign key column for the user.
     ];
 
     /**
      * The user who authored the post.
      */
     public function user()
     {
         return $this->belongsTo(User::class);
     }
     
     public function comments()
     {
         return $this->hasMany(Comment::class);
     }

}
