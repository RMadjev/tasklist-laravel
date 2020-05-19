<?php

namespace App\Core\TaskApp\Actions;

use Illuminate\Http\Request;

abstract class AbstractAction implements ActionInterface {
    protected $value;

    public function __construct(Request $request) {
        $this->value = $request->value;
    }

}
