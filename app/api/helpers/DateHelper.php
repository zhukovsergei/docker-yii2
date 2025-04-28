<?php

namespace api\helpers;

class DateHelper
{
    /**
     * Formats a Unix timestamp into RFC3339 format for API responses.
     *
     * @param int|null $timestamp The Unix timestamp to format.
     * @return string|null The formatted date string or null if the input timestamp is null/falsy.
     */
    public static function formatApi(?int $timestamp): ?string
    {
        return $timestamp ? date(DATE_RFC3339, $timestamp) : null;
    }
}