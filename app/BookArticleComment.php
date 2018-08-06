<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookArticleComment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'aid', 'email', 'username', 'website', 'content'
    ];
}
