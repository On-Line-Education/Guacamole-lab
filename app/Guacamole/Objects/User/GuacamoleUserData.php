<?php

namespace App\Guacamole\Objects\User;

class GuacamoleUserData {
    public string $username;
    public GuacamoleUserAttributesData $attributes;

    public function __construct(array $data)
    {
        $this->username = $data['username'] ?? null;
        $this->attributes = new GuacamoleUserAttributesData($data['attributes'] ?? null);
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