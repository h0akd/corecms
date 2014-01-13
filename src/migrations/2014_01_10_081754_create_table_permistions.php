<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTablePermistions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('permistions', function(Blueprint $table) {
            $table->engine = "MyISAM";
            $table->increments('id');
            $table->string("name", 255);
            $table->string("alias", 40)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('permistions');
    }

}
