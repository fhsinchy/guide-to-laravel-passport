<?php

function isLoggedIn()
{
    return request()->session()->has('accessToken');
}
