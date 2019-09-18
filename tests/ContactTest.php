<?php

use Ramsey\Uuid\Uuid;

class ContactTest extends TestCase
{
    /**
     * Add Contact Test Case
     *
     * @return void
     */
    public function testAddContact()
    {
        //422
        $response = $this->post("admin/contact/add", []);
        $response->assertResponseStatus(422);
        $response->seeJsonStructure([
            "fullname",
            "mobile_number",
            "email"
        ]);

        //Create contact factory
        $contact = factory(\App\Models\Contact::class)->make();

        //200
        $response = $this->post("admin/contact/add", [
            "fullname" => $contact->fullname,
            "mobile_number" => $contact->mobile_number,
            "email" => $contact->email
        ]);
        
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'model'
        ]);
    }

    /**
     * Delete Contact Test Case
     *
     * @return void
     */
    public function testDeleteContact() 
    {
        //422
        $response = $this->post("admin/contact/delete", []);
        $response->assertResponseStatus(422);
        $response->seeJsonStructure([
            "uuid"
        ]);

        //Create contact factory
        $contact = factory(\App\Models\Contact::class)->create();

        //200
        $response = $this->post("admin/contact/delete", [
            "uuid" => $contact->uuid
        ]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message'
        ]);
    }
}
