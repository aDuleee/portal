<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReactionsTable extends Migration
{
    public function up()
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('post_id')->constrained()->onDelete('cascade');  
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  
            $table->enum('reaction_type', ['like', 'dislike']); 
            $table->timestamps();  
        });
    }

    public function down()
    {
        Schema::dropIfExists('reactions');
    }
}
;
