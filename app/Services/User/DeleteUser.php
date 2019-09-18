<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class DeleteUser extends AbstractUser
{
    protected $uuid;

    protected $request;

    protected $userRepository;

    public function __construct(
        $uuid,
        Request $request, 
        UserRepository $userRepository)
    {
        $this->uuid = $uuid;

        $this->request = $request;

        $this->userRepository = $userRepository;

        parent::__construct($request, $userRepository);
    }

    /**
     *
     * Delete User
     *
     * @return AbstractUser
     */
    public function handle(): AbstractUser
    {

        $user = $this->userRepository->find('uuid', $this->uuid);
        $deleteUser = $this->userRepository->delete($user);

        if( $deleteUser ){
            $this->response = $this->makeResponse(200, 'delete_user.200');
        }
        else{
           $this->response =  $this->makeResponse(400, 'delete_user.400');
        }

        return $this;
    }
}