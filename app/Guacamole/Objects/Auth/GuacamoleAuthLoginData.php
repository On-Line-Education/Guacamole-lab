<?php

namespace App\Guacamole\Objects\Auth;

class GuacamoleAuthLoginData {
    public string $authToken;
    public string $username;
    public string $dataSource;
    public array $availableDataSources;

    public function __construct(array $data)
    {
        $this->authToken = $data['authToken'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->dataSource = $data['dataSource'] ?? '';
        $this->availableDataSources = $data['availableDataSources'] ?? [];
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @param string $authToken
     */
    public function setAuthToken(string $authToken): void
    {
        $this->authToken = $authToken;
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
     * @return string
     */
    public function getDataSource(): string
    {
        return $this->dataSource;
    }

    /**
     * @param string $dataSource
     */
    public function setDataSource(string $dataSource): void
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @return array
     */
    public function getAvailableDataSources(): array
    {
        return $this->availableDataSources;
    }

    /**
     * @param array $availableDataSources
     */
    public function setAvailableDataSources(array $availableDataSources): void
    {
        $this->availableDataSources = $availableDataSources;
    }
}