<?php
/**
 * Initial Version Created by Danial Panah
 * Email: me@danialrp.com - Web: danialrp.com
 * on 12/12/2022 AD
 */

namespace DanialPanah\MailConnect;

class MailConnect
{
    private string $protocol;

    private string $directory;

    private string $criteria;

    public function openMailInbox(): array
    {
        $mailClass = 'DanialPanah\MailConnect\Mail\\' . $this->protocol . 'Service';
        $mailService = new $mailClass;

        return $mailService->openMailbox($this->directory, $this->criteria);
    }

    public function protocol(string $protocol): MailConnect
    {
        $this->protocol = ucfirst($protocol);
        return $this;
    }

    public function directory(string $directory): MailConnect
    {
        $this->directory = strtoupper($directory);
        return $this;
    }

    public function criteria(string $criteria): MailConnect
    {
        $this->criteria = strtoupper($criteria);
        return $this;
    }
}