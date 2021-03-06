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
        Schema::create("transacs", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "date");
            $table->string(column: "status")->default('On Going');
            $table->integer(column: "employee_id")->unsigned();
            $table->integer(column: "pets_id")->unsigned();
            $table->integer(column: "service_id")->unsigned();
            $table->timestamps();
            $table
                ->foreign("employee_id")
                ->references("id")
                ->on("employees")
                ->onDelete("cascade");
            $table
                ->foreign("pets_id")
                ->references("id")
                ->on("pets")
                ->onDelete("cascade");
            $table
                ->foreign("service_id")
                ->references("id")
                ->on("services")
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
        Schema::dropIfExists('transacs');
    }
};
