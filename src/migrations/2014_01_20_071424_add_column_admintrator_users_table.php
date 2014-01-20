<?php

use Illuminate\Database\Migrations\Migration;

class AddColumnAdmintratorUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function($table) {
            $table->boolean('is_administrator')->defaults(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function($table) {
            $table->dropColumn('is_administrator');
        });
    }

}
