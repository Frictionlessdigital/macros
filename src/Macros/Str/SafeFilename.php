<?php

namespace Fls\Macros\Macros\Str;

/**
 * Sanitize the string to be a safe filename.
 *
 * @mixin \Illuminate\Support\Str
 *
 * @param string $filename
 * @param string $placeholder
 * @return string
 */
class SafeFilename
{
    public function __invoke()
    {
        return function ($filename, $placeholder = '') {
            $filename = preg_replace(
                '~
                [<>:"/\\\|?*]|           # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
                [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
                [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
                [#\[\]@!$&\'()+,;=]|     # URI reserved https://www.rfc-editor.org/rfc/rfc3986#section-2.2
                [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
                ~x',
                $placeholder, $filename);
            // avoids ".", ".." or ".hiddenFiles"
            $filename = ltrim($filename, '.-');
            // "file   name.zip" becomes "file-name.zip"
            $filename = preg_replace(['/ +/'], $placeholder, $filename);
            // ensure we do not exceed the length
            // maximize filename length to 255 bytes http://serverfault.com/a/9548/44086
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            // now, cut
            $filename = mb_strcut(pathinfo($filename, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($filename)) . ($ext ? '.' . $ext : '');
            // return
            return $filename;
        };
    }
}
