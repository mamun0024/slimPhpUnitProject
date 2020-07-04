<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\Traits\HelperTrait;
use App\Utils\Traits\ResponseTrait;
use Respect\Validation\Validator as V;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends Controller
{
    use HelperTrait;
    use ResponseTrait;

    /**
     * Accept request for create or update user.
     *
     * @param Request $request User inputs
     * @param Response $response
     * @param array $args Arguments
     * @return mixed
     * @throws \Exception
     *
     * @author "Md. Abdullah-Al- Mamun" <mamuncse824@gmail.com>
     *
     */
    public function createOrUpdate(Request $request, Response $response, $args = null)
    {
        $request_type = $request->getMethod();

        // Get user id from PUT method.
        if ($request_type === 'PUT') {
            $user_id = $args['id'];
        } else {
            $user_id = null;
        }

        // Catch the validation errors.
        $validator = $this->userValidate($request, $request_type, $user_id);

        if (!$validator || (is_array($validator) && !empty($validator))) {
            $this->response_status  = false;
            $this->response_code    = 422;
            $this->response_message = "Request param validation error !!!";
            $this->response_data    = $validator;
            $this->response_details = null;

        } else {
            try {
                $user_model = new User();
                $user_data  = [
                    User::USER_ID        => ($this->emptyCheck($user_id)) ? (int) $user_id : null,
                    User::USER_FULL_NAME => $request->getParam(User::USER_FULL_NAME),
                    User::USER_EMAIL     => $request->getParam(User::USER_EMAIL),
                    User::USER_PASS      => $request->getParam(User::USER_PASS)
                ];

                // Create or Update user.
                $response_data = $user_model->createOrUpdate($user_data);

                $this->response_status  = $response_data['status'];
                $this->response_code    = $response_data['code'];
                $this->response_message = $response_data['message'];
                $this->response_data    = $response_data['data'];
                $this->response_details = null;

            } catch (\Exception $e) {
                $this->response_status  = false;
                $this->response_code    = 500;
                $this->response_message = "Internal server error !!!";
                $this->response_data    = null;
                $this->response_details = $e->getMessage();
            }
        }
        return $response->withStatus($this->response_code)->withJson($this->responseData());
    }

    /**
     * Validate user request.
     *
     * @param Request $request User inputs
     * @param string $request_type Request Type: POST or PUT
     * @param string $user_id User id
     * @return mixed
     *
     * @author "Md. Abdullah-Al- Mamun" <mamuncse824@gmail.com>
     *
     */
    private function userValidate(Request $request, $request_type, $user_id)
    {
        if ($request_type === 'PUT') {
            $user_id_array = [
                User::USER_ID => $user_id
            ];

            // Validate user ID
            $validate_user_id = $this->c->get('validator')->array($user_id_array, [
                User::USER_ID => [
                    'rules'   => V::notBlank()->numeric(),
                    'message' => "User id is not okay."
                ]
            ]);
        }

        // Validate other parameters.
        $validator = $this->c->get('validator')->validate($request, [
            User::USER_FULL_NAME => [
                'rules'   => V::length(0, 155),
                'message' => "User name is too big."
            ],
            User::USER_EMAIL => [
                'rules'   => V::notBlank()->email()->length(1, 255),
                'message' => "User email is not okay."
            ],
            User::USER_PASS => [
                'rules'   => V::notBlank()->length(1, 255),
                'message' => "User password is not okay."
            ]
        ]);

        if (($request_type === 'POST') && $validator->isValid()) {
            $status = true;
        } elseif (($request_type === 'PUT') && $validator->isValid() && $validate_user_id->isValid()) {
            $status = true;
        } else {
            $status = $validator->getErrors();
        }
        return $status;
    }
}