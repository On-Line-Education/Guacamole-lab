<?php

namespace App\System;

class SystemPermissions
{
    public const STUDENT = 'student';
    public const INSTRUCTOR = 'instructor';
    public const ADMIN = 'admin';

    /**
     * @param string ...$abilities
     */
    public static function hasAll(string ...$abilities): string
    {
        return self::buildPermissionsString('abilities:', ...$abilities);
    }

    /**
     * @param string ...$abilities
     */
    public static function hasAtLeastOne(string ...$abilities): string
    {
        return self::buildPermissionsString('ability:', ...$abilities);
    }

    protected static function buildPermissionsString(string $prefix, string ...$abilities): string
    {
        $output = $prefix;
        $abilities[] = self::ADMIN; // insert admin here
        $count = count($abilities);
        foreach ($abilities as $index => $ability) {
            if ($count !== $index + 1) {
                $output .= $ability . ',';
            } else {
                $output .= $ability;
            }
        }
        return $output;
    }
}
