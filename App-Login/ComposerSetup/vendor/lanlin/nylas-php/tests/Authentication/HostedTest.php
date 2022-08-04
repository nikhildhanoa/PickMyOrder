<?php

namespace Tests\Authentication;

use Tests\AbsCase;

/**
 * ----------------------------------------------------------------------------------
 * Hosted Test
 * ----------------------------------------------------------------------------------
 *
 * @see https://developer.nylas.com/docs/api/#tag--Hosted-Authentication
 *
 * @author lanlin
 * @change 2022/01/27
 *
 * @internal
 */
class HostedTest extends AbsCase
{
    // ------------------------------------------------------------------------------

    public function testAuthenticateUser(): void
    {
        $params = [
            'state'         => 'testing',
            'scopes'        => 'email,contacts,calendar',
            'login_hint'    => $this->faker->email,
            'redirect_uri'  => $this->faker->url,
            'response_type' => 'code',
        ];

        $data = $this->client->Authentication->Hosted->authenticateUser($params);

        $this->assertIsString($data);
    }

    // ------------------------------------------------------------------------------

    public function testSendAuthorizationCode(): void
    {
        $code = $this->faker->postcode;

        $this->mockResponse([
            'provider'      => 'gmail',
            'token_type'    => 'bearer',
            'account_id'    => $this->faker->md5,
            'access_token'  => $this->faker->md5,
            'email_address' => $this->faker->email,
        ]);

        $data = $this->client->Authentication->Hosted->sendAuthorizationCode($code);

        $this->assertNotEmpty($data['access_token']);
    }

    // ------------------------------------------------------------------------------

    public function testRevokeAccessTokens(): void
    {
        $this->mockResponse(['success' => 'true']);

        $data = $this->client->Authentication->Hosted->revokeAccessTokens();

        $this->assertNotEmpty($data['success']);
    }

    // ------------------------------------------------------------------------------
}
