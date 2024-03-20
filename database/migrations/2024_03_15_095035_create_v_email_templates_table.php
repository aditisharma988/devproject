<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('v_email_templates', function (Blueprint $table) {

            $table->uuid('email_template_uuid')->primary();
            $table->string('template_category');
            $table->string('template_subcategory');
            $table->string('template_name');
            $table->string('template_subject');
            $table->text('template_body');
            $table->text('template_description');
            $table->json('template_images')->nullable();
            $table->string('filename')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_email_templates');
    }
};
