<?php

namespace App\Action\Computer;

use App\Models\Computer;

class ComputerCreateAction
{
    public function __invoke(string $name, string $ip, string $mac, string $broadcast, bool $instructor, int $id): Computer
    {
        $computer = new Computer();
        $computer->name = $name;
        $computer->ip = $ip;
        $computer->mac = $mac;
        $computer->class_room_id = $id;
        $computer->instructor = $instructor;
        $computer->broadcast = $broadcast;
        $computer->save();
        return $computer;
    }
}
