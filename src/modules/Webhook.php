<?php

namespace Cpay\Api\Modules;

use Cpay\Api\Modules\Utils\CryptoJsAES;
use DateTime;
use Exception;
use Lcobucci\JWT\Encoding\CannotDecodeContent;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\UnsupportedHeaderFound;

final class Webhook
{
    public static function handleWebhook(string $header, array $data)
    {
        $position = strrpos($header, 'Bearer ');

        $token = null;
        if ($position !== false) {
            $header = substr($header, $position + 7);
            $token = str_contains($header, ',') ? strstr($header, ',', true) : $header;
        }

        if (!$token) {
            return json_encode(['status' => 'ERROR', 'message' => 'No token auth sent']);
        }

        $parser = new Parser(new JoseEncoder());

        $wallet_id = null;
        $salt = null;
        $exp = null;
        try {
            $token = $parser->parse($token);
            $claims = $token->claims();
            $wallet_id = $claims->get('id');
            $salt = $claims->get('salt');
            $exp = $claims->get('exp');
        } catch (CannotDecodeContent | InvalidTokenStructure | UnsupportedHeaderFound $e) {
            throw new Exception('Token is not parsed');
        }

        if (!$wallet_id || !$salt || !$exp) {
            throw new Exception('Token is not valid');
        }
        if ($exp < new DateTime()) {
            throw new Exception('Token is expired');
        }

        if (!isset($data['data'])) {
            throw new Exception('Data not found');
        }

        try {
            $finalSalt = CryptoJsAES::cryptoJs_aes_decrypt($salt, $wallet_id);
            $body = CryptoJsAES::cryptoJs_aes_decrypt($data['data'], $finalSalt);

            return json_decode($body, true);
        } catch (Exception $err) {
            throw $err;
        }
    }
}
