<?php
namespace App\Structures;

/**
 * Class Response
 * @package App\Stractures
 */
class Response
{
    /** @var int */
    protected $statusCode;

    /** @var string */
    protected $message;

    /** @var array */
    protected $contents;


    /**
     * インスタンスを生成する
     *
     * @param int    $statusCode
     * @param string $message
     * @param array  $contents
     * @return Response
     */
    public static function create(int $statusCode, string $message = '', array $contents = []): Response
    {
        $self = new self;

        $self->statusCode = $statusCode;
        $self->message    = $message;
        $self->contents   = $contents;

        return $self;
    }


    /**
     * 自身を配列化する
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'status'   => $this->statusCode,
            'message'  => $this->message,
            'contents' => $this->contents,
        ];
    }
}