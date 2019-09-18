<?php

namespace App\Services\User;

use App\Services\AbstractBaseService;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

abstract class AbstractUser extends AbstractBaseService
{
    protected $module = 'user';

    protected $version = 'v1';

    protected $userRepository;

    public function __construct(
        Request $request, 
        UserRepository $userRepository
    )
    {
        parent::__construct($request);
        $this->userRepository = $userRepository;
    }

    abstract public function handle(): AbstractUser;
}