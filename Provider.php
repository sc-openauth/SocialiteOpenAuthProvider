<?php

namespace SocialiteProviders\OpenAuth;

use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'OPENAUTH';

    /**
     * @inheritdoc
     */
    protected $scopes = [
        'email',
    ];

    /**
     * @inheritdoc
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            'https://openauth.dev/oauth2-authorize/',
            $state
        );
    }

    /**
     * @inheritdoc
     */
    protected function getTokenUrl()
    {
        return 'https://openauth.dev/oauth2-token/';
    }

    /**
     * @inheritdoc
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            'https://openauth.dev/open-id-user-information/',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                ],
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritdoc
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'email'    => $user['email'],
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
