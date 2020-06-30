<?php

namespace App\Listeners;

use AppCore\Interfaces\IMessagesService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendedMessageToDatabaseListener implements ShouldQueue
{
    private IMessagesService $messageService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(IMessagesService $messagesService)
    {
        $this->messageService = $messagesService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->messageService->addMessage($event->message);
    }
}
