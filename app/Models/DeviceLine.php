<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DeviceLine extends Model
{
    use HasFactory;
    protected $primaryKey = 'device_line_uuid';

    protected $table = 'v_device_lines';
    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain_uuid',
        'device_line_uuid',
        'device_uuid',
        'line_number',
        'server_address',
        'label',
        'display_name',
        'user_id',
        'auth_id',
        'password',
        'sip_port',
        'sip_transport',
        'register_expires',
        'shared_line',
        'enabled',
    ];

    public $timestamps = false;

    /**
     * Boot function for using with UUIDs
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();

        });
    }

    /**
     * Relationship with v_devices table
     */
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_uuid', 'device_uuid');
    }
}
