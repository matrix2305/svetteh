<?php


namespace AppCore\Services;


use AppCore\DTO\MessageDTO;
use AppCore\Entities\Message;
use AppCore\Interfaces\ILog;
use AppCore\Interfaces\IMessagesRepository;
use AppCore\Interfaces\IMessagesService;
use Exception;

class MessagesService implements IMessagesService
{
    private IMessagesRepository $messageRepository;

    private ILog $log;

    public function __construct(IMessagesRepository $messageRepository, ILog $log)
    {
        $this->messageRepository = $messageRepository;
        $this->log = $log;
    }

    public function findAllMessages() : array
    {
        $messages =  $this->messageRepository->getAllMessages();
        return MessageDTO::fromCollection($messages);
    }

    public function findOneMessage(int $id) : MessageDTO
    {
        $message = $this->messageRepository->getOneMessage($id);
        return MessageDTO::fromEntity($message);
    }

    public function addMessage(array $data)
    {
        try {
            $message = new Message();
            $message->setName($data['name']);
            $message->setEmail($data['email']);
            $message->setMessage($data['message']);
            $this->messageRepository->insertMessage($message);
            dd($message);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function deleteMessage(int $id)
    {
        try {
            $message = $this->messageRepository->getOneMessage($id);
            $this->messageRepository->deleteMessage($message);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }
}