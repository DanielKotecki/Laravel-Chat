<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserChatRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class LogoutUserController extends Controller
{
    /**
     * @var UserChatRepositoryInterface
     */
    private UserChatRepositoryInterface $userChatRepository;

    /**
     * @param UserChatRepositoryInterface $userChatRepository
     */
    public function __construct(UserChatRepositoryInterface $userChatRepository)
    {
        $this->userChatRepository = $userChatRepository;

    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {  $user = auth()->user();
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        if ($user->temp_user){
            $this->userChatRepository->setDeleteTempUser($user->id);
        }
        return redirect('/');
    }
}
