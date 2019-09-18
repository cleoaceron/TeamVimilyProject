<?php

namespace App\Services\Contact;

use App\Repositories\Contact\ContactRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class DeleteContact extends AbstractContact
{
    protected $uuid;

    protected $request;

    protected $contactRepository;

    public function __construct(
        $uuid,
        Request $request, 
        ContactRepository $contactRepository)
    {
        $this->uuid = $uuid;

        $this->request = $request;

        $this->contactRepository = $contactRepository;

        parent::__construct($request, $contactRepository);
    }

    /**
     *
     * Delete Contact
     *
     * @return AbstractContact
     */
    public function handle(): AbstractContact
    {

        $contact = $this->contactRepository->find('uuid', $this->uuid);
        $deleteContact = $this->contactRepository->delete($contact);

        if( $deleteContact ){
            $this->response = $this->makeResponse(200, 'delete_contact.200');
        }
        else{
           $this->response =  $this->makeResponse(400, 'delete_contact.400');
        }

        return $this;
    }
}