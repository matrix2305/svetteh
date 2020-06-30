<?php


namespace AppCore\Interfaces;


interface IMessagesService
{
    public function findAllMessages();

    public function findOneMessage(int $id);

    public function addMessage(array $data);

    public function deleteMessage(int $id);
}