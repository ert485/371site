<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['title','body'];
    public function setValues($title, $body){
        $this->title = $title;
        $this->body = $body;
    }
}
