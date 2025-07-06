<?php

namespace App\Listener;

use Symfony\Component\HttpFoundation\Request;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;

class JWTCookieExtractor implements TokenExtractorInterface
{
    public function extract(Request $request): ?string
    {
        return $request->cookies->get('BEARER');
    }
}