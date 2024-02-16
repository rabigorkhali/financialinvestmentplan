<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->timestamp('log_date');
            $table->text('user_agent');
            $table->text('request_endpoint');
            $table->integer('response_code');
            $table->decimal('response_time', 10, 4);
            $table->longText('request_body')->nullable();
            $table->longText('response_body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_logs');
    }
};
