<?php

namespace App\Action\Computer;

use App\Models\Computer;

class ComputerCreateAction
{
    public function __invoke(string $name, string $ip, string $mac, string $login, int $id): Computer
    {
        $computer = new Computer();
        $computer->name = $name;
        $computer->ip = $ip;
        $computer->mac = $mac;
        $computer->login = $login;
        $computer->class_room_id = $id;
        $computer->save();
        return $computer;
    }
}
