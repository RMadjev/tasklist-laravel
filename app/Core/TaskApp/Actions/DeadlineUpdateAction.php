<?php

namespace App\Core\TaskApp\Actions;

use Carbon\Carbon;

class DeadlineUpdateAction extends AbstractAction {

    public function getValue() {
        try{
            $deadline = Carbon::createFromFormat('Y-m-d', $this->value);
        }catch(\Exception $ex) {
            return null;
        }

        return $deadline;
    }

    public function getPropertyName() {
        return 'deadline';
    }
}
