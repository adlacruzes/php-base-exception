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
        $words = preg_split(
            '/(?<=[a-z])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])/',
            str_replace('Exception', '', $message)
        );

        $generated = '';
        foreach ($words as $word) {
            $generated .= ' ' . strtolower($word);
        }

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
