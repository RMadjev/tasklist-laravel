<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model {

    protected $table = 'task_lists';

    protected $fillable = ['name'];

    protected $visible = ['name', 'id', 'created_at', 'status'];

    protected $appends = ['status'];

    public function tasks() {
        return $this->hasMany('App\Task', 'list_id')->orderBy('id');
    }

    public function enabledTasks() {
        return $this->tasks()
            ->where('disabled', '=', 0)
            ->count();
    }

    public function finishedTask() {
        return $this->tasks()
            ->where('disabled', '=', 0)
            ->where('status', '=', 1)
            ->count();
    }

    public function getStatusAttribute() {
        return $this->enabledTasks() === $this->finishedTask();
    }

}
