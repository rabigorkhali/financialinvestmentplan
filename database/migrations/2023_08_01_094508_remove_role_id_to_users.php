<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRoleIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //Drop the foreign key constraint named "users_role_id_foreign" from the "users" table.
            // This foreign key likely references the "role_id" column in another table,
            // and we are removing this constraint to allow for changes to the "role_id" column in the "users" table
            $table->dropForeign('users_role_id_foreign');

            //Drop the "role_id" column from the "users" table.
            // This column will be permanently removed from the table as a result of this migration.
            $table->dropColumn('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
