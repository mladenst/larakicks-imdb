<?php

/**
 * A simple function that uses mtime to delete files older than a given age (in seconds)
 * Very handy to rotate backup or log files, for example...
 *
 * $dir String where the files are
 * $max_age Int in seconds
 * return String[] the list of deleted files
 */
function delete_older_than($dir, $max_age)
{
    $list = array();

    $limit = time() - $max_age;

    $dir = realpath($dir);

    if (!is_dir($dir)) {
        return;
    }

    $dh = opendir($dir);
    if ($dh === false) {
        return;
    }

    while (($file = readdir($dh)) !== false) {
        $file = $dir . '/' . $file;
        if (!is_file($file)) {
            continue;
        }

        if (filemtime($file) < $limit) {
            $list[] = $file;
            unlink($file);
        }
    }
    closedir($dh);
    return $list;
}

/**
 * Delete all backups older then 5 days
 */
function delete_old_backups()
{
    delete_older_than(storage_path('backups'), 3600*24*5);
}

function is_json(...$args)
{
    json_decode(...$args);
    return (json_last_error()===JSON_ERROR_NONE);
}

function is_int_val($value)
{
    return strval(intval($value)) == strval($value);
}

function is_float_val($value)
{
    return strval($value) == strval(floatval($value));
}
