<?php

function displayTime($value)
{
    return strlen($value) ? $value->toTimeString() : '';
}