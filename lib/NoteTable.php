<?php

namespace Tolorric\Likemne;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\TextField;
use Bitrix\Main\Entity\BooleanField;
use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

class NoteTable extends DataManager
{
    public static function getTableName()
    {
        return 'tolorric_note';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => 'ID',
            ]),
            new StringField('TITLE', [
                'required' => true,
                'validation' => [__CLASS__, 'validateTitle'],
                'title' => 'Название',
            ]),
            new TextField('CONTENT', [
                'title' => 'Текст заметки',
            ]),
            new BooleanField('ACTIVE', [
                'values' => ['N', 'Y'],
                'default_value' => 'Y',
                'title' => 'Активность',
            ]),
            new DatetimeField('DATE_CREATE', [
                'default_value' => new \Bitrix\Main\Type\DateTime(),
                'title' => 'Дата создания',
            ]),
        ];
    }

    public static function validateTitle()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }
}