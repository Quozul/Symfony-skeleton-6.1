<?php

namespace App\Security;

use App\Entity\Statistics;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter {
    const VIEW = 'view';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if ($attribute != self::VIEW) {
            return false;
        }

        if (!$subject instanceof Statistics) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Statistics $statistic */
        $statistic = $subject;

        // If user is admin or is owner
        return in_array('ROLE_ADMIN', $token->getRoleNames()) || $statistic->getOwner() === $token->getUser();
    }
}