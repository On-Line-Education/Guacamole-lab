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
        ?string $newLogin = null
        )
    {
        $computer = Computer::find($id);
        $computer->name = $newName ?? $computer->name;
        $computer->ip = $newIp ?? $computer->ip;
        $computer->mac = $newMac ?? $computer->mac;
        $computer->login = $newLogin ?? $computer->login;
        $computer->save();
        return $computer;
    }
}
