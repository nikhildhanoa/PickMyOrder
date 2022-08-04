<?php

namespace Nylas\Exceptions;

/**
 * ----------------------------------------------------------------------------------
 * Bad Request
 * ----------------------------------------------------------------------------------
 *
 * @author lanlin
 * @change 2021/09/22
 */
class BadRequestException extends NylasException
{
    protected $code = 400;

    protected $message = 'Malformed or missing a required parameter, or your email provider not support this.';
}
