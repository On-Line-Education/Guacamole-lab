<?php

namespace App\Action\Computer;

use App\Action\Classroom\ClassroomCreateAction;
use App\Exceptions\ImportComputerExistsException;
use App\Exceptions\ImportUsernameExistsException;
use App\Exceptions\InvalidImportFileException;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Models\ClassRoom;
use App\Models\Computer;
use App\Models\StudentClass;
use App\Models\User;
use App\System\SystemPermissions;
use Illuminate\Support\Facades\Validator;

class ComputerImportAction
{

    public function __construct(
        private readonly ComputerCreateAction $computerCreateAction,
        private readonly ClassroomCreateAction $classroomCreateAction,

        private readonly string $name = 'nazwa',
        private readonly string $ip = 'ip',
        private readonly string $mac = 'mac',
        private readonly string $classroom = 'sala',
    )
    {}

    public function __invoke(string $importStr): void
    {
        $import = $this->getCsvArray($importStr);
        
        if (
            count($import[0]) !== 4
            || $import[0][0] !== $this->name
            || $import[0][1] !== $this->ip
            || $import[0][2] !== $this->mac
            || $import[0][3] !== $this->classroom
            ) {
            throw new InvalidImportFileException();
        }

        array_shift($import);

        $checkComputers = $this->hasComputers($import);
        if ($checkComputers !== false) {
            throw new ImportComputerExistsException($checkComputers);
        }

        foreach ($import as $row) {
            $classroom = $this->getClassroom($row[3]);
            $this->getComputer($row[0], $row[1], $row[2], $classroom->id);
        }
    }

    private function getCsvArray($csvString): array
    {
        $data = str_getcsv($csvString, "\n"); //parse the rows

        foreach ($data as &$row) {
            $row = str_getcsv($row, ";");
            foreach ($row as &$entry) {
                if (str_contains($entry, ',')) {
                    $entry = explode(',', $entry);
                }
            }
        } //parse the items in rows

        return $data;
    }

    private function hasComputers(array $csv): string|false
    {
        foreach ($csv as $entry) {
            if (Computer::where('name', $entry[0])->count() > 0) {
                return $entry[0];
            }
        }
        return false;
    }

    private function getComputer(string $name, string $ip, string $mac, int $classroomId): Computer
    {

        $validator = Validator::make(['ip' => $ip], [
            'ip' => 'required|ip'
        ]);
    
        if ($validator->fails()) {
            throw new ImportComputerExistsException('ip ' . $ip);
        }

        $validator = Validator::make(['mac' => $mac], [
            'mac' => 'required|mac_address'
        ]);
    
        if ($validator->fails()) {
            throw new ImportComputerExistsException('mac ' . $mac);
        }

        $computer = new Computer();
        $computer->name = $name;
        $computer->ip = $ip;
        $computer->mac = $mac;
        $computer->login = '';
        $computer->class_room_id = $classroomId;
        $computer->save();

        return $computer;
    }

    private function getClassroom(string $classname): ClassRoom
    {
        $class = ClassRoom::where('name', $classname);
        if ($class->count()) {
            return $class->first();
        }
        $class = new ClassRoom();
        $class->name = $classname;
        $class->description = '';
        $class->save();
        return $class;
    }
}
