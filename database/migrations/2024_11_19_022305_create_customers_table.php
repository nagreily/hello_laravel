<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


//执行以下命令生成迁移文件，文件在database的migrations下
//--table 和 --create 选项也可用于确定表的名称以及是否在迁移中创建新的数据表
//php artisan make:migration create_users_table --create=users
//php artisan make:migration add_votes_to_users_table --table=users
//php artisan make:migration create_users_table


////将迁移文件压缩到单个sql中
//php artisan schema:dump
//
//// 上面示例为转储但不删除原有迁移文件，下面示例为转储且删除原有迁移文件，执行命令后的sql文件在database/schema
//php artisan schema:dump --prune



//php artisan migrate执行迁移命令
//php artisan migrate --force强制执行迁移
//php artisan migrate:rollback回滚迁移
class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        up 的作用是向数据库中添加新的表或列或索引
//       使用create方法创建数据表
        Schema::create('customers', function (Blueprint $table) {
//            添加一个自增的整型主键
            $table->id();
            $table->timestamps();
        });

        Schema::table('customers', function (Blueprint $table) {
//            bigIncrements
            $table->id('id');
            $table->integer('customer_id');
            $table->string('customer_name')->nullable();
//            设置默认值为空的json数组（default 修饰符接收一个变量或者一个 \Illuminate\Database\Query\Expression）
            $table->json('movies')->default(new Expression('(JSON_ARRAY())'));
            $table->timestamps();

//            change 方法可以将现有的字段类型修改为新的类型或修改属性。
            $table->string('customer_name',50)->change();
//            将customer_id长度改为100，并且可以为空
            $table->integer('customer_id',100)->nullable()->change();

//            重命名字段,将customer_id重命名为cus_id
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('customer_id', 'cus_id');
            });

//            直接在字段定义后使用unique创建索引
            $table->string('email')->unique();
//            定义玩字段后再创建索引
//            $table->string('email2');
//            $table->unique('email2');

//          创建复合索引
            $table->index(['account_id', 'created_at']);

//            定义索引名称
            $table->unique('email', 'unique_email');
//            重命名索引
            $table->renameIndex('unique_email', 'unique_email2');

            $table->primary('id');
            $table->primary(['id', 'parent_id']);    //符合键
            $table->unique('email');         //添加唯一索引
            $table->index('state');          //添加唯一索引
            $table->spatialIndex('location');//添加空间索引


//            注意参数的命名方式（表名_字段名_约束名）
//            $table->dropPrimary('users_id_primary');    //删除主键约束
//            $table->dropUnique('users_email_unique');   //删除唯一索引
//            $table->dropIndex('geo_state_index');           //删除普通索引
//            $table->dropSpatialIndex('geo_location_spatialindex');   //删除空间索引

        });

        Schema::table('posts', function (Blueprint $table) {
//            在 posts 表上定义一个引用 users 表的 id 字段的 user_id 字段
//           $table->unsignedBigInteger('user_id');
//           $table->foreign('user_id')->references('id')->on('users');
//           或者使用简单方式,foreignId是unsignedBigInteger的别名，constrained 方法将使用约定来确定所引用的表名和列名。
//           如果表名与约定不匹配，可以通过将表名作为参数传递给 constrained 方法来指定表名
//            使用字段修饰符时必须在constrained前使用
            $table->foreignId('user_id')->constrained('users');

//            删除外键约束，参数名（表_字段_约束名）
            $table->dropForeign('posts_user_id_foreign');
        });


//            重命名数据表
//            Schema::rename($from,$to);

//            删除数据表
//            Schema::drop('users');
//            Schema::dropIfExists('users');


////            对非默认连接的数据库连接执行结构操作
//        Schema::connection('foo')->create('users', function (Blueprint $table) {
////                Schema::connection('connection_name') 来指定要使用的数据库连接，其中 'connection_name'
////               是在 config/database.php 配置文件中定义的数据库连接名称。
//            $table->id();
//        });

//        使用hasTable&hasColumn来判断表或列是否存在
//        if (Schema::hasTable('users')) { # 如果存在 users 表则执行
//            //
//        }
//        if (Schema::hasColumn('users', 'email')) { # 如果存在 users, email 列则执行
//            //
//        }
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        down 的作用是向数据库中删除新的表或列或索引
        Schema::dropIfExists('customers');
    }
}
