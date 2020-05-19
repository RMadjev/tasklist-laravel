<?php

namespace App\Http\Controllers;

use App\Core\TaskApp\Exceptions\ActionNotAllowedException;
use App\Core\TaskApp\Exceptions\InvalidActionException;
use App\Task;
use App\Core\TaskApp\TaskManager;
use App\Core\TaskApp\TaskActionFactory;

class TaskController extends Controller {

    public function update($id, TaskActionFactory $factory) {

        $task = Task::findOrFail($id);

        $request = request();
        $request->validate([
            'property' => 'required',
            'value' => 'present'
        ]);

        try {
            // create action from the request
            $action = $factory->createAction($request);

            $taskManager = new TaskManager($task, $action);

            //check action prerequisites
            if (!$taskManager->isActionAllowed()) {
                throw new ActionNotAllowedException();
            }

            //update the task
            $taskManager->update();
        } catch (ActionNotAllowedException|InvalidActionException $ex) {
            return response('', 400);
        }

        return response('', 200);

    }

}
