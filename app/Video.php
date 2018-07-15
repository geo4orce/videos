<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * @var array
     */
    private $id3;

    /**
     * @var array
     */
    private $default = ['name' => 'Unknown'];

    // --- magic attribute shortcuts ---
    public function getKeywordsStringAttribute()
    {
        /**
         * @var string $this->keywords_string concatenated with space
         */

        return $this->keywords->implode('name', ',');
    }
    public function getLikesAttribute()
    {
        /**
         * @var int $this->likes number of likes
         */

        return $this->likes_pivot->count();
    }
    public function getLikedAttribute()
    {
        /**
         * @var bool $this->liked is this video liked by me?
         */

        return !! $this->liked_pivot->count();
    }
    public function getFullPathAttribute()
    {
        return storage_path("app/$this->path");
    }

    // --- relationships ---
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function location()
    {
        return $this->belongsTo('App\Location')->withDefault($this->default);
    }

    public function keywords()
    {
        return $this->belongsToMany('App\Keyword');
    }

    public function likes_pivot()
    {
        return $this->belongsToMany('App\User', 'likes');
    }

    public function liked_pivot()
    {
        return $this->belongsToMany('App\User', 'likes')->wherePivot('user_id', '=', \Auth::id());
    }

    // --- business logic ---
    public function parsePath($path)
    {
        $this->path = $path;
        $this->duration = $this->getDuration();
        $this->size = $this->id3('filesize');
        $this->bitrate = $this->id3('bitrate');
        $this->format = $this->id3('mime_type');
    }

    // --- private stuff ---
    private function id3($attr)
    {
        if (!$this->id3) {
            $this->id3 = resolve('id3')->analyze($this->full_path);
        }

        return array_get($this->id3, $attr, 'N/A');
    }

    private function getDuration()
    {
        $playtime_seconds = $this->id3('playtime_seconds');
        $duration = date('H:i:s.v', $playtime_seconds);

        return $duration;
    }

}
