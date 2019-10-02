<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tenant_id')->unsigned();
            $table->enum('salutation', ['mr', 'mrs']);
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('title')->nullable();
            $table->string('company_name')->index()->nullable();
            $table->string('email')->nullable()->unique()->index();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('approved')->default(0);
            $table->boolean('changed')->default(0);
            $table->text('notes')->nullable();

            // Foreign Keys
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('restrict');

            // Default timestamps on create and update
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
        Schema::dropIfExists('persons');
    }
}
