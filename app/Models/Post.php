<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    # specify table name
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'author_id',
        'description',
        'createdAt',
        'image'
    ];

    # relation Author
    function author(){ # define track property
        return $this->belongsTo(Author::class);
        # select * from tracks where id = $this->track_id;
        ## relation --> with track object
    }


    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
