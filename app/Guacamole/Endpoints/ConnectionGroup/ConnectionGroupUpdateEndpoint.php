<?php

namespace App\Guacamole\Endpoints\ConnectionGroup;

use App\Guacamole\Api\ConnectionGroup\UpdateConnectionGroupApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionGroupUpdateEndpoint
{

    public function __construct(
        private readonly UpdateConnectionGroupApi $updateConnectionGroupApi,
        private readonly ConnectionGroupListEndpoint $connectionGroupListEndpoint
    ) {
    }

    public function __invoke(GuacamoleAuthLoginData $loginData, string $oldName, string $name): void
    {
        try {
            $list = ($this->connectionGroupListEndpoint)($loginData);
            $id = 0;
            if (array_key_exists('childConnectionGroups', $list)) {
                foreach ($list['childConnectionGroups'] as $connectionGroup) {
                    if ($connectionGroup['name'] === $oldName) {
                        $id = (int)$connectionGroup['identifier'];
                        break;
                    }
                }
            }
            ($this->updateConnectionGroupApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $name,
                $id
            );
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
