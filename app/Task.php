<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    protected $fillable = ['description', 'deadline', 'disabled', 'status'];

    protected $visible = ['description', 'deadline', 'disabled', 'id', 'status', 'isExpired'];

    public function list() {
        $this->belongsTo('App\TaskList');
    }

    public function isExpired() {
        $now = time();
        return $now > Carbon::parse($this->deadline)->getTimestamp();
    }

    public function isDisabled() {
        return $this->disabled === 1;
    }
}
