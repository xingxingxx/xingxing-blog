<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;
    protected $fillable = [
        'title', 'type', 'content',
    ];

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->cover = get_cover($model->content);
            $model->abstract = get_abstract($model->content);
        });
    }

    /**
     * 获取下一篇文章
     * @return object
     */
    public function getNextAttribute()
    {
        return $this->where('type', 1)->where('id', '>', $this->id)->orderBy('id', 'asc')->first(['id', 'title']);
    }

    /**
     * 获取上一篇文章
     * @return object
     */
    public function getPreAttribute()
    {
        return $this->where('type', 1)->where('id', '<', $this->id)->orderBy('id', 'desc')->first(['id', 'title']);
    }

    /**获取详情链接
     * @return string
     */
    public function getInfoUrlAttribute()
    {
        return route('show', ['id' => $this->id]);
    }

    /**
     * 返回操作按钮
     * @return string
     */
    public function getOperaButtonAttribute()
    {
        if (\Auth::check()) {
            return $this->updateButton() . $this->publishButton() . $this->deleteButton();
        } else {
            return '';
        }
    }

    /**
     * 显示更新按钮
     * @return string
     */
    public function getUpdateButtonAttribute()
    {
        if (\Auth::check()) {
            return $this->updateButton();
        } else {
            return '';
        }
    }

    /**
     * 更新按钮
     * @return string
     */
    private function updateButton()
    {
        $url = route('edit', ['id' => $this->id]);
        return '<div style="display:inline-block;"><a class="btn btn-sm btn-primary" href="' . $url . '">更新文章</a></div>&emsp;';
    }

    /**
     * 删除按钮
     * @return string
     */
    private function deleteButton()
    {
        $url = route('delete', ['id' => $this->id]);
        return sprintf('<form action="%s" method="POST" 
                    style="display: inline-block;">
                      %s %s
                    <input type="submit"
                           class="btn btn-sm btn-default"
                           value="删除文章"
                           onclick="return confirm(%s);">
                </form>&emsp;', $url, method_field('DELETE'), csrf_field(), "'确定要删除吗？'");
    }

    /**
     * 发布按钮
     * @return string
     */
    private function publishButton()
    {
        $url = route('settingType', ['id' => $this->id]);
        return sprintf('<form action="%s" method="POST" 
                    style="display: inline-block;">
                      %s %s
                    <input type="hidden" name="type" value="%d">
                    <input type="submit"
                           class="btn btn-sm btn-default"
                           value="%s">
                </form>&emsp;',
            $url,
            method_field('PUT'),
            csrf_field(),
            ($this->type == 1) ? 2 : 1,
            ($this->type == 1) ? '不发布' : '发布'
        );
    }


}
