<?php

namespace App\Guacamole\Objects\User;

class GuacamoleUserAttributesData
{
    public ?string $guacEmailAddress;
    public ?string $guacOrganizationalRole;
    public ?string $guacFullName;
    public ?string $expired;
    public ?string $timezone;
    public ?string $accessWindowStart;
    public ?string $guacOrganization;
    public ?string $accessWindowEnd;
    public ?string $disabled;
    public ?string $validUntil;
    public ?string $validFrom;

    public function __construct(?array $data = null)
    {
        if ($data === null) {
            $data = [];
        }
        $this->guacEmailAddress = $data["guac-email-address"] ?? null;
        $this->guacOrganizationalRole = $data["guac-organizational-role"] ?? null;
        $this->guacFullName = $data["guac-full-name"] ?? null;
        $this->expired = $data["expired"] ?? null;
        $this->timezone = $data["timezone"] ?? null;
        $this->accessWindowStart = $data["access-window-start"] ?? null;
        $this->guacOrganization = $data["guac-organization"] ?? null;
        $this->accessWindowEnd = $data["access-window-end"] ?? null;
        $this->disabled = $data["disabled"] ?? null;
        $this->validUntil = $data["valid-until"] ?? null;
        $this->validFrom = $data["valid-from"] ?? null;
    }

    public function getGuacFormat(): array
    {
        return [
                "guac-email-address" => $this->guacEmailAddress,
            "guac-organizational-role" => $this->guacOrganizationalRole,
            "guac-full-name" => $this->guacFullName,
            "expired" => $this->expired,
            "timezone" => $this->timezone,
            "access-window-start" => $this->accessWindowStart,
            "guac-organization" => $this->guacOrganization,
            "access-window-end" => $this->accessWindowEnd,
            "disabled" => $this->disabled,
            "valid-until" => $this->validUntil,
            "valid-from" => $this->validFrom
        ];
    }

    /**
     * @return string|null
     */
    public function getGuacEmailAddress(): ?string
    {
        return $this->guacEmailAddress;
    }

    /**
     * @param string|null $guacEmailAddress
     */
    public function setGuacEmailAddress(?string $guacEmailAddress): void
    {
        $this->guacEmailAddress = $guacEmailAddress;
    }

    /**
     * @return string|null
     */
    public function getGuacOrganizationalRole(): ?string
    {
        return $this->guacOrganizationalRole;
    }

    /**
     * @param string|null $guacOrganizationalRole
     */
    public function setGuacOrganizationalRole(?string $guacOrganizationalRole): void
    {
        $this->guacOrganizationalRole = $guacOrganizationalRole;
    }

    /**
     * @return string|null
     */
    public function getGuacFullName(): ?string
    {
        return $this->guacFullName;
    }

    /**
     * @param string|null $guacFullName
     */
    public function setGuacFullName(?string $guacFullName): void
    {
        $this->guacFullName = $guacFullName;
    }

    /**
     * @return string|null
     */
    public function getExpired(): ?string
    {
        return $this->expired;
    }

    /**
     * @param string|null $expired
     */
    public function setExpired(?string $expired): void
    {
        $this->expired = $expired;
    }

    /**
     * @return string|null
     */
    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    /**
     * @param string|null $timezone
     */
    public function setTimezone(?string $timezone): void
    {
        $this->timezone = $timezone;
    }

    /**
     * @return string|null
     */
    public function getAccessWindowStart(): ?string
    {
        return $this->accessWindowStart;
    }

    /**
     * @param string|null $accessWindowStart
     */
    public function setAccessWindowStart(?string $accessWindowStart): void
    {
        $this->accessWindowStart = $accessWindowStart;
    }

    /**
     * @return string|null
     */
    public function getGuacOrganization(): ?string
    {
        return $this->guacOrganization;
    }

    /**
     * @param string|null $guacOrganization
     */
    public function setGuacOrganization(?string $guacOrganization): void
    {
        $this->guacOrganization = $guacOrganization;
    }

    /**
     * @return string|null
     */
    public function getAccessWindowEnd(): ?string
    {
        return $this->accessWindowEnd;
    }

    /**
     * @param string|null $accessWindowEnd
     */
    public function setAccessWindowEnd(?string $accessWindowEnd): void
    {
        $this->accessWindowEnd = $accessWindowEnd;
    }

    /**
     * @return string|null
     */
    public function getDisabled(): ?string
    {
        return $this->disabled;
    }

    /**
     * @param string|null $disabled
     */
    public function setDisabled(?string $disabled): void
    {
        $this->disabled = $disabled;
    }

    /**
     * @return string|null
     */
    public function getValidUntil(): ?string
    {
        return $this->validUntil;
    }

    /**
     * @param string|null $validUntil
     */
    public function setValidUntil(?string $validUntil): void
    {
        $this->validUntil = $validUntil;
    }

    /**
     * @return string|null
     */
    public function getValidFrom(): ?string
    {
        return $this->validFrom;
    }

    /**
     * @param string|null $validFrom
     */
    public function setValidFrom(?string $validFrom): void
    {
        $this->validFrom = $validFrom;
    }
}