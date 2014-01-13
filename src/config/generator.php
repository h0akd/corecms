<?php

return array(
    "template_path" => dirname(__DIR__) . '/templates',
    "default_models_path" => app_path("models"),
    "default_controller_path" => app_path("controllers"),
    "mode_rule_alias" => array(
        "ip" => "ip",
        "email" => "email",
        "url" => "url",
        "phone" => "min:10|max:11"
    )
);
