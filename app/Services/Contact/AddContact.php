<?php

namespace App\Services\Contact;

use App\Repositories\Contact\ContactRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class AddContact extends AbstractContact
{

    protected $request;

    protected $contactRepository;

    public function __construct(Request $request, 
        ContactRepository $contactRepository)
    {
        $this->request = $request;
        $this->contactRepository = $contactRepository;

        parent::__construct($request, $contactRepository);
    }

    /**
     *
     * Add Contact
     *
     * @return AbstractContact
     */
    public function handle(): AbstractContact
    {

        $item = $this->request->all();
        $item['uuid'] = Uuid::uuid4()->toString();

        $addContact = $this->contactRepository->create($item);

        if( $addContact ){
            $this->response = $this->makeResponse(200, 'add_contact.200');
            $this->response->model = $addContact;
        }
        else{
           $this->response =  $this->makeResponse(400, 'add_contact.400');
           $this->response->model = null;
        }

        return $this;
    }
}