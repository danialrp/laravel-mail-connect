<?php
/**
 * Initial Version Created by Danial Panah
 * Email: me@danialrp.com - Web: danialrp.com
 * on 12/14/2022 AD
 */

namespace DanialPanah\MailConnect\Traits;

trait TransformerTrait
{
    public static function mapObjectToArray($data): array|string
    {
        if (is_object($data)) $data = get_object_vars($data);

        if (is_array($data))
            return array_map(__METHOD__, $data);
        else
            return $data;
    }
}