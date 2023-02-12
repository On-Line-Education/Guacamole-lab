<?php

namespace App\System;

class SystemPermissions
{
    public const USER_MODIFY = 'user:modify';
    public const USER_DISPLAY = 'user:display';

    public const CLASSROOM_DISPLAY = 'classroom:display';
    public const CLASSROOM_IMPORT = 'classroom:import';
    public const CLASSROOM_MODIFY = 'classroom:modify';

    public const CLASSROOM_TIME = 'classroom:time';
    public const CLASSROOM_TIME_MODIFY = 'classroom:time:modify';

    public const CLASSROOM_COMPUTER_DISPLAY = 'classroom:computer:display';
    public const CLASSROOM_COMPUTER_MODIFY = 'classroom:computer:modify';
    public const CLASSROOM_COMPUTER_IMPORT = 'classroom:computer:import';

    public const GROUP_DISPLAY = 'group:display';
    public const GROUP_MODIFY = 'group:modify';
}
