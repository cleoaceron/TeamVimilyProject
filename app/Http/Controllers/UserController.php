<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\UserInterface as Service;

class UserController extends Controller
{

    const USER_VALIDATION = [
        'firstname' => 'required',
        'lastname' => 'required',
        'mobile_number' => 'required',
        'email' => 'required|email',
        'birthdate' => 'required',
        'gender' => 'required'
    ];

    protected $service;

    public function __construct(Service $service)
    {
        $this->service =  $service;
    }

    /**
     * Create a new user.
     *
     * @return void
     */
    public function addUser(Request $request) 
    {
        $this->validate($request, self::USER_VALIDATION);

        $response = $this->service->addUser($request->all());

        return response()->json(
            [
                'message' => $response->message, 
                'model' => $response->model
            ], $response->status);
    }

    /**
     * Update a user.
     *
     * @return void
     */
    public function updateUser(Request $request, $uuid) {

        $this->validate($request, self::USER_VALIDATION);

        $response = $this->service->updateUser($uuid);

        return response()->json(
        [
            'message' => $response->message
        ], $response->status);
    }

    /**
     * Delete a user.
     *
     * @return void
     */
    public function deleteUser(Request $request) 
    {

        $this->validate($request, [
            "uuid" => "required|uuid",
        ]);

        $result = $this->service->deleteUser($request->get('uuid'));
        
        if ($result->status == 200) {
            return response()->json([
                        "message" => $result->message,
            ]);
        }
    }

    /**
     * View a user.
     *
     * @return void
     */
    public function viewUser($uuid) 
    {

        $result = $this->service->viewUser($uuid);

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
     * Get user list.
     *
     * @return void
     */
    public function getUserList(Request $request, $page = 1) 
    {

        $getList = $this->service->getUserList($request->toArray(), $page);

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
