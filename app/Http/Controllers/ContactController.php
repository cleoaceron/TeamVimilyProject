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

    /**
     * View a contact.
     *
     * @return void
     */
    public function viewContact($uuid) 
    {

        $result = $this->service->viewContact($uuid);

        if ($result->status == 200) {
            return response()->json([
                        "message" => $result->message,
                        "model" => $result->model,
            ]);
        }

        return response()->json([
                    "model" => null,
                    "message" => $result->message,
                        ], $result->status);
    }

    /**
     * Get contact list.
     *
     * @return void
     */
    public function getContactList(Request $request, $page = 1) 
    {

        $getList = $this->service->getContactList($request->toArray(), $page);

        if ($getList->status == 200) {
            return response()->json([
                        "message" => $getList->message,
                        "list" => $getList->list,
                        "max_page" => $getList->max_page,
                        "prev_page" => $getList->prev_page,
                        "next_page" => $getList->next_page
            ]);
        }

        return response()->json([
                    "list" => null,
                    "message" => $getList->message,
                    "max_page" => null,
                    "prev_page" => null,
                    "next_page" => null
                        ], $getList->status);
    }
}
