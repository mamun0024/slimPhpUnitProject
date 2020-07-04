<?php

namespace App\Utils\Traits;

trait ResponseTrait
{
    protected $response_status;
    protected $response_code;
    protected $response_message;
    protected $response_data;
    protected $response_details;

    /**
     * Response body.
     *
     */
    public function responseData()
    {
        $response = [
            'status'  => $this->response_status,
            'code'    => $this->response_code,
            'message' => $this->response_message
        ];

        if ($this->response_details) {
            $response['data'] = [
                'details' => $this->response_details
            ];
        } else {
            $response['data'] = $this->response_data;
        }

        return $response;
    }
}