<?php

namespace SocialiteProviders\OpenAuth;

use SocialiteProviders\Manager\SocialiteWasCalled;

class OpenAuthExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('OPENAUTH', __NAMESPACE__.'\Provider');
    }
}
