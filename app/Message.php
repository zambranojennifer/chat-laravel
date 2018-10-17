<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
        protected $fillable = ['message','file_path','file_name','type']; 
    /*
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
    public function user()
    {
        return $this->belongsTo(User::class);
    }*/

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function receivers() {
        return $this->hasMany(Receiver::class);
    }
}
