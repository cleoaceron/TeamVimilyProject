<?php

namespace App\Services\Contact;

interface ContactInterface {

    public function addContact($item);

    public function deleteContact($uuid);

    public function getContactList($request, $page);
}
