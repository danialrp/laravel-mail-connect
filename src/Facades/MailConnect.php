<?php
/**
 * Initial Version Created by Danial Panah
 * Email: me@danialrp.com - Web: danialrp.com
 * on 12/12/2022 AD
 */

namespace DanialPanah\MailConnect\Facades;

use Illuminate\Support\Facades\Facade;


class MailConnect extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mailconnect';
    }
}