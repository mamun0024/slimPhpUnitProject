<?php

namespace App\Utils\Traits;

trait ResponseTrait
{
    /**
     * Response body.
     *
     * @param boolean $status Response Status.
     * @param integer $code Response code.
     * @param string $message Response message.
     * @param array $data Response data.
     * @param string $details Response data's details.
     * @return array
     */
    public function responseData($status, $code, $message, $data = null, $details = null)
    {
        $response = [
            'status'  => $status,
            'code'    => $code,
            'message' => $message
        ];

        if ($details) {
            $response['data'] = [
                'details' => $details
            ];
        } else {
            $response['data'] = $data;
        }

        return $response;
    }
}