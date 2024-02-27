<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;


    protected $fillable = [
        'address',//http,https
        'label',
        'template',//uuid template
        'lines', //'lines' array
        'enabled',
        'description',
    ];

    /**
     * The validation rules.
     *
     * @var array
     */
    public static $rules = [
        'address' => 'required|url|in:http,https',
        'label' => 'required|string',
        'template' => 'required|uuid',
        'lines' => 'required|array|max:8',
        'lines.*.line' => 'required|integer|min:1|max:18',
        'lines.*.server_address' => 'required|url',
        'lines.*.label' => 'required|string',
        'lines.*.display_name' => 'required|string',
        'lines.*.user_id' => 'required|string',
        'lines.*.auth_id' => 'required|string',
        'lines.*.password' => 'required|string',
        'lines.*.port_no' => 'required|integer',
        'lines.*.transport' => 'required|in:TCP,UDP,TLS',
        'lines.*.register_expires' => 'required|integer',
        'lines.*.shared_line' => 'required|boolean',
        'lines.*.enabled' => 'required|boolean',
        'enabled' => 'required|boolean',
        'description' => 'required|string',

    ];

}
