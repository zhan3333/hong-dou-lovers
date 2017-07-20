<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUsersHeadimgUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'headimg_url')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('headimg_url')->nullable()->comment('用户头像url');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'headimg_url')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['headimg_url']);
            });
        }
    }
}
