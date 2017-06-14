<?php

use App\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name');
            $table->string('slug');
        });

        $role = Role::where('slug','=','user')->first();
        if (!$role) {
            Role::create(['display_name'=>'User','slug'=>'user']);
        }
        $role = Role::where('slug','=','admin')->first();
        if (!$role) {
            Role::create(['display_name'=>'Admin','slug'=>'admin']);
        }
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role_id')->default(1)->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('option');
            $table->string('option_value');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('devices');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
}
