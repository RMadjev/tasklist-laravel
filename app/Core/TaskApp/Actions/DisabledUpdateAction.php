<?php


namespace App\Core\TaskApp\Actions;


class DisabledUpdateAction extends AbstractAction {

    const DISABLED = 1;
    const ENABLED = 0;

    public function getValue() {
        return (int)$this->value === 0 ? self::ENABLED : self::DISABLED;
    }

    public function getPropertyName() {
        return 'disabled';
    }
}
