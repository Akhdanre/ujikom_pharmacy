<?php

namespace App\Helpers;

class NavigationHelper
{
    /**
     * Check if the current route matches the given pattern
     */
    public static function isActive($routePattern)
    {
        return request()->routeIs($routePattern);
    }

    /**
     * Get the appropriate CSS class for navigation items
     */
    public static function getNavClass($routePattern)
    {
        return self::isActive($routePattern) ? '' : 'collapsed';
    }

    /**
     * Get the appropriate CSS class for navigation items with active state
     */
    public static function getNavClassWithActive($routePattern)
    {
        return self::isActive($routePattern) ? 'active' : '';
    }
} 