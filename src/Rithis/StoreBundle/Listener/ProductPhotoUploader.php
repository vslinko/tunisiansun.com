<?php

namespace Rithis\StoreBundle\Listener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManager;
use Gaufrette\Filesystem;
use Rithis\StoreBundle\Entity\Product;

class ProductPhotoUploader
{
    private $fs;

    public function __construct(Filesystem $fs)
    {
        $this->fs = $fs;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->event($args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->event($args);
    }

    private function event(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Product && $entity->getPhoto() instanceof UploadedFile) {
            $this->uploadProductPhoto($entity, $entity->getPhoto(), $entityManager);
        }
    }

    private function uploadProductPhoto(Product $product, UploadedFile $photo, EntityManager $em)
    {
        $key = $product->getId() . '.' . $photo->guessExtension();

        $this->fs->write($key, file_get_contents($photo->getPathname()), true);

        $product->setPhoto($key);
        $em->flush();
    }
}
