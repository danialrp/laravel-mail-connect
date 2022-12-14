<?php

/**
 * Initial Version Created by Danial Panah
 * Email: me@danialrp.com - Web: danialrp.com
 * on 12/13/2022 AD
 */

namespace DanialPanah\MailConnect\Mail;

use DanialPanah\MailConnect\Exceptions\ImapException;
use DanialPanah\MailConnect\Traits\TransformerTrait;
use Exception;


final class ImapService
{
    use TransformerTrait;

    private static string $baseUrl;

    private static string $username;

    private static string $password;


    public function __construct()
    {
        static::$baseUrl = config('mailconnect.email_url') ??
            throw new ImapException('Mail URL not set.');

        static::$username = config('mailconnect.email_username') ??
            throw new ImapException('Mail Username not set.');

        static::$password = config('mailconnect.email_password') ??
            throw new ImapException('Mail Password not set.');
    }

    public function openMailbox(string $directory, string $criteria = 'ALL'): array
    {
        $mailbox = static::$baseUrl . strtoupper($directory);

        try {
            $inbox = imap_open($mailbox, static::$username, static::$password);
        } catch (Exception $exception) {
            throw $exception;
        }

        $mailIndexArray = imap_search($inbox, $criteria);

        if (!is_iterable($mailIndexArray))
            throw new ImapException('Invalid criteria or no emails in this criteria available.');

        rsort($mailIndexArray);

        $emails = [];
        foreach ($mailIndexArray as $key => $mailIndex) {
            $emailBody = imap_fetchbody($inbox, $mailIndex, 1);
            $header = imap_headerinfo($inbox, $mailIndex);
            $headerInfo = $this->mapObjectToArray($header);

            $emails[] = [
                'message_number' => $mailIndex,
                'header' => $headerInfo,
                'body' => quoted_printable_decode($emailBody),
            ];
        }

        return $emails;
    }
}