<?php

namespace App\Services\User;

use Ramsey\Uuid\Uuid;
use App\Services\AbstractBaseService;
use App\Services\User\AddUser;
use App\Services\User\UpdateUser;
use App\Services\User\DeleteUser;
use App\Repositories\User\UserRepository as Repository;
use Illuminate\Http\Request;

class UserService extends AbstractBaseService implements UserInterface {

    protected $module = 'user';
    protected $repository;
    protected $request;

    const PERPAGE = 10;

    public function __construct(Request $request, Repository $repository) 
    {
        $this->repository = $repository;
        $this->request = $request;
        parent::__construct($request);
    }

    /**
     * Add User Service
     *
     * @param Array $item
     * @return response
     */
    public function addUser($item) 
    {
        return (new AddUser($this->request, $this->repository))->handle()->response();
    }

    /**
     * Update User Service
     *
     * @param String $uuid
     * @return response
     */
    public function updateUser($uuid) 
    {
        return (new UpdateUser($uuid, $this->request, $this->repository))->handle()->response();
    }

    /**
     * Delete User Service
     *
     * @param String $uuid
     * @return response
     */
    public function deleteUser($uuid) 
    {
        return (new DeleteUser($uuid, $this->request, $this->repository))->handle()->response();
    }

    /**
     * View User Service
     *
     * @param String $uuid
     * @return response
     */
    public function viewUser($uuid) 
    {
        $model = $this->repository->find('uuid', $uuid);
        $this->response = $this->makeResponse(200, 'view_user.200');

        $this->response->model = $model;
        return $this->response;
    }

    /**
     * Get User List Service
     *
     * @param String $uuid
     * @return response
     */
    public function getUserList($request, $page) 
    {
        $list = $this->repository->paginate($request, static::PERPAGE, $page);
        $this->response = $this->makeResponse(200, 'list_user.200');
        
        $this->response->list = $list->list;
        $this->response->max_page = $list->max_page;
        $this->response->next_page = $list->next_page;
        $this->response->prev_page = $list->prev_page;

        return $this->response;
    }

}
