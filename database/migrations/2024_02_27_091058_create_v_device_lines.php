<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVDeviceLines extends Migration
{
    public function up()
    {
        Schema::create('v_device_lines', function (Blueprint $table) {
            $table->uuid('device_line_uuid')->primary();
            $table->uuid('device_uuid');
            $table->text('line_number');
            $table->text('server_address');
            $table->text('label');
            $table->text('display_name');
            $table->text('user_id');
            $table->text('auth_id');
            $table->text('password');
            $table->decimal('sip_port');
            $table->text('sip_transport');
            $table->decimal('register_expires')->default(3600);
            $table->text('shared_line');
            $table->text('enabled');
   
            // Foreign key relationship

             $table->foreign('device_uuid')->references('device_uuid')->on('v_devices')->onDelete('cascade');

            // Indexes
            // Assuming 'device_uuid' field is removed from v_device_lines table
            $table->index('device_uuid');
        });
    }

    public function down()
    {
        Schema::dropIfExists('v_device_lines');
    }
}

         // $table->text('server_address_primary');
            // $table->text('server_address_secondary');
            // $table->text('outbound_proxy_primary');
            // $table->text('outbound_proxy_secondary');
                     // $table->timestamp('insert_date')->nullable();
            // $table->uuid('insert_user');
            // $table->timestamp('update_date')->nullable();
            // $table->uuid('update_user');
                        // $table->uuid('domain_uuid');
