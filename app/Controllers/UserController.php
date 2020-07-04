<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\Traits\ResponseTrait;
use Respect\Validation\Validator as V;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends Controller
{
    use ResponseTrait;

    /**
     * Accept request for create or update user.
     *
     * @param Request $request User inputs
     * @param Response $response
     * @param array $args Arguments
     * @return mixed
     * @throws \Exception
     * @author "Md. Abdullah-Al- Mamun" <abdullah.mamun@bs-23.net>
     *
     */
    public function createOrUpdate(Request $request, Response $response, $args = null)
    {
        // Get user id from POST and PUT method.
        if ($request->getMethod() === 'POST') {
            $user_id = $request->getParam('id');
        } else {
            $user_id = $args['id'];
        }

        // Catch the validation errors.
        $validator = $this->userValidate($request, $user_id);
        if (!$validator) {
            $this->response_status  = true;
            $this->response_code    = 422;
            $this->response_message = "Request param validation error.";
            $this->response_data    = $validator;
            $this->response_details = null;

        } else {
            try {
                $user_model = new User();
                $user_data  = [
                    User::USER_ID        => (int) $user_id,
                    User::USER_FULL_NAME => $request->getParam(User::USER_FULL_NAME),
                    User::USER_EMAIL     => $request->getParam(User::USER_EMAIL),
                    User::USER_PASS      => $request->getParam(User::USER_PASS)
                ];

                if ($request->getMethod() === 'POST') {
                    //Create user.
                    $response_data = $user_model->createOrUpdate($user_data);
                } else {
                    //Update user.
                    $response_data = $user_model->createOrUpdate($user_data);
                }
                $this->response_status  = true;
                $this->response_code    = $response_data['statusCode'];
                $this->response_message = $response_data['message'];
                $this->response_data    = $response_data['data'];
                $this->response_details = null;

            } catch (\Exception $e) {
                $this->response_status  = false;
                $this->response_code    = 500;
                $this->response_message = "Internal server error.";
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
     * @param array $user_id User id
     * @return mixed
     * @throws \Exception
     * @author "Md. Abdullah-Al- Mamun" <abdullah.mamun@bs-23.net>
     *
     */
    private function userValidate(Request $request, $user_id)
    {
        $user_id_array = [
            User::USER_ID => $user_id
        ];

        // Validate user ID
        $validate_user_id = $this->c->get('validator')->array($user_id_array, [
            User::USER_ID => [
                'rules'   => V::notBlank()->numeric(),
                'message' => "User id is a mandatory field."
            ]
        ]);

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

        if ($validator->isValid() && $validate_user_id->isValid()) {
            $status = true;
        } else {
            $status = $validator->getErrors();
        }

        return $status;
    }
}