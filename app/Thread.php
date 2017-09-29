<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * return path
     * @return string
     */
    public function path()
    {
        return '/threads/' . $this->id;
    }
}
