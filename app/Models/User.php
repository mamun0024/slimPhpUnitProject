<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\QueryException;

class User extends Model
{
    /*
    |--------------------------------------------------------------------------
    | CONSTANTS
    |--------------------------------------------------------------------------
    */
    const CREATED_AT     = 'created';
    const UPDATED_AT     = 'modified';
    const USER_ID        = 'id';
    const USER_FULL_NAME = 'name';
    const USER_EMAIL     = 'email';
    const USER_PASS      = 'pass';

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
                    self::USER_PASS      => hash('sha512', $request['pass'])
                ]
            );

            if ($user->wasRecentlyCreated) {
                $status  = true;
                $code    = 201;
                $message = 'User created successfully.';
                $data    = $user->toArray();
            } elseif ($user->wasChanged()) {
                $status  = true;
                $code    = 200;
                $message = 'User updated successfully.';
                $data    = $user->toArray();
            } else {
                $status  = false;
                $code    = 400;
                $message = 'Bad request !!!';
                $data    = null;
            }

        } catch (QueryException $e) {
            $status  = false;
            $code    = 409;
            $message = 'Conflict request !!!';
            $data    = null;

        } catch (\Exception $e) {
            $status  = false;
            $code    = 500;
            $message = $e->getMessage();
            $data    = null;
        }

        return [
            "status"  => $status,
            "code"    => $code,
            "message" => $message,
            "data"    => $data
        ];
    }
}
