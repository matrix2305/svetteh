<?php
namespace AppCore\Services;


use AppCore\DTO\ContentDTO;
use AppCore\Interfaces\IContentRepository;
use AppCore\Interfaces\IContentService;
use AppCore\Interfaces\ILog;
use Exception;

class ContentService implements IContentService
{
    private IContentRepository $contentRepository;

    private ILog $log;

    public function __construct(IContentRepository $contentRepository, ILog $log)
    {
        $this->contentRepository = $contentRepository;
        $this->log = $log;
    }

    public function findContent() : ContentDTO
    {
        $content = $this->contentRepository->getContent();
        return ContentDTO::fromEntity($content);
    }

    public function updateContent(array $data)
    {
        try {
            $content = $this->contentRepository->getContent();
            $content->setName($data['name']);
            $content->setText($data['text']);
            $content->setEmail($data['email']);
            $content->setAdresss($data['adress']);
            $content->setPhone($data['phone']);
            $content->setInstagram($data['instagram']);
            $content->setFacebook($data['facebook']);
            $this->contentRepository->updateContent($content);
        }catch (Exception $exception){
            $this->log->AddLog($exception->getMessage());
            return $exception->getMessage();
        }
    }
}