<?php

namespace Fls\Macros\Macros\UploadedFile;

use App\Exceptions\DocumentUploadException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @mixin \Illuminate\Http\UploadedFile
 */
class SaveOnDisk
{
    /**
     * @return \Closure
     */
    public function __invoke()
    {
        return function (?string $disk = null, ?string $filename = null, bool $returnAsArray = true) {

            $disk = $disk ?? config('filesystems.default');

            $name = Str::uuid() . '-' . ($filename ?? $this->getClientOriginalName());

            $destination = Storage::disk($disk)
                ->putFileAs(today()->year, $this, $name);

            throw_unless(
                Storage::disk($disk)->exists($destination),
                new DocumentUploadException('Failed to upload document. Please try again - or reach to support', 500)
            );

            if (false === $returnAsArray) {
                return $destination;
            }

            return [
                'label' => $filename ?? $this->getClientOriginalName(),
                'storage' => $disk,
                'original_name' => $filename ?? $this->getClientOriginalName(),
                'file_name' => $filename ?? $this->getClientOriginalName(),
                'mime_type' => $this->getMimeType(),
                'size' => $this->getSize(),
                'uri' => $destination,
            ];
        };
    }
}
