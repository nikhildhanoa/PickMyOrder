<?php

namespace Nylas\Exceptions;

/**
 * ----------------------------------------------------------------------------------
 * Not Ready
 * ----------------------------------------------------------------------------------
 *
 * @author lanlin
 * @change 2021/09/22
 */
class NotReadyException extends NylasException
{
    protected $code = 202;

    protected $message = "The request was valid but the resource wasn't ready. Retry the request with exponential backoff";
}
