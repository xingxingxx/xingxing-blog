<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\BookArticle
 *
 * @property int $id
 * @property int $book_id
 * @property int $parent_id
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read object $next
 * @property-read object $pre
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\BookArticle onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BookArticle whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BookArticle whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BookArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BookArticle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BookArticle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BookArticle whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BookArticle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BookArticle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BookArticle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\BookArticle withoutTrashed()
 * @mixin \Eloquent
 */
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
