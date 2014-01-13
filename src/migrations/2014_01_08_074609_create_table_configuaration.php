<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateTableConfiguaration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('configurations', function(Blueprint $table) {
            $table->engine = "MyISAM";
            $table->increments('id');
            $table->string("name", 255)->unique();
            $table->text("config");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('configurations');
    }

}
