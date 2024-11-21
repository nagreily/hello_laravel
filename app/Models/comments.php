<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;

//    一对多（反向关联）
    public function Flight1()
    {
//        使用withDefault指定默认模型，给定的关系为null时，返回默认模型
        return $this->belongsTo('App\Models\Flight1')->withDefault();
    }

    public function addModel()
    {

        $comment = new comments(['message' => 'A new comment.']);

        $post = Post::find(1);

        $post->comments()->save($comment);


    }

    public function addModel1()
    {
        $post = Post::find(1);

//      调用comments方法获取关联实例
        $post->comments()->saveMany([
            new comments(['message' => 'A new comment.']),
            new comments(['message' => 'Another comment.']),
        ]);

//        使用save或saveMany将模型保存到数据库，使用refresh方法重新加载模型以及关联
        $post->refresh();

    }

    public function saveModel()
    {
        $post = Post::find(1);

        $post->comments[0]->message = 'Message';
        $post->comments[0]->author->name = 'Author Name';
//        使用push方法保存模型以及关联数据
        $post->push();
    }


//  使用create方法，接受一个属性数组，同时会创建模型并插入到数据库中
    public function createModel()
    {
        $post = Post::find(1);
//
        $post->comments()->create([
            'message' => 'A new comment.',
        ]);
    }

    public function createManyModel()
    {
        $post = Post::find(1);

//      使用createMany创建多个关联模型
        $post->comments()->createMany([
            ['message' => 'A new comment.',], ['message' => 'Another new comment.',],
        ]);
    }
}
