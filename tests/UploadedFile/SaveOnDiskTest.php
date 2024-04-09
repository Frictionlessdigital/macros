<?php

namespace Fls\Macros\Tests\UploadedFile;

use Fls\Macros\Macros\UploadedFile\Exceptions\UploadedFileException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Fls\Macros\Tests\TestCase;

class SaveOnDiskTest extends TestCase
{
    /** @return void */
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        Storage::fake('gcs');

        $this->app['config']->set([
            'filesystems.default' => 'local',
        ]);

        Str::createUuidsUsing(fn () => 'abc-123');

        Carbon::setTestNow('May 17, 2023 2:13 PM');
    }

    /** @test */
    public function it_will_store_uploaded_file_on_default_disk(): void
    {
        $file = UploadedFile::fake()->createWithContent('customer.csv', 'id;name;group\n9999;Customer1;');

        $result = $file->saveOnDisk();

        $this->assertEquals([
            'label' => 'customer.csv',
            'storage' => 'local',
            'original_name' => 'customer.csv',
            'file_name' => 'customer.csv',
            'mime_type' => 'text/csv',
            'size' => 30,
            'uri' => '2023/abc-123-customer.csv',
        ], $result);
    }

    /** @test */
    public function it_will_store_uploaded_file_on_specified_disk(): void
    {
        $file = UploadedFile::fake()->createWithContent('customer.csv', 'id;name;group\n9999;Customer1;');

        $result = $file->saveOnDisk('gcs');

        $this->assertEquals([
            'label' => 'customer.csv',
            'storage' => 'gcs',
            'original_name' => 'customer.csv',
            'file_name' => 'customer.csv',
            'mime_type' => 'text/csv',
            'size' => 30,
            'uri' => '2023/abc-123-customer.csv',
        ], $result);
    }

    /** @test */
    public function it_will_store_uploaded_file_witth_specified_file_name(): void
    {
        $file = UploadedFile::fake()->createWithContent('customer.csv', 'id;name;group\n9999;Customer1;');

        $result = $file->saveOnDisk('gcs', 'foo.baa');

        $this->assertEquals([
            'label' => 'foo.baa',
            'storage' => 'gcs',
            'original_name' => 'foo.baa',
            'file_name' => 'foo.baa',
            'mime_type' => 'text/csv',
            'size' => 30,
            'uri' => '2023/abc-123-foo.baa',
        ], $result);
    }

    /** @test */
    public function it_will_store_uploaded_file_and_return_destination(): void
    {
        $file = UploadedFile::fake()->createWithContent('customer.csv', 'id;name;group\n9999;Customer1;');

        $result = $file->saveOnDisk('gcs', null, false);

        $this->assertEquals('2023/abc-123-customer.csv', $result);
    }

    /** @test */
    public function it_will_generate_exception_if_file_not_stored(): void
    {
        $file = UploadedFile::fake()->createWithContent('customer.csv', 'id;name;group\n9999;Customer1;');

        Storage::shouldReceive('disk')
            ->with('local')
            ->andReturnSelf()
            ->shouldReceive('putFileAs')
            ->andReturn('2023/abc-123-customer.csv')
            ->shouldReceive('exists')
            ->with('2023/abc-123-customer.csv')
            ->andReturnFalse();

        $this->expectException(UploadedFileException::class);
        $this->expectExceptionMessage('Failed to upload document - customer.csv. Please try again - or reach to support');

        $file->saveOnDisk('local');
    }
}
