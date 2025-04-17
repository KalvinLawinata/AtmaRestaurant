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
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();  // Session ID
            $table->unsignedBigInteger('user_id')->nullable(); // User ID, if required
            $table->text('payload');  // Store session data (usually serialized)
            $table->timestamp('last_activity')->useCurrent()->nullable();  // Timestamp for last activity
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};
