<?php
declare(strict_types=1);

namespace App\Core\TaskApp;

use Illuminate\Http\Request;
use App\Core\TaskApp\Actions\ActionInterface;
use App\Core\TaskApp\Actions\StatusUpdateAction;
use App\Core\TaskApp\Actions\DisabledUpdateAction;
use App\Core\TaskApp\Actions\DeadlineUpdateAction;
use App\Core\TaskApp\Exceptions\InvalidActionException;


class TaskActionFactory {

    public function createAction(Request $request): ActionInterface {
        switch (strtolower($request->property)) {
            case 'deadline':
                return new DeadlineUpdateAction($request);
            case 'disabled':
                return new DisabledUpdateAction($request);
            case 'status':
                return new StatusUpdateAction($request);
            default:
                throw new InvalidActionException();
        }
    }
}
