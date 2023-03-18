<?php

namespace App\Action\Computer;

use App\Models\Computer;

class ComputerUpdateAction
{
    public function __invoke(
        int $id,
        ?string $newName = null,
        ?string $newIp = null,
        ?string $newMac = null,
        ?bool $instructor = null
        )
    {
        $computer = Computer::find($id);
        $computer->name = $newName ?? $computer->name;
        $computer->ip = $newIp ?? $computer->ip;
        $computer->mac = $newMac ?? $computer->mac;
        $computer->instructor = $instructor ?? $computer->instructor;
        $computer->save();
        return $computer;
    }
}
