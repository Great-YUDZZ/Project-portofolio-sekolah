<?php

namespace App\Services;

use Mews\Purifier\Facades\Purifier;

class HtmlSanitizer
{
    /**
     * Clean untrusted HTML coming from the rich text editor.
     */
    public static function clean(?string $dirtyHtml): string
    {
        if (blank($dirtyHtml)) {
            return '';
        }

        $config = [
            'HTML.Allowed' => 'p,h2,h3,h4,strong,em,u,s,ul,ol,li,blockquote,a[href|title|target],img[src|alt|width|height],br,hr,code,pre',
            'URI.AllowedSchemes' => [
                'http' => true,
                'https' => true,
                'mailto' => true,
            ],
            'URI.DisableExternalResources' => false,
            'HTML.Nofollow' => true,
            'HTML.TargetBlank' => true,
            'Attr.AllowedFrameTargets' => ['_blank'],
            'AutoFormat.RemoveEmpty' => true,
            'AutoFormat.AutoParagraph' => false,
        ];

        return Purifier::clean($dirtyHtml, $config);
    }
}
