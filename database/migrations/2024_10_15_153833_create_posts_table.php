<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();  
            $table->string('title');  
            $table->text('content');  
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('category_id')->constrained()->onDelete('cascade');  
            $table->integer('likes')->default(0);  
            $table->integer('dislikes')->default(0);  
            $table->timestamp('published_at')->nullable();  
            $table->timestamps();  
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
;
