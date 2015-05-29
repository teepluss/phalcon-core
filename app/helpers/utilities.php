<?php

use Symfony\Component\VarDumper;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
function dump($var)
{
    $cloner = new VarDumper;
    $cloner->setMaxItems(-1);
    $cloner->setMaxString(-1);

    $dumper = 'cli' === PHP_SAPI ? new VarDumper\Dumper\CliDumper() : new VarDumper\Dumper\HtmlDumper();

    foreach (func_get_args() as $var)
    {
        $dumper->dump($cloner->cloneVar($var));
    }
}