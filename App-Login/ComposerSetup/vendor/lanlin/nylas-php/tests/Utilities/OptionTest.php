<?php

namespace Tests\Utilities;

use Nylas\Utilities\Options;
use PHPUnit\Framework\TestCase;
use Nylas\Exceptions\NylasException;

/**
 * @change 2022/01/27
 *
 * @internal
 */
class OptionTest extends TestCase
{
    // ------------------------------------------------------------------------------

    public function testMinimalRequirementOption(): void
    {
        $optionsData = [
            'client_id'     => \uniqid('', true),
            'client_secret' => \uniqid('', true),
        ];

        $options = new Options($optionsData);

        $optionsResult = [
            'client_id'     => $options->getClientId(),
            'client_secret' => $options->getClientSecret(),
        ];

        $this->assertSame($optionsData, $optionsResult);
    }

    // ------------------------------------------------------------------------------

    public function testMissingRequirementOption(): void
    {
        $optionsData = ['client_id' => \uniqid('', true)];

        $this->expectException(NylasException::class);

        new Options($optionsData);
    }

    // ------------------------------------------------------------------------------

    public function testOptions(): void
    {
        $optionsData = [
            'debug'         => true,
            'log_file'      => 'foo',
            'client_id'     => \uniqid('', true),
            'client_secret' => \uniqid('', true),
        ];

        $options = new Options($optionsData);

        $data = $options->getAllOptions();

        $this->assertArrayHasKey('log_file', $data);
    }

    // ------------------------------------------------------------------------------
}
