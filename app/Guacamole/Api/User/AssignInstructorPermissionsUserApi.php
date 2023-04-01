<?php

namespace App\Guacamole\Api\User;

use App\Guacamole\Api\AbstractApi;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class AssignInstructorPermissionsUserApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, GuacamoleUserData $user): ResponseInterface
    {
        return $this->apiClient->patch('api/session/data/' . $sourceData . '/users/'.$user->username.'/permissions', [
            'query' => [
                'token' => $token
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([[
                "op"=> "add",
                "path"=> "/systemPermissions",
                "value"=> "CREATE_USER"
              ]])
        ]);
    }
}
