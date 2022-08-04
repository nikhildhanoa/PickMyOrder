<?php

namespace Nylas;

use Nylas\Utilities\Options;
use Nylas\Exceptions\NylasException;

/**
 * ----------------------------------------------------------------------------------
 * Nylas Client
 * ----------------------------------------------------------------------------------
 *
 * @property Authentication\Abs Authentication
 * @property Calendars\Abs      Calendars
 * @property Contacts\Abs       Contacts
 * @property Deltas\Abs         Deltas
 * @property Drafts\Abs         Drafts
 * @property Events\Abs         Events
 * @property Files\Abs          Files
 * @property Folders\Abs        Folders
 * @property JobStatuses\Abs    JobStatuses
 * @property Labels\Abs         Labels
 * @property Management\Abs     Management
 * @property Messages\Abs       Messages
 * @property Neural\Abs         Neural
 * @property Outbox\Abs         Outbox
 * @property Rooms\Abs          Rooms
 * @property Threads\Abs        Threads
 * @property Webhooks\Abs       Webhooks
 *
 * @author lanlin
 * @change 2022/01/27
 */
class Client
{
    // ------------------------------------------------------------------------------

    /**
     * @var Options
     */
    public Options $options;

    /**
     * @var array
     */
    private array $objects = [];

    // ------------------------------------------------------------------------------

    /**
     * Client constructor.
     *
     * @param array $options
     *                       [
     *                       'debug'            => bool,
     *                       'region'           => 'us',
     *                       'log_file'         => 'log file path',
     *                       'client_id'        => 'required',
     *                       'client_secret'    => 'required',
     *                       'access_token'     => '',
     *                       ]
     */
    public function __construct(array $options)
    {
        $this->options = new Options($options);
    }

    // ------------------------------------------------------------------------------

    /**
     * call nylas apis with __get
     *
     * @param string $name
     *
     * @return object
     */
    public function __get(string $name): object
    {
        return $this->callSubClass($name);
    }

    // ------------------------------------------------------------------------------

    /**
     * call sub class
     *
     * @param string $name
     *
     * @return object
     */
    private function callSubClass(string $name): object
    {
        if (!empty($this->objects[$name]))
        {
            return $this->objects[$name];
        }

        $apiClass = __NAMESPACE__.'\\'.\ucfirst($name).'\\Abs';

        // check class exists
        if (!\class_exists($apiClass))
        {
            throw new NylasException(null, "class {$apiClass} not found!");
        }

        return $this->objects[$name] = new $apiClass($this->options);
    }

    // ------------------------------------------------------------------------------
}
