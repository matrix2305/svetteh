<?php


namespace AppCore\Interfaces;


use AppCore\Entities\Message;

interface IMessagesRepository
{
    public function getAllMessages();

    public function getOneMessage(int $id);

    public function insertMessage(Message $message);

    public function deleteMessage(Message $message);
}