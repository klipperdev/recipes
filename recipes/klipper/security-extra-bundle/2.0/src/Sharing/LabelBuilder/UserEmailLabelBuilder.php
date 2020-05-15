<?php

namespace App\Sharing\LabelBuilder;

use App\Entity\User;
use Klipper\Component\SecurityExtra\Sharing\SharingEntryLabelBuilderInterface;
use Klipper\Component\Uuid\Util\UuidUtil;
use Klipper\Component\Security\Model\SharingInterface;

/**
 * Automatically injected by the `klipper_security.sharing_entry_label_builder` tag and this tag
 * is automatically added to all classes defined in the `App\Sharing\LabelBuilder` directory
 * by a compiler pass.
 */
class UserEmailLabelBuilder implements SharingEntryLabelBuilderInterface
{
    public function supports(object $identity, SharingInterface $sharing): bool
    {
        return $identity instanceof User
            && null !== $identity->getEmail()
            && UuidUtil::isV4($identity->getUsername());
    }

    /**
     * @param User $identity
     */
    public function buildLabel(object $identity, SharingInterface $sharing): string
    {
        return $identity->getEmail();
    }
}
