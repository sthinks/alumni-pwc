<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ClarificationText()
 * @method static static UserAgreement()
 */
final class TermConditionType extends Enum
{
    const ClarificationText = 'clarification_text';
    const UserAgreement = 'user_agreement';
}
