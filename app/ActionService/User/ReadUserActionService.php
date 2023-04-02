<?php

namespace App\ActionService\User;

use App\Action\Login\GuacamoleAuthLoginAction;
use App\Action\User\UserGetAllAction;
use App\Action\User\UserGetByUsernameAction;
use App\Action\User\UserSearchAction;
use App\ActionService\AbstractActionService;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Request;

class ReadUserActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserGetByUsernameAction         $userGetByUsernameAction,
        private readonly UserGetAllAction          $userGetAllAction,
        private readonly UserSearchAction          $userSearchAction,
        private readonly GuacamoleAuthLoginAction $guacamoleAuthLoginAction,
    ) {
        parent::__construct();
    }

    public function __invoke(Request $request, ?User $user = null, ?string $search = null)
    {
        $guacAuth = ($this->guacamoleAuthLoginAction)(env('GUACAMOLE_ADMIN'), env('GUACAMOLE_ADMIN_PASSWORD'));
        
        $users = [];
        if ($user !== null) {
            if (Auth::user()->isStudent() && $user->id !== Auth::id()) {
                throw new UnauthorizedException();
            }
            $guacUser = ($this->userGetByUsernameAction)($guacAuth, $user->username);
            return ($this->responder)(
                array_merge(
                    $user->getUserWithGuacDataArray($guacUser),
                    ['classes' => $user->getGroups()]

                )
            );
        } elseif ($search !== null && !Auth::user()->isStudent()) {
            $users = ($this->userSearchAction)($guacAuth, $search);
        } elseif (!Auth::user()->isStudent()) {
            $users = ($this->userGetAllAction)($guacAuth);
        }
        foreach ($users as &$guacUser) {
            $usr = User::where('username', $guacUser->username)->first();
            $guacUser->id = $usr?->id ?? null;
            $usrGroups = $usr?->getGroups() ?? [];
            $guacUser = $usr?->getUserWithGuacDataArray($guacUser) ?? $guacUser->getGuacFormat();
            $guacUser = array_merge(
                ['classes' => $usrGroups],
                $guacUser
            );
            unset($guacUser['password']);
        }

        if ($request->has('system-only') && $request->input('system-only') === 'true') {
            $users = array_values(
                array_filter($users, function (&$element) {
                    if (!array_key_exists('id', (array)$element)) {
                        $element['id'] = null;
                    }
                    return ((array)$element)['id'] !== null;
                })
            );
        }

        return ($this->responder)($users);
    }
}
