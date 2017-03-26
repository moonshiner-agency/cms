<?php

namespace Moonshiner\Cms;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'moonshinecms_posts';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $fillable = [
        'author',
        'published_at',
        'main_content',
        'content',
        'title',
        'slug',
        'featured_image',
        'post_status',
        'visibility',
        'template'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'scopes' => 'array',
        'revoked' => 'bool',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function getContentAttribute()
    {
        $content = ($this->attributes['content'] ? $this->attributes['content'] : '{}');

        return json_decode($content);
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = empty($value) ? NULL : json_encode($value);
    }

}
