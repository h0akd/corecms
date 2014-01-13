<?php

function dump_var($expression, $die = false) {
    echo "<PRE><CODE>" . var_export($expression, 1) . '</CODE></PRE>';
    if ($die) {
        die();
    }
}

function root_uri($path = "") {
    $type = Config::get("CoreCms::directions.type");
    $uri = Config::get("CoreCms::directions.uri");
    if ($type === "uri" || $type === "all") {
        return '/' . $uri . $path;
    } else {
        return "" . $path;
    }
}
