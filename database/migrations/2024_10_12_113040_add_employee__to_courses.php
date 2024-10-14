<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('max_number_of_students')->change();
            $table->integer('min_number_of_students')->change();
            $table->date('start_time')->change();
            $table->date('end_time')->change();
            $table->integer('number_of_lessons')->change();
            $table->boolean('whatsapp_group')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedTinyInteger('max_number_of_students')->change();
            $table->unsignedTinyInteger('min_number_of_students')->change();
            $table->time('start_time')->change();
            $table->time('end_time')->change();
            $table->text('number_of_lessons')->change();

        });
    }
};
