<?php

return [
    'something_wrong' => 'Something went wrong.',
    'user' => [
        'add_user' => [
            '200' => 'User successfully added.',
            '404' => 'User not found.',
            '400' => 'Adding user failed.',
        ],
        'update_user' => [
            '200' => 'User successfully updated.',
            '404' => 'User not found.',
            '400' => 'Updating user failed.',
        ],
        'delete_user' => [
            '200' => 'User successfully deleted.',
            '404' => 'User not found.',
            '400' => 'Deleting user failed.',
        ],
        'list_user' => [
            '200' => 'User successfully fetched.',
            '404' => 'User not found.'
        ],
        'view_user' => [
            '200' => 'User successfully fetched.',
            '404' => 'User not found.'
        ]
    ]
];
