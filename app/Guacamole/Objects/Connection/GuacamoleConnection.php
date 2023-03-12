<?php

namespace App\Guacamole\Objects\Connection;

class GuacamoleConnection
{
    public ?string $name = null;
    public ?int $identifier;
    public ?int $parentIdentifier;
    public ?string $protocol;
    public ?int $activeConnections;
    public GuacamoleConnectionAttributes $attributes;
    public GuacamoleConnectionParameters $parameters;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->identifier = $data['identifier'] ?? null;
        $this->parentIdentifier = $data['parentIdentifier'] ?? null;
        $this->protocol = $data['protocol'] ?? null;
        $this->activeConnections = $data['activeConnections'] ?? null;
        $this->attributes = new GuacamoleConnectionAttributes($data['attributes'] ?? null);
        $this->parameters = new GuacamoleConnectionParameters($data['parameters'] ?? null);
    }

    public function getGuacFormat(): array
    {
        return [
            'name' => $this->name,
            'identifier' => $this->identifier ,
            'parentIdentifier' => $this->parentIdentifier,
            'protocol' => $this->protocol ,
            'activeConnections' => $this->activeConnections,
            "attributes" => $this->attributes->getGuacFormat(),
            "parameters" => $this->parameters->getGuacFormat()
        ];
    }
}
