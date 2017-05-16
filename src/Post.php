<?php

namespace Moonshiner\Cms;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'moonshinecms_posts';

   
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
        'teaser_content',
        'main_content',
        'content',
        'title',
        'slug',
        'featured_image',
        'category',
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
        'content' => 'array'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];

    public function scopePublished($query)
    {
      return $query->public()->where('published_at', '<', Carbon::now())->where('post_status', 'published');
    }

    public function scopeDraft($query)
    {
      return $query->where('post_status', 'draft');
    }

    public function scopePrivate($query)
    {
      return $query->where('visibility', 'private');
    }

    public function scopePublic($query)
    {
      return $query->where('visibility', 'public');
    }

    public function scopePublishedLatest($query)
    {
      return $query->published()->orderBy('published_at', 'desc');
    }


}
