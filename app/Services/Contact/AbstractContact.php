<?php

namespace App\Services\Contact;

use App\Services\AbstractBaseService;
use App\Repositories\Contact\ContactRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

abstract class AbstractContact extends AbstractBaseService
{
    protected $module = 'contact';

    protected $version = 'v1';

    protected $contactRepository;

    public function __construct(
        Request $request, 
        ContactRepository $contactRepository
    )
    {
        parent::__construct($request);
        $this->contactRepository = $contactRepository;
    }

    abstract public function handle(): AbstractContact;
}