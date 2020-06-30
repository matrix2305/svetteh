<?php


namespace Infrastructure\Repository;


use AppCore\Entities\Message;
use AppCore\Interfaces\ILog;
use AppCore\Interfaces\IMessagesRepository;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManagerInterface;

class MessagesRepository implements IMessagesRepository
{
    private EntityManagerInterface $em;

    private ILog $log;

    private $message;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        $this->em = $em;
        $this->log =  $log;
        $this->message = Message::class;
    }

    public function getAllMessages()
    {
        return $this->em->getRepository($this->message)->findAll();
    }

    public function getOneMessage(int $id)
    {
        return $this->em->find($this->message, $id);
    }

    public function insertMessage(Message $message)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($message);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }

    public function deleteMessage(Message $message){
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->remove($message);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->em->getConnection()->rollBack();
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }
}