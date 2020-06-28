<?php
namespace Infrastructure\Repository;

use AppCore\Entities\Content;
use AppCore\Interfaces\IContentRepository;
use AppCore\Interfaces\ILog;
use Doctrine\ORM\EntityManagerInterface;
use MongoDB\Driver\Exception\ConnectionException;

class ContentRepository implements IContentRepository
{
    private EntityManagerInterface $em;

    private ILog $log;

    private $content;

    public function __construct(EntityManagerInterface $em, ILog $log)
    {
        $this->em = $em;
        $this->log = $log;
        $this->content = Content::class;
    }

    public function getContent() : Content
    {
        return $this->em->find($this->content, 1);
    }

    public function updateContent(Content $content)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->persist($content);
            $this->em->flush();
            $this->em->getConnection()->commit();
        }catch (ConnectionException $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }
}