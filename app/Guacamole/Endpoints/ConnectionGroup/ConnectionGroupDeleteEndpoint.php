<?php

namespace App\Guacamole\Endpoints\ConnectionGroup;

use App\Guacamole\Api\ConnectionGroup\DeleteConnectionGroupApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionGroupDeleteEndpoint
{

    public function __construct(
        private readonly DeleteConnectionGroupApi $deleteConnectionGroupApi,
        private readonly ConnectionGroupListEndpoint $connectionGroupListEndpoint
    ) {
    }

    public function __invoke(GuacamoleAuthLoginData $loginData, string $name): void
    {
        try {
            $list = ($this->connectionGroupListEndpoint)($loginData);
            $id = 0;
            if (array_key_exists('childConnectionGroups', $list)) {
                foreach ($list['childConnectionGroups'] as $connectionGroup) {
                    if ($connectionGroup['name'] === $name) {
                        $id = (int)$connectionGroup['identifier'];
                        break;
                    }
                }
            }
            ($this->deleteConnectionGroupApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $id
            );
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
