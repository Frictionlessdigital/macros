<?php

namespace Fls\Macros\Tests\UploadedFile\Exceptions;

use Fls\Macros\Macros\UploadedFile\Exceptions\UploadedFileException;
use Fls\Macros\Tests\TestCase;

class UploadedFileExceptionTest extends TestCase
{
    /** @test */
    public function it_will_handle_mismatch_of_matrix_arguments_exception(): void
    {
        $stub = UploadedFileException::uploadFailed('test.pdf');

        $this->assertInstanceOf(UploadedFileException::class, $stub);

        $this->assertEquals(
            'Failed to upload document - test.pdf. Please try again - or reach to support',
            $stub->getMessage()
        );
    }
}
