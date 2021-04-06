<?php


namespace App\DTO;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Model of error response",
 *     type="object",
 *     title="ApiErroResponseDTO"
 * )
 * Class ApiErrorResponseDTO
 * @package App\DTO
 */
class ApiErrorResponseDTO
{
    /**
     * @OA\Property(
     *     property="statusCode",
     *     type="integer",
     *     description="Status Error code"
     * )
     * @var integer $statusCode
     */
    private $statusCode;
    /**
     * @OA\Property(
     *     property="message",
     *     type="string",
     *     description="Error message"
     * )
     * @var string $message
     */
    private $message;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return ApiErrorResponseDTO
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return ApiErrorResponseDTO
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

}
