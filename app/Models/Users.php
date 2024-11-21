<?php

namespace App\Models;


use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;


/**
 * @method static find(int $int)
 * @method static where(string $string, int $int)
 */
class Users extends Model
{

    protected $text;

//  通过设置模型的 $dates 属性来添加其他日期属性
    protected $dates = ['registered_at'];  //注册时间

//  自定义时间戳格式  这个时间字段被为被格式化为UNIX 时间戳的形式存储
    protected $dataFormat = 'U';

//    将属性转换为常见数据类型,将options转换为自定义的数据格式
    protected $casts = ['is_admin' => 'boolean','options'=>Json::class];

    public function phone()
    {
//        关联一个phone模型
        return $this->hasOne('App\Models\phone', 'user_id', 'id' );
    }

    public function address()
    {
//        进行值对象类型转换后，任何对值对象的数据转换将会自动同步回模型中
        $user = Users::find(1);
        $user->address->lineOne = 'Updated Address Value';
        $user->save();
    }


    public function roles()
    {
//      模型关联多对多  用户拥有的角色

        return $this->belongsToMany('App\Models\role');
    }


    public function updateBelongsTo($user)
    {
//        使用associate方法更新belongsTo，在子模型中设置外键
        $account = Account::find(10);
        $user->account()->associate($account);
        $user->save();
    }

    public function dissociate($user)
    {
//        使用dissociate方法，将关联外键设置为null
        $user->account()->dissociate();
        $user->save();
    }

    public function attach($roleId, $expires)
    {
//      多对多， 给某个用户附加一个角色，使用attach方法
        $user = Users::find(1);
//        向表中插入一条记录，第二个参数为附加数据
        $user->roles()->attach($roleId, ['expires' => $expires]);

//        使用detach移除多对多关联记录，不添加参数可移除所有记录
        $user->roles()->detach($roleId);
    }

    public function syncModel($user)
    {
//      使用sync同步更新模型之间的多对多关联关系
        $user->roles()->sync([1, 2, 3]);
//      通过ID传递额外的数据到中间表
        $user->roles()->sync([1=>['expires' => 'true'], 2, 3]);
//      不会删除中间表中与这些 ID 不匹配的记录
        $user->roles()->syncWithoutDetaching([1, 2, 3]);
    }


//在多对多关联关系中添加或移除指定模型的关联，如果指定的模型已经与当前模型建立了关联，
//则 "toggle" 方法会将其移除；如果指定的模型尚未与当前模型建立关联，则 "toggle" 方法会将其添加关联
    public function toggleModel($user)
    {
        $user->roles()->toggle([1, 2, 3]);
    }

//    在子模型中定义了touches属性，方便查看父模型何时缓存失效
    public function touchesModel()
    {
        $users = Users::find(1);
        $users->text = 'Edit to this User!';
        $users->save();
    }


//  结果集都是 Illuminate\Database\Eloquent\Collection 对象的实例
//    通过get访问结果
    public function collectionModel()
    {
        $users = Users::where('active', 1)->get();

        foreach ($users as $user) {
            echo $user->name;
        }
    }

    public function Map()
    {
        $users = Users::all();
        $names = $users->reject(function ($user) {
//            移除未激活的用户
            return $user->active === false;
        })->map(function ($user) {
//            遍历用户，返回用户名
            return $user->name;
        });
    }


//    Eloquent集合的方法
    public function containsModel($users)
    {
//    contains 方法用于判断集合中是否包含指定的模型实例
        $users->contains(1);
        $users->contains(User::find(1));
    }

    public function diffModel($users)
    {
//        diff方法返回不在给定集合中的所有模型
        $users = $users->diff(User::whereIn('id', [1, 2, 3])->get());
    }

    public function exceptModel($users)
    {
//        except 方法返回给定主键外的所有模型
        $users = $users->except(User::whereIn('id', [1, 2, 3])->get());
    }

    public function findModel($users)
    {
        $users = Users::all();
//        find 方法查找给定主键的模型
        $users = $users->find(1);
    }

    public function freshModel($users)
    {
//        fresh 方法从数据库检索集合中的每个模型的新实例
        $users = $users->fresh();
//        被指定的关系会被预先加载
        $users = $users->fresh('comments');
    }

    public function intersectModel($users)
    {
//        intersect 方法返回给定集合中也存在的所有模型
        $users = $users->intersect(User::whereIn('id', [1, 2, 3])->get());
    }

    public function loadModel($users)
    {
//        load提前加载集合中所有模型的指定关系
        $users = $users->load('comments','posts');
        $users = $users->load('comments.author');
    }

    public function loadMissingModel($users)
    {
//        如果尚未加载关系，loadMissing 方法将会为集合中的所有模型加载给定的关系
        $users->loadMissing('comments', 'posts');
        $users->loadMissing('comments.author');
    }

    public function modelKeys($users)
    {
//        modelKeys返回集合中所有模型的主键
        $users = $users->modelKeys();
    }

    public function makeVisibleModel($users)
    {
//        makeVisible方法返回集合中给定的每个模型的隐藏属性
        $users = $users->makeVisible(['address', 'phone_number']);
    }

    public function makeHiddenModel($users)
    {
//        makeHidden方法返回集合中给定的每个模型的隐藏属性
        $users = $users->makeHidden(['address', 'phone_number']);
    }

    public function onlyModel($users)
    {
//        only返回给定主键的所有模型
        $users = $users->only([1,2,3]);
    }

    public function toQueryModel($users)
    {
//        only返回给定主键的所有模型
        $users = Users::where('status', 'VIP')->get();
//        toQuery返回一个查询构造器实例，该实例在集合模型的主键上包含一个 whereIn 约束
        $users = $users->toQuery()->update(['status' => 'Admin']);
    }


    public function uniqueModel($users)
    {
//        unique 方法返回集合中的所有唯一模型。并且删除与集合中另一个模型有相同主键的同一类型的所有模型
//        用于从集合中移除重复的项目，并返回一个包含唯一值的新集合(gpt说不是上面这个？？)
        $users = $users->unique([1,2,3]);
    }

//    自定义集合collection
    public function newCollection(array $models = [])
    {
//        return new  CustomCollection($models);
    }







}
