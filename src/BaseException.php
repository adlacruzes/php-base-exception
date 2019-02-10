<?php

declare(strict_types=1);

namespace Adlacruzes\Exceptions;

abstract class BaseException extends \Exception
{
    public function __construct(string $value = '', int $code = 0, \Throwable $previous = null)
    {
        $message = $this->getMessage();

        if (empty($message)) {
            $message = $this->generateMessage($this->getClassName());
        }

        if (!empty($value)) {
            $message = $this->generateMessageValue($message, $value);
        }

        parent::__construct($message, $code, $previous);
    }

    private function getClassName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    private function generateMessage(string $message): string
    {
        $generated = str_replace('Exception', '', $message);
        $generated = preg_replace_callback(
            '/[A-Z]/',
            function ($match) {
                return ' ' . strtolower($match[0]);
            },
            $generated
        );

        return ucfirst(trim($generated));
    }

    private function generateMessageValue(string $message, string $value): string
    {
        $generated = $message;
        if (!$this->isLastCharacterAllowed($generated)) {
            $generated = substr($generated, 0, -1);
        }
        $generated .= ": $value";

        return $generated;
    }

    private function isLastCharacterAllowed(string $message)
    {
        return !in_array(
            substr($message, -1),
            ['.', ':'],
            true
        );
    }
}
