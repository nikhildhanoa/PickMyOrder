<?php

namespace Nylas\Exceptions;

/**
 * ----------------------------------------------------------------------------------
 * Forbidden
 * ----------------------------------------------------------------------------------
 *
 * @author lanlin
 * @change 2021/09/22
 */
class ForbiddenException extends NylasException
{
    protected $code = 403;

    protected $message = 'Includes authentication errors, blocked developer applications, and cancelled accounts.';
}
