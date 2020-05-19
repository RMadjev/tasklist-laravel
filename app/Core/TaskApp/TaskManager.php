<?php
declare(strict_types=1);

namespace App\Core\TaskApp;

use App\Task;
use App\Core\TaskApp\Actions\ActionInterface;

class TaskManager {

    private $task;
    private $action;

    public function __construct(Task $task, ActionInterface $action) {
        $this->task = $task;
        $this->action = $action;
    }

    public function update(): void {
        $updatedProperty = $this->action->getPropertyName();
        $this->task->{$updatedProperty} = $this->action->getValue();

        $this->task->save();
    }

    public function isActionAllowed(): bool {
        // disable action is always allowed
        if ($this->isDisabledAction()) {
            return true;
        }

        //disabled or expired task cannot be modified
        if ($this->task->isDisabled() || $this->task->isExpired()) {
            return false;
        }

        return true;
    }

    private function isDisabledAction(): bool {
        return $this->action->getPropertyName() === 'disabled';
    }
}
