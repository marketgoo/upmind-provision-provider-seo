<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\Seo\Providers\Marketgoo\ResponseHandlers;

use Upmind\ProvisionProviders\Seo\Providers\Marketgoo\Exceptions\CannotParseResponse;
use Upmind\ProvisionProviders\Seo\Providers\Marketgoo\Exceptions\OperationFailed;

/**
 * Handler to parse the 'Create account' result from from a PSR-7 response body.
 */
class CreateAccountResponseHandler extends ResponseHandler
{
    /**
     * Handler to obtain account identifier.
     *
     * @throws OperationFailed If 'Create account' failed
     */
    public function getAccountIdentifier(string $name = 'operation'): string
    {
        try {
            $this->assertSuccess($name);

            $this->parseJson();
            $data = $this->getData('data');

            if (!isset($data['id'])) {
                throw new CannotParseResponse('Unable to parse obtain account identifier');
            }

            return $data['id'];
        } catch (CannotParseResponse $e) {
            throw (new OperationFailed($e->getMessage(), 0, $e))
                ->withData([
                    'http_code' => $this->response->getStatusCode(),
                    'content_type' => $this->response->getHeaderLine('Content-Type'),
                    'body' => $this->getBody(),
                ]);
        }
    }
}
