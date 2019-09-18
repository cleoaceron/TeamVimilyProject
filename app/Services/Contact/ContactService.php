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

}
