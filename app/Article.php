<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @property int $id
 * @property int $type
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    protected $fillable = [
        'title', 'type', 'content',
    ];

    /**
     * 获取下一篇文章
     * @return object
     */
    public function getNextAttribute()
    {
        return $this->where('type',1)->where('id', '>', $this->id)->orderBy('id', 'asc')->first(['id', 'title']);
    }

    /**
     * 获取上一篇文章
     * @return object
     */
    public function getPreAttribute()
    {
        return $this->where('type',1)->where('id', '<', $this->id)->orderBy('id', 'desc')->first(['id', 'title']);
    }

}
