<?php


namespace App\Core\TaskApp\Actions;


class StatusUpdateAction extends AbstractAction {

    const DONE = 1;
    const IN_PROGRESS = 0;

    public function getValue() {
        // may be we will add more stages like requested, blocked
        return (int)$this->value === 0 ? self::IN_PROGRESS : self::DONE;
    }

    public function getPropertyName() {
        return 'status';
    }
}
