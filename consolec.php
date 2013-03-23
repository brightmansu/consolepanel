<?php

#consolepanel response file by Expantano
require_once('include/bittorrent.php');
require_once('console/functions.php');
require_once('console/config.php');

header("Content-type:text/html;charset=windows-1251");

// Устанавливаем соединение с базой данных
dbconn();

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

    $command = trim(iconv('utf-8', 'windows-1251', $_POST['command']));
    if (empty($command)) {
        cmd('bash: Empty command');
    }
    $exploded_command = explode(" ", $command);
    $numcm = count($commands);
    $numcl = count($class);
    $numfn = count($functions);
    if ($numcm != $numcl) {
        cmd('PHP ERROR: Number of commands don\'t match with number of classes. (see $commands, $class)');
    }
    if ($numcm != $numfn) {
        cmd('PHP ERROR: Number of commands don\'t match with number of functions. (see $commands, $functions)');
    }
    $i = 0;
    foreach ($commands as $key => $value) 
    {
        $i++;
        if ($i == $numcm && substr($command, 0, strlen($commands[$key])) != $commands[$key]) 
        {
            $com = explode(" ", $command);
            $com = htmlspecialchars($com[0]);
            cmd('bash: Command "' . $com . '" was not found');
        } else {
            if (substr($command, 0, strlen($commands[$key])) == $commands[$key] && strlen($exploded_command[0]) == strlen($commands[$key])) {
                checkpermission($key);
                if (function_exists($functions[$key])) {
                    $functions[$key]($command);
                } else {
                    cmd("PHP ERROR: function " . htmlspecialchars($functions[$key]) . " doesn't exist. Please, contact SysOp");
                }
            }
        }
    }
}
#END 
?>
