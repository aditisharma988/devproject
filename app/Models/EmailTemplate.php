<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmailTemplate extends Model
{
    use HasFactory;
    protected $table = 'v_email_templates';
    protected $primaryKey = 'email_template_uuid';

    protected $fillable = [
        'template_category',
        'template_subcategory',
        'template_name',
        'template_subject',
        'template_body',
        'template_description',
        'template_images',
    ];

    /**
    * The attributes that should be cast to native types.
    *

    
    * @var array
    */
    protected $casts = [
        'template_images' => 'array',

    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->email_template_uuid = Str::uuid();
        });
    }
}
