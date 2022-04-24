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

        Schema::create("kind", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "kind");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("pets", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "pet_name");
            $table->string(column: "sex");
            $table->string(column: "pictures")->default('picture.jpg');
            $table->integer(column: "customer_id")->unsigned();
            $table->integer(column: "kind_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("customer_id")
                ->references("id")
                ->on("customers")
                ->onDelete("cascade");
                $table
                ->foreign("kind_id")
                ->references("id")
                ->on("kind")
                ->onDelete("cascade");
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("pets");
    }
};
