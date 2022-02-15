<?php

namespace Nitm\ConnectedAccounts\Events;

class AnnouncementCreated
{
    /**
     * The announcement instance.
     *
     * @var \Nitm\ConnectedAccounts\Models\Announcement
     */
    public $announcement;

    /**
     * Create a new announcement instance.
     *
     * @param  \Nitm\ConnectedAccounts\Models\Announcement $announcement
     * @return void
     */
    public function __construct($announcement)
    {
        $this->announcement = $announcement;
    }
}