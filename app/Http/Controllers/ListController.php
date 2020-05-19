<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskList;
use Illuminate\Http\Request;

class ListController extends Controller {

    public function show($id) {
        $list = TaskList::findOrFail($id);

        return view('edit', ['list' => $list]);
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $list = new TaskList();
        $list->name = $request->name;
        $list->save();

        return redirect('/');
    }

    public function update($id) {
        $list = TaskList::findOrFail($id);
        $request = request();

        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $list->name = $request->name;
        $list->save();

        return response('', 200);
    }

    public function addTask($id) {
        $list = TaskList::findOrFail($id);
        $request = request();

        $request->validate([
            'description' => 'required|min:3|max:1024'
        ]);

        $task = new Task(['description' => $request->description]);
        $list->tasks()->save($task);

        return response('', 200);
    }

    public function destroy($id) {
        TaskList::destroy($id);
        return response('', 204);
    }

}
