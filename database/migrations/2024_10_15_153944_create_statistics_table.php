<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('post_id')->constrained()->onDelete('cascade');  
            $table->integer('view_count')->default(0);  
            $table->integer('like_count')->default(0);  
            $table->integer('dislike_count')->default(0);  
            $table->timestamps();  
        });
    }

    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
;
