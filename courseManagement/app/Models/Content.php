<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;
    protected $fillable = ['module_id', 'title', 'video_source_type', 'video_url', 'video_length'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
