<?php

namespace App\Guacamole\Objects\User;

class GuacamoleUserData
{
    public ?int $id = null;
    public ?string $username;
    public ?int $lastActive;
    public ?string $password;
    public GuacamoleUserAttributesData $attributes;

    public function __construct(array $data)
    {
        $this->username = $data['username'] ?? null;
        $this->attributes = new GuacamoleUserAttributesData($data['attributes'] ?? null);
        $this->lastActive = $data['lastActive'] ?? 0;
        $this->password = $data['password'] ?? null;
    }

    public function getGuacFormat(): array
    {
        return [
            "username" => $this->username,
            "password" => $this->password,
            "attributes" => $this->attributes->getGuacFormat(),
        ];
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return GuacamoleUserAttributesData
     */
    public function getAttributes(): GuacamoleUserAttributesData
    {
        return $this->attributes;
    }

    /**
     * @param GuacamoleUserAttributesData $attributes
     */
    public function setAttributes(GuacamoleUserAttributesData $attributes): void
    {
        $this->attributes = $attributes;
    }
}
