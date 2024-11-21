<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $int)
 * @method static withCount(string $string)
 */
class Post extends Model
{


    public function image()
    {

//        获取文章图片
        return $this->morphOne('App\Models\Image','imageAble');
    }

////        通过模型访问关联
//    public function getImage()
//    {
//        $post = Post::find(1);
//        $image = $post->image;
//    }


//关联模型计数
    public function Count()
    {
//        使用withCount计算关联结果的统计数量，结果在post模型的{relation}_count列
        $posts = Post::withCount('comments')->get();

        foreach ($posts as $post) {
            echo $post->comments_count;
        }
    }

    public function withCount()
    {
//        增加查询限制
//        使用withCount需要在select之后
        $posts = Post::withCount([
            'comments',
//            使用as给计数结果取别名
            'comments as pending_comments_count' => function (Builder $query) {
                $query->where('approved', false);
            },
        ])->get();

        echo $posts[0]->comments_count;
        echo $posts[0]->pending_comments_count;
    }


}
