<?php

namespace App\Action\Computer;

use App\Models\Computer;

class ComputerDeleteAction
{
    public function __invoke(int $id): void
    {
        Computer::find($id)->delete();
    }
}
