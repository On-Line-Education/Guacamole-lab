<?php

namespace App\Action\User;

use App\Action\StudentClass\StudentClassAssignUserAction;
use App\Exceptions\ImportUsernameExistsException;
use App\Exceptions\InvalidImportFileException;
use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Models\StudentClass;
use App\Models\User;
use App\System\SystemPermissions;

class UserImportAction
{

    public function __construct(
        private readonly Guacamole $guacamole,
        private readonly UserCreateAction $userCreateAction,
        private readonly GuacamoleUserCreateAction $guacamoleUserCreateAction,
        private readonly StudentClassAssignUserAction $studentClassAssignUserAction,

        private readonly string $login = 'login',
        private readonly string $password = 'haslo',
        private readonly string $class = 'grupa',
    )
    {}

    public function __invoke(GuacamoleAuthLoginData $guacAuth, string $importStr): void
    {
        $import = $this->getCsvArray($importStr);
        
        if (
            count($import[0]) !== 3
            || $import[0][0] !== $this->login
            || $import[0][1] !== $this->password
            || $import[0][2] !== $this->class
            ) {
            throw new InvalidImportFileException();
        }

        array_shift($import);

        $checkUsernames = $this->checkUsernames($import);
        if ($checkUsernames !== false) {
            throw new ImportUsernameExistsException($checkUsernames);
        }

        foreach ($import as $row) {
            $user = new GuacamoleUserData([
                'username' => $row[0],
                'password' => $row[1]
            ]);
            ($this->guacamoleUserCreateAction)($guacAuth, $user);

            $sysuser = ($this->userCreateAction)(
                $row[0],
                $row[1],
                SystemPermissions::STUDENT
            );

            $class = $this->getClass($row[2]);
            ($this->studentClassAssignUserAction)($sysuser, $class);
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

    private function checkUsernames(array $csv): string|false
    {
        foreach ($csv as $entry) {
            if (User::where('username', $entry[0])->count() > 0) {
                return $entry[0];
            }
        }
        return false;
    }

    private function getClass(string $classname): StudentClass
    {
        $class = StudentClass::where('name', $classname);
        if ($class->count()) {
            return $class->first();
        }
        $class = new StudentClass();
        $class->name = $classname;
        $class->save();
        return $class;
    }
}
