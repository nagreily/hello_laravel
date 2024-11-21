<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->integer('destination_id')->unique();

            $table->string('destination_name');
            $table->string('destination_address');
            $table->timestamps();
        });

//       增加软删除的功能  通过在表中添加一个 deleted_at 字段来实现的功能，用于标记记录是否被删除
        Schema::table('destinations', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinations');

//      移除软删除的功能
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
