<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;


//php artisan make:resource User
//Eloquent 资源类通常用于定义数据库表和模型之间的映射关系，以及提供一些便捷的方法来操作数据库数据。
/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $email
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class User extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
//            在资源中增加条件属性
            'secret' => $this->when(Auth::user()->isAdmin(), 'secret-value'),
//            或者这样写
//            'secret' => $this->when(Auth::user()->isAdmin(), function () {
//                return 'secret-value';
//            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

//          使用 mergeWhen 方法在给定的条件为 true 时将多个属性添加到响应
            $this->mergeWhen(Auth::user()->isAdmin(), [
                'first-secret' => 'value',
                'second-secret' => 'value',
            ]),


        ];

    }
}
