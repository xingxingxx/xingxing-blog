<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookArticle extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'book_id', 'parent_id', 'content',
    ];

    /**
     * 获取下一篇文章
     * @return object
     */
    public function getNextAttribute()
    {
        return $this->where('book_id', $this->book_id)->where('id', '>', $this->id)->orderBy('id', 'asc')->first(['id', 'title','book_id']);
    }

    /**
     * 获取上一篇文章
     * @return object
     */
    public function getPreAttribute()
    {
        return $this->where('book_id', $this->book_id)->where('id', '<', $this->id)->orderBy('id', 'desc')->first(['id', 'title','book_id']);
    }
}
