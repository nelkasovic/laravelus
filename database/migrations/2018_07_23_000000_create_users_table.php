<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tenant_id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('email')->unique();
            $table->string('password')->default('$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'); // secret
            $table->boolean('active')->default(1);
            $table->string('locale')->default(config('app.locale'));
            $table->rememberToken();

            // Foreign Keys
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('restrict');

            // Default timestamps on create and update
            $table->timestamp('last_login')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
