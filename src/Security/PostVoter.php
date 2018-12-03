<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 18:30
 */

declare(strict_types=1);

namespace App\Security;


use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;


class PostVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';
    private $security;

    /**
     * PostVoter constructor.
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        if (!$subject instanceof Post) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return true;
        }
        if (!$user instanceof User) {
            return false;
        }

        /** @var Post $post */
        $post = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($post, $user);
            case self::EDIT:
                return $this->canEdit($post, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    /**
     * @param Post $post
     * @param User $user
     * @return bool
     */
    private function canView(Post $post, User $user)
    {
        if ($this->canEdit($post, $user)) {
            return true;
        }
        return !$post->isPrivate();
    }

    /**
     * @param Post $post
     * @param User $user
     * @return bool
     */
    private function canEdit(Post $post, User $user)
    {
        return $user === $post->getOwner();
    }

}