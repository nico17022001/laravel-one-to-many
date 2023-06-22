<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //1.creo la colonna della FK
            $table-> unsignedBigInteger('category_id')->nullable()->after('id');
            //2. assegno la Fk alla colonna creata
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('set null');//se viene eliminata una categoria i post in relazione non vengono persi e abranno category_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //1. elimino la FK
            $table->dropForeign(['category_id']);

            //2.elimino la colonna
            $table->dropColumn('category_id');

        });
    }
};
