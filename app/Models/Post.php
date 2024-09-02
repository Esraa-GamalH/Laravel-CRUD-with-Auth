<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

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
        'image',
        'creator_id'
    ];

    # relation Author
    function author(){ # define author property
        return $this->belongsTo(Author::class);
        ## relation --> with author object
    }

    function creator(){ # define creator property
        return $this->belongsTo(User::class);
        ## relation --> with creator object
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getHumanReadableDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('l, F j, Y \a\t g:i A');
    }

}
