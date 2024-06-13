<?php
declare(strict_types = 1);

namespace wsTest;

use Tracy\Debugger;

class Error
{

    const LOG = 'LOG';
    const INFO = 'INFO';
    const WARN = 'WARN';
    const ERROR = 'ERROR';
    const DUMP = 'DUMP';
    const TRACE = 'TRACE';

    public static function init()
    {
            Debugger::enable(Debugger::DEVELOPMENT);
            Debugger::$strictMode = true; // display all errors
            Debugger::$dumpTheme = 'dark';
            Debugger::$showLocation = true; // Shows all additional location information
            Debugger::$logSeverity = E_NOTICE | E_WARNING;
            Debugger::$showBar = true;
            //Debugger::$editor = 'eclipse+command://-name Eclipse --launcher.openFile %file:%line';
    }
    /**
     * @param mixed $data - данные для вывода в плавающую панель 
     */
    public static function pdump($data, $title = NULL) {
            bdump($data, $title);
    }

}