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
        $socialiteWasCalled->extendSocialite('openauth', __NAMESPACE__.'\Provider');
    }
}
