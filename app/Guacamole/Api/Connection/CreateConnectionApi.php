<?php

namespace App\Guacamole\Api\Connection;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class CreateConnectionApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(
        string $token,
        string $sourceData,
        string $name,
        int $id,
        string $ip,
        string $domain
    ): ResponseInterface {
        return $this->apiClient->post('api/session/data/' . $sourceData . '/connections', [
            'query' => [
                'token' => $token
            ],
            'headers' => [
                'Content-Type' => 'application/json;charset=utf-8'
            ],
            'body' => json_encode([
                'name' => $name,
                'parentIdentifier' => $id,
                'protocol' => 'rdp',
                'parameters' => [
                    'port' => '',
                    'read-only' => '',
                    'swap-red-blue' => '',
                    'cursor' => '',
                    'color-depth' => '',
                    'clipboard-encoding' => '',
                    'disable-copy' => '',
                    'disable-paste' => '',
                    'dest-port' => '',
                    'recording-exclude-output' => '',
                    'recording-exclude-mouse' => '',
                    'recording-include-keys' => '',
                    'create-recording-path' => '',
                    'enable-sftp' => '',
                    'sftp-port' => '',
                    'sftp-server-alive-interval' => '',
                    'enable-audio' => '',
                    'security' => 'nla',
                    'disable-auth' => '',
                    'ignore-cert' => true,
                    'gateway-port' => '',
                    'server-layout' => '',
                    'timezone' => '',
                    'console' => '',
                    'width' => '',
                    'height' => '',
                    'dpi' => '',
                    'resize-method' => 'display-update',
                    'console-audio' => '',
                    'disable-audio' => '',
                    'enable-audio-input' => '',
                    'enable-printing' => '',
                    'enable-drive' => '',
                    'create-drive-path' => '',
                    'enable-wallpaper' => '',
                    'enable-theming' => '',
                    'enable-font-smoothing' => '',
                    'enable-full-window-drag' => '',
                    'enable-desktop-composition' => '',
                    'enable-menu-animations' => '',
                    'disable-bitmap-caching' => '',
                    'disable-offscreen-caching' => '',
                    'disable-glyph-caching' => '',
                    'preconnection-id' => '',
                    'hostname' => $ip,
                    'username' => '',
                    'password' => '',
                    'domain' => $domain,
                    'gateway-hostname' => '',
                    'gateway-username' => '',
                    'gateway-password' => '',
                    'gateway-domain' => '',
                    'initial-program' => '',
                    'client-name' => '',
                    'printer-name' => '',
                    'drive-name' => '',
                    'drive-path' => '',
                    'static-channels' => '',
                    'remote-app' => '',
                    'remote-app-dir' => '',
                    'remote-app-args' => '',
                    'preconnection-blob' => '',
                    'load-balance-info' => '',
                    'recording-path' => '',
                    'recording-name' => '',
                    'sftp-hostname' => '',
                    'sftp-host-key' => '',
                    'sftp-username' => '',
                    'sftp-password' => '',
                    'sftp-private-key' => '',
                    'sftp-passphrase' => '',
                    'sftp-root-directory' => '',
                    'sftp-directory' => ''
                ],
                'attributes' => [
                    'max-connections' => '',
                    'max-connections-per-user' => '',
                    'weight' => '',
                    'failover-only' => '',
                    'guacd-port' => '',
                    'guacd-encryption' => '',
                    'guacd-hostname' => ''
                ]
            ])
        ]);
    }
}
