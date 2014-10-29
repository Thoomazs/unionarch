<?php
/**
 * Created by PhpStorm.
 * User: Thomazs
 * Date: 22.10.14
 * Time: 23:45
 */

namespace App\Http\Repositories;

use Illuminate\Log\Writer as Log;
use Illuminate\Session\Store as Session;

class BaseRepository {

    protected $log;

    protected $session;

    function __construct(Log $log, Session $session)
    {
        $this->log = $log;

        $this->session = $session;
    }

    protected function _slugify($text, $strict = true) {
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d.]+~u', '-', $text);

        // trim
        $text = trim($text, '-');
        setlocale(LC_CTYPE, 'en_GB.utf8');
        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w.]+~', '', $text);
        if (empty($text)) {
            return 'empty_$';
        }
        if ($strict) {
            $text = str_replace(".", "_", $text);
        }
        return $text;
    }




}