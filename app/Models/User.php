<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /*
    |--------------------------------------------------------------------------
    | CONSTANTS
    |--------------------------------------------------------------------------
    */
    const USER_ID        = 'id';
    const USER_FULL_NAME = 'id';
    const USER_EMAIL     = 'title';
    const USER_PASS      = 'is_ssl_live';

    protected $table    = 'users';
    protected $fillable = [
        self::USER_ID,
        self::USER_FULL_NAME,
        self::USER_EMAIL,
        self::USER_PASS
    ];

    /**
     * Update or create a user
     *
     * @param array $request
     * @return array
     */
    public function createOrUpdate($request)
    {
        try {
            $user = self::updateOrCreate(
                [
                    'id' => $request['id']
                ],
                [
                    self::USER_FULL_NAME => $request['name'],
                    self::USER_EMAIL     => $request['email'],
                    self::USER_PASS      => $request['pass']
                ]
            );

            if ($user->wasRecentlyCreated) {
                $statusCode = 201;
                $message    = 'User created successfully!';
            } elseif ($user->wasChanged()) {
                $statusCode = 200;
                $message    = 'User updated successfully!';
            } else {
                $statusCode = 200;
                $message    = 'No changes were made.';
            }
            $data = $user->toArray();

        } catch (\Exception $e) {
            $statusCode = 500;
            $message = $e->getMessage();
            $data = null;
        }

        return [
            "statusCode" => $statusCode,
            "message"    => $message,
            "data"       => $data
        ];
    }
}
