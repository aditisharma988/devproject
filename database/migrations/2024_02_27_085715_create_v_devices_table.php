<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_devices', function (Blueprint $table) {
            $table->uuid('device_uuid')->primary();
            $table->text('device_address');
            $table->text('device_label');
            $table->text('device_enabled');
            $table->text('device_template');
            $table->text('device_description');
        
     
            // Indexes
            $table->index('device_uuid');
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_devices');
    }
}
// $table->timestamp('device_enabled_date')->nullable();
// $table->text('device_provisioned_ip')->nullable();
            // $table->text('device_password');
            // $table->text('device_model');
         // $table->uuid('domain_uuid');
            // $table->uuid('device_profile_uuid');
       // $table->uuid('device_user_uuid');
    
            // $table->timestamp('insert_date')->nullable();
            // $table->uuid('insert_user')->nullable();
            // $table->timestamp('update_date')->nullable();
            // $table->uuid('update_user')->nullable();

            // $table->timestamp('device_provisioned_date')->nullable();
            // $table->text('device_provisioned_method')->nullable();
      
            // $table->text('device_provisioned_agent')->nullable();
            // $table->text('device_vendor');
            //    $table->text('device_username');
          
            // $table->uuid('device_uuid_alternate')->nullable();
            // $table->text('device_location');
          
            // $table->text('device_firmware_version')->nullable();

