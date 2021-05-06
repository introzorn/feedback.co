<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msges', function (Blueprint $table) {
            $table->id();
            $table->char('user',64);
            $table->char('title',255);
            $table->mediumText('msg');
            $table->integer('readed')->default(0);
            $table->char('file',255)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msges');
    }
}
