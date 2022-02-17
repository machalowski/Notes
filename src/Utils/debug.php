<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

function dump($data)
{
    echo '<br><div style="
            padding: 0 10px;
            margin-bottom: 10px;
            display: inline-block;
            border: 1px solid gray;
            background: Aqua;
        ">';

    echo '<pre>';
        print_r($data);
    echo '</pre>

    </div>
    <br>';
}
