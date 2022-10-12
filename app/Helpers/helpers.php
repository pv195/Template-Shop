<?php
if (!function_exists('activeAdminMenu')) {
    function activeAdminMenu($type)
    {
        return (request()->is("admin/$type/*") || request()->is("admin/$type")) ? 'active' : '';
    }
}
