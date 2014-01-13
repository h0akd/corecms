<?php

use Illuminate\Database\Migrations\Migration;

class AddColunmTitleIntoGroupTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('groups', function($table) {
            $table->string('title', 255)->after("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('groups', function($table) {
            $table->dropColumn('title');
        });
    }

}
