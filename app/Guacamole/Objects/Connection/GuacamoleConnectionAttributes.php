<?php

namespace App\Guacamole\Objects\Connection;

class GuacamoleConnectionAttributes
{
    public ?string $failover_only = null;
    public ?string $guacd_encryption;
    public ?string $weight;
    public ?string $max_connections;
    public ?string $guacd_hostname;
    public ?string $guacd_port;
    public ?string $max_connections_per_user;

    public function __construct(array $data)
    {
        $this->failover_only = $data['failover-only'] ?? "";
        $this->guacd_encryption = $data['guacd-encryption'] ?? "";
        $this->weight = $data['weight'] ?? "";
        $this->max_connections = $data['max-connections'] ?? "";
        $this->guacd_hostname = $data['guacd-hostname'] ?? "";
        $this->guacd_port = $data['guacd-port'] ?? "";
        $this->max_connections_per_user = $data['max-connections-per-user'] ?? "";
    }

    public function getGuacFormat(): array
    {
        return [
            "failover-only" => $this->failover_only,
            "guacd-encryption" => $this->guacd_encryption,
            "weight" => $this->weight,
            "max-connections" => $this->max_connections,
            "guacd-hostname" => $this->guacd_hostname,
            "guacd-port" => $this->guacd_port,
            "max-connections-per-user" => $this->max_connections_per_user,
        ];
    }
}
