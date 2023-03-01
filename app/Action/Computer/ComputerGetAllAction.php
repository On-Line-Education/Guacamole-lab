<?php

namespace App\Action\Computer;

use App\Models\Computer;
use Illuminate\Database\Eloquent\Collection;

class ComputerGetAllAction
{
    public function __invoke(): Collection
    {
        return Computer::all();
    }
}
