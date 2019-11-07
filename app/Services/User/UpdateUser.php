<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class UpdateUser extends AbstractUser
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
     * Update User
     *
     * @return AbstractUser
     */
    public function handle(): AbstractUser
    {

        $item = $this->request->all();

        $user = $this->userRepository->find('uuid', $this->uuid);
        $updateItem = $this->userRepository->update($user, $item);

        if( $updateItem ){
            $this->response = $this->makeResponse(200, 'update_user.200');
            $this->response->model = $updateItem;
        }
        else{
           $this->response =  $this->makeResponse(400, 'update_user.400');
           $this->response->model = null;
        }

        return $this;
    }
}