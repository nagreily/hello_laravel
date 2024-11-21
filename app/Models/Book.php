<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{


    public function Author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    public function getBookAuthor()
    {
////        如果有25个结果，此方法执行了26次查询
//        $book = Book::all();
//        foreach ($book as $books) {
//            echo $books->author->name;
//        }
//            select * from books
//            select * from books where id = 1
//            select * from books where id = 2 到 25


//        此方法执行了两次查询
        $book = Book::with('author')->get();
        foreach ($book as $books) {
            echo $books->author->name;
//            select * from books
//            select * from authors where id in (1, 2, 3, 4, 5, ...)
        }
//

        $books = Book::with(['author', 'publisher'])->get();

//       给预加载的主模型添加限制，不能使用limit 和 take，防止加载的主模型数量与关联模型数量不匹配
        $users = User::with(['posts' => function ($query) {
            $query->where('title', 'like', '%first%')
            ->orderBy('created_at', 'desc');
        }])->get();
    }

    public function preLoad($author)
    {
        $books = Book::all();

        if (1) {
            $author->load(['books' => function ($query) {
                $query->orderBy('published_date', 'asc');
            }]);
        }
    }

//    加载还没有加载的关联关系

//    public function format(Book $book)
//    {
//        $book->loadMissing('author');
//
//        return [
//            'name' => $book->name,
//            'author' => $book->author->name,
//        ];
//    }
}
