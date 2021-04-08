<?php

declare(strict_types=1);

namespace Adlacruzes\Exceptions\Tests;

use Adlacruzes\Exceptions\BaseException;
use Exception;
use PHPUnit\Framework\TestCase;

class BaseExceptionTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testEmptyMessage(): void
    {
        $this->expectExceptionMessage('Something not found');

        throw new SomethingNotFoundException();
    }

    /**
     * @throws Exception
     */
    public function testEmptyMessageWithConsecutiveCapitalLetters(): void
    {
        $this->expectExceptionMessage('Consecutive capital letters');

        throw new ConsecutiveCAPITALLettersException();
    }

    /**
     * @throws Exception
     */
    public function testEmptyMessageWithValue(): void
    {
        $this->expectExceptionMessage('Something not found: 404');

        throw new SomethingNotFoundException('404');
    }

    /**
     * @throws Exception
     */
    public function testMessageWithEmptyString(): void
    {
        $expected = 'Something not found';

        try {
            throw new SomethingNotFoundException('');
        } catch (SomethingNotFoundException $e) {
            $actual = $e->getMessage();
        }

        self::assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @throws Exception
     */
    public function testMessageWithZeroAsString(): void
    {
        $expected = 'Something not found: 0';

        try {
            throw new SomethingNotFoundException('0');
        } catch (SomethingNotFoundException $e) {
            $actual = $e->getMessage();
        }

        self::assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @throws Exception
     */
    public function testMessageWithNegativeNumberAsString(): void
    {
        $expected = 'Something not found: -42';

        try {
            throw new SomethingNotFoundException((string) -42);
        } catch (SomethingNotFoundException $e) {
            $actual = $e->getMessage();
        }

        self::assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @throws Exception
     */
    public function testMessageWithMultiByteString(): void
    {
        $expected = 'Something not found: ч';
        try {
            throw new SomethingNotFoundException('ч');
        } catch (SomethingNotFoundException $e) {
            $actual = $e->getMessage();
        }

        self::assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @throws Exception
     */
    public function testMessageWithMultiBytesString(): void
    {
        $expected = 'Something not found: что-то';
        try {
            throw new SomethingNotFoundException('что-то');
        } catch (SomethingNotFoundException $e) {
            $actual = $e->getMessage();
        }

        self::assertEquals(
            $expected,
            $actual
        );
    }

    /**
     * @throws Exception
     */
    public function testMessageByDefault(): void
    {
        $this->expectExceptionMessage('This is an exception');

        $exception = new class() extends BaseException {
            /**
             * @var string
             */
            protected $message = 'This is an exception';
        };

        throw new $exception();
    }

    /**
     * @throws Exception
     */
    public function testMessageByDefaultWithValue(): void
    {
        $this->expectExceptionMessage('This is an exception: something');

        $exception = new class() extends BaseException {
            /**
             * @var string
             */
            protected $message = 'This is an exception';
        };

        throw new $exception('something');
    }

    /**
     * @throws Exception
     */
    public function testMessageByDefaultWithFinalDotAndValue(): void
    {
        $this->expectExceptionMessage('This is an exception: something');

        $exception = new class() extends BaseException {
            /**
             * @var string
             */
            protected $message = 'This is an exception.';
        };

        throw new $exception('something');
    }

    /**
     * @throws Exception
     */
    public function testMessageByDefaultWithFinalColonAndValue(): void
    {
        $this->expectExceptionMessage('This is an exception: something');

        $exception = new class() extends BaseException {
            /**
             * @var string
             */
            protected $message = 'This is an exception:';
        };

        throw new $exception('something');
    }
}
