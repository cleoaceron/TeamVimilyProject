<?php

namespace App\Services\Contact;

use Ramsey\Uuid\Uuid;
use App\Services\AbstractBaseService;
use App\Services\Contact\AddContact;
use App\Services\Contact\DeleteContact;
use App\Repositories\Contact\ContactRepository as Repository;
use Illuminate\Http\Request;

class ContactService extends AbstractBaseService implements ContactInterface {

    protected $module = 'contact';
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
     * Add Contact Service
     *
     * @param Array $item
     * @return response
     */
    public function addContact($item) 
    {
        return (new AddContact($this->request, $this->repository))->handle()->response();
    }

    /**
     * Delete Contact Service
     *
     * @param String $uuid
     * @return response
     */
    public function deleteContact($uuid) 
    {
        return (new DeleteContact($uuid, $this->request, $this->repository))->handle()->response();
    }

    /**
     * View Contact Service
     *
     * @param String $uuid
     * @return response
     */
    public function viewContact($uuid) 
    {
        $model = $this->repository->find('uuid', $uuid);
        $this->response = $this->makeResponse(200, 'view_contact.200');

        $this->response->model = $model;
        return $this->response;
    }

    /**
     * Get Contact List Service
     *
     * @param String $uuid
     * @return response
     */
    public function getContactList($request, $page) 
    {
        $list = $this->repository->paginate($request, static::PERPAGE, $page);
        $this->response = $this->makeResponse(200, 'list_contact.200');
        
        $this->response->list = $list->list;
        $this->response->max_page = $list->max_page;
        $this->response->next_page = $list->next_page;
        $this->response->prev_page = $list->prev_page;

        return $this->response;
    }
}
