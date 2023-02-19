<?php

namespace App\System;

class SystemPermissions
{
    public const USER_MODIFY = 'user-modify';
    public const USER_DISPLAY = 'user-display';

    public const CLASSROOM_DISPLAY = 'classroom-display';
    public const CLASSROOM_IMPORT = 'classroom-import';
    public const CLASSROOM_MODIFY = 'classroom-modify';

    public const CLASSROOM_TIME = 'classroom-time';
    public const CLASSROOM_TIME_MODIFY = 'classroom-time-modify';

    public const CLASSROOM_COMPUTER_DISPLAY = 'classroom-computer-display';
    public const CLASSROOM_COMPUTER_MODIFY = 'classroom-computer-modify';
    public const CLASSROOM_COMPUTER_IMPORT = 'classroom-computer-import';

    public const GROUP_DISPLAY = 'group-display';
    public const GROUP_MODIFY = 'group-modify';

    /**
     * @param string ...$abilities
     */
    public static function hasAll(string ...$abilities): string {
        return self::buildPermissionsString('abilities:', ...$abilities);
    }

    /**
     * @param string ...$abilities
     */
    public static function hasAtLeastOne(string ...$abilities): string {
        return self::buildPermissionsString('ability:', ...$abilities);
    }
    protected static function buildPermissionsString(string $prefix, string ...$abilities): string {
        $output = $prefix;
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
