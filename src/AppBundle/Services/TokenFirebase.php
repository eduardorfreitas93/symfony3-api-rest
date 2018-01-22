<?php

namespace AppBundle\Services;

use \Firebase\JWT\JWT;

/**
 * Class responsável por gerar o token no firebase
 *
 * Class CreateTokenFirebase
 * @package AppBundle\Services
 */
class TokenFirebase extends AbstractService
{
    /**
     * Gera token firebase
     *
     * @param $uid
     * @return array
     */
    public function createToken($uid)
    {
        $key = file_get_contents($this->container->getParameter('jwt_firebase_private_key'));
        $serviceAccount = $this->container->getParameter('jwt_firebase_account_key');

        $token = array(
            "iss" => $serviceAccount,
            "sub" => $serviceAccount,
            "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
            "iat" => time(),
            "exp" => time() + (60 * 60),  // Maximum expiration time is one hour
            "uid" => $uid,
        );

        $jwt = JWT::encode($token, $key, "RS256");
        return array('tokenFirebase' => $jwt);
    }
}