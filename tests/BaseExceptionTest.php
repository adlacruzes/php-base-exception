<?php

declare(strict_types=1);

namespace Adlacruzes\Exceptions\Tests;

use Adlacruzes\Exceptions\BaseException;
use PHPUnit\Framework\TestCase;

class BaseExceptionTest extends TestCase
{
    public function testEmptyMessage()
    {
        $this->expectExceptionMessage('Something not found');

        throw new SomethingNotFoundException();
    }

    public function testEmptyMessageWithValue()
    {
        $this->expectExceptionMessage('Something not found: 404');

        throw new SomethingNotFoundException('404');
    }

    public function testMessageWithEmptyString()
    {
        $expected = 'Something not found';

        try {
            throw new SomethingNotFoundException('');
        } catch (SomethingNotFoundException $e) {
            $actual = $e->getMessage();
        }

        $this->assertEquals(
            $expected,
            $actual
        );
    }

    public function testMessageByDefault()
    {
        $this->expectExceptionMessage('This is an exception');

        $exception = new class() extends BaseException {
            protected $message = 'This is an exception';
        };

        throw new $exception();
    }

    public function testMessageByDefaultWithValue()
    {
        $this->expectExceptionMessage('This is an exception: something');

        $exception = new class() extends BaseException {
            protected $message = 'This is an exception';
        };

        throw new $exception('something');
    }

    public function testMessageByDefaultWithFinalDotAndValue()
    {
        $this->expectExceptionMessage('This is an exception: something');

        $exception = new class() extends BaseException {
            protected $message = 'This is an exception.';
        };

        throw new $exception('something');
    }

    public function testMessageByDefaultWithFinalColonAndValue()
    {
        $this->expectExceptionMessage('This is an exception: something');

        $exception = new class() extends BaseException {
            protected $message = 'This is an exception:';
        };

        throw new $exception('something');
    }
}
