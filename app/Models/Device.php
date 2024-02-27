<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Device extends Model
{
    use HasFactory;

    protected $table = 'v_devices';
    protected $primaryKey = 'device_uuid'; 
    protected $keyType = 'string'; 
    public $incrementing = false; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     
        'device_address',
        'device_label',
        'device_model',
        'device_enabled',
        'device_template',
        'device_description',
 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'device_enabled_date' => 'datetime',
        'device_provisioned_date' => 'datetime',
        'device_enabled' => 'boolean',
    ];

        // Disable timestamps
        public $timestamps = false;

    /**
     * Boot function for using with UUIDs
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

      // Define the one-to-many relationship with v_device_lines
      public function lines()
      {
          return $this->hasMany(DeviceLine::class, 'device_uuid', 'device_uuid');
      }
}
