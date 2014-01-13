<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableModules extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('modules', function(Blueprint $table) {
            $table->engine = "MyISAM";
            $table->increments('id');
            $table->string("name", 255);
            $table->string("alias", 40)->unique();
            $table->text("childs");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('modules');
    }

}
