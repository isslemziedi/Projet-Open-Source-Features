<?php

namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;

class EntitySubscriber implements EventSubscriber
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::postPersist,
            Events::postRemove,
            // Events::postUpdate, // Uncomment if needed
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity) {
            return;
        }

        if ($entity instanceof User) {
            $entity->setLocale('fr_FR');
            
            /* Uncomment and modify as needed for auditing
            $user = $this->security->getUser();
            if (!$entity->getCreatedAt()) {
                $entity->setCreatedBy($user);
                $entity->setCreatedAt(new \DateTime());
            }
            $entity->setEditedBy($user);
            $entity->setEditedAt(new \DateTime());
            */
        }
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->logActivity('persist', $args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->logActivity('remove', $args);
    }

    /* Uncomment if needed
    public function postUpdate(PreUpdateEventArgs $event): void
    {
        $this->logActivity('postUpdate', $args);
    }
    */

    private function logActivity(string $action, LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof User) {
            return;
        }

        // Log activity based on $action and $entity information
    }
}
