<?php

namespace Infrastructure\Authentication\DBAL\Type;

use Authentication\Value\EmailAddress;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;

final class EmailAddressType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return parent::convertToDatabaseValue(null, $platform);
        }

        if ($value instanceof EmailAddress) {
            return parent::convertToDatabaseValue($value->toString(), $platform);
        }

        throw new ConversionException('Could not convert value');
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $converted = parent::convertToPHPValue($value, $platform);

        if ($converted === null) {
            return $converted;
        }

        if (\is_string($converted)) {
            return EmailAddress::fromString($converted);
        }

        throw new ConversionException('Could not convert value');
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    public function getName()
    {
        return EmailAddress::class;
    }
}
