<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCareerAndAddSomeColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('academic_background')->nullable()->after('user_self_introduction');
            $table->string('home_village')->nullable()->after('academic_background');
            $table->string('current_residence')->nullable()->after('home_village');
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
            $table->dropColumn('academic_background');
            $table->dropColumn('home_village');
            $table->dropColumn('current_residence');
        });
    }
}
