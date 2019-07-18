<?php
namespace App\Exceptions;

use Illuminate\Http\Response;

class DefaultException extends \Exception
{
    private $context;

    public function __construct(
        string $message = 'default',
        array $context = [],
        int $code = Response::HTTP_BAD_REQUEST
    ) {
        parent::__construct($message, $code);
        $this->context = $context;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
