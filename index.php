<?php
use YAPF\Entry;

include __DIR__ . DIRECTORY_SEPARATOR .
    'vendor' . DIRECTORY_SEPARATOR .
    'autoload.php';

/**
 * Yet Another PHP Framework
 * @author Savaş KOÇ <savaskoc11@gmail.com>
 * @version 0.2alpha
 */

defined('YAPF_APP') or define('YAPF_APP', 'Application');
defined('YAPF_CORE') or define('YAPF_CORE', __DIR__);

new Entry;