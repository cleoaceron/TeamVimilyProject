<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class AddUser extends AbstractUser
{

    protected $request;

    protected $userRepository;

    public function __construct(Request $request, 
        UserRepository $userRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;

        parent::__construct($request, $userRepository);
    }

    /**
     *
     * Add User
     *
     * @return AbstractUser
     */
    public function handle(): AbstractUser
    {

        $item = $this->request->all();
        $item['uuid'] = Uuid::uuid4()->toString();

        $addUser = $this->userRepository->create($item);

        if( $addUser ){
            $this->response = $this->makeResponse(200, 'add_user.200');
            $this->response->model = $addUser;
        }
        else{
           $this->response =  $this->makeResponse(400, 'add_user.400');
           $this->response->model = null;
        }

        return $this;
    }
}