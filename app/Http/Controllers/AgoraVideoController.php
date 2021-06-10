<?php

namespace App\Http\Controllers;

// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Class\ClassRepositoryInterface;
use App\Repositories\Schedule\ScheduleRepositoryInterface;

use App\Class\AgoraDynamicKey\RtcTokenBuilder;
use App\Events\MakeAgoraCall;

class AgoraVideoController extends Controller
{
    /**
     * @var App\Repositories\UserRepository
     * @var App\Repositories\ClassRepository
     * @var App\Repositories\ScheduleRepository
     */
    protected $repository;
    protected $classRepository;
    protected $scheduleRepository;

    /**
     * Construct
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(
        UserRepositoryInterface $repository,
        ClassRepositoryInterface $classRepository,
        ScheduleRepositoryInterface $scheduleRepository
    )
    {
        $this->repository = $repository;
        $this->classRepository = $classRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    public function index(Request $request)
    {
        // fetch all users apart from the authenticated user
        $users = $this->repository->storeNotMe();
        $classes = $this->scheduleRepository->schedule();

        return view('agora-chat', ['users' => $users, 'classes' => collect($classes)]);
    }

    public function token(Request $request)
    {
        $appID = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');
        $channelName = $request->channelName;
        $user = Auth::user()->name;
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = now()->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);

        return $token;
    }

    public function callUser(Request $request)
    {

        $data['userToCall'] = $request->user_to_call;
        $data['channelName'] = $request->channel_name;
        $data['from'] = Auth::id();

        broadcast(new MakeAgoraCall($data))->toOthers();
    }
}
