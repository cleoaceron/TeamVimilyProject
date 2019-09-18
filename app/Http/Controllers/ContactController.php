<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contact\ContactInterface as Service;

class ContactController extends Controller
{
    const CONTACT_VALIDATION = [
        'fullname' => 'required',
        'mobile_number' => 'required',
        'email' => 'required|email'
    ];

    protected $service;

    public function __construct(Service $service)
    {
        $this->service =  $service;
    }

    /**
     * Create a new contact.
     *
     * @return void
     */
    public function addContact(Request $request) 
    {
        $this->validate($request, self::CONTACT_VALIDATION);

        $response = $this->service->addContact($request->all());

        return response()->json(
            [
                'message' => $response->message, 
                'model' => $response->model
            ], $response->status);
    }

    /**
     * Delete a contact.
     *
     * @return void
     */
    public function deleteContact(Request $request) 
    {
        $this->validate($request, [
            "uuid" => "required|uuid",
        ]);

        $result = $this->service->deleteContact($request->get('uuid'));
        
        if ($result->status == 200) {
            return response()->json([
                        "message" => $result->message,
            ]);
        }
    }
}
