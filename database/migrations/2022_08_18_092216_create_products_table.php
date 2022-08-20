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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("variety");
            $table->string("description");
            $table->decimal("price", 5,2);
            $table->string("image");
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger("origin_id")->nullable(false);
            $table->foreign("origin_id")->references('id')->on("origins")->onDelete("cascade");
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
        Schema::dropIfExists('products');
    }
};
