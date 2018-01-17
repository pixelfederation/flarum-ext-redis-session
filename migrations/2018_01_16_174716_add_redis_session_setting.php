<?php
declare(strict_types=1);

/**
 * @author    mskorupa
 * @copyright Pixel federation
 * @license:  Internal use only
 */

use Flarum\Database\Migration;
use PixelFederation\RedisSession\Settings\Settings;

return Migration::addSettings([
    Settings::HOST => '127.0.0.1',
    Settings::PORT => '6379',
    Settings::DB => '0',
    Settings::PASSWORD => null,
    Settings::TTS => '3600',
    Settings::LOCKING => '1',
    Settings::PREFIX => 'session:',
    Settings::SPIN_LOCK_WAIT => '150000',
    Settings::CONNECTION_PARAMETERS => null,
    Settings::CLIENT_OPTIONS => null,
    Settings::HANDLER_OPTIONS => null,
    Settings::STORAGE_OPTIONS => null,
]);
