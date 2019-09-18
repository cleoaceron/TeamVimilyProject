<?php

use Ramsey\Uuid\Uuid;

class UserTest extends TestCase
{
    /**
     * Add User Test Case
     *
     * @return void
     */
    public function testAddUser()
    {
        //422
        $response = $this->post("admin/user/add", []);
        $response->assertResponseStatus(422);
        $response->seeJsonStructure([
            "firstname",
            "lastname",
            "mobile_number",
            "email",
            "birthdate",
            "gender"
        ]);

        //Create user factory
        $user = factory(\App\Models\User::class)->make();

        //200
        $response = $this->post("admin/user/add", [
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "mobile_number" => $user->mobile_number,
            "email" => $user->email,
            "birthdate" => $user->birthdate,
            "gender" => $user->gender
        ]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'model'
        ]);
    }

    /**
     * Update User Test Case
     *
     * @return void
     */
    public function testUpdateUser() 
    {

        //422
        $response = $this->post("admin/user/update/1", []);
        $response->assertResponseStatus(422);
        $response->seeJsonStructure([
            "firstname",
            "lastname",
            "mobile_number",
            "email",
            "birthdate",
            "gender"
        ]);

        //Create user factory
        $user = factory(\App\Models\User::class)->create();

        //200
        $response = $this->post("admin/user/update/{$user->uuid}", [
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "mobile_number" => $user->mobile_number,
            "email" => $user->email,
            "birthdate" => $user->birthdate,
            "gender" => $user->gender
        ]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message'
        ]);
    }

    /**
     * Delete User Test Case
     *
     * @return void
     */
    public function testDeleteUser() 
    {

        //422
        $response = $this->post("admin/user/delete", []);
        $response->assertResponseStatus(422);
        $response->seeJsonStructure([
            "uuid"
        ]);

        //Create user factory
        $user = factory(\App\Models\User::class)->create();

        //200
        $response = $this->post("admin/user/delete", [
            "uuid" => $user->uuid
        ]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message'
        ]);
    }

    /**
     * View User Test Case
     *
     * @return void
     */
    public function testViewUser() 
    {
        //Create user factory
        $user = factory(\App\Models\User::class)->create();
        
        //200
        $response = $this->get("admin/user/view/{$user->uuid}");
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            "message",
            "model" => [
                "uuid",
                "firstname",
                "lastname",
                "mobile_number",
                "email",
                "birthdate",
                "gender"
            ]
        ]);
    }

    /**
     * Get Users Test Case
     *
     * @return void
     */
    public function testUserList() 
    {

        //Create user factory
        $user = factory(\App\Models\User::class, 9)->create();
        $user = factory(\App\Models\User::class)->create([
            'firstname' => 'John'
        ]);

        //list order
        $response = $this->post("admin/user/list", [
            "keyword" => ""
        ]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            "message",
            "list" => [
                "*" => [
                    "uuid",
                    "firstname",
                    "lastname",
                    "mobile_number",
                    "email",
                    "birthdate",
                    "gender"
                ]
            ],
            "max_page",
            "next_page",
            "prev_page"
        ]);
    }
}
