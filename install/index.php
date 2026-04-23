<?php
// /local/modules/tolorric.likemne/install/index.php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

// Загружаем языковые файлы
Loc::loadMessages(__FILE__);

class tolorric_likemne extends CModule
{
    public $MODULE_ID = "tolorric.likemne";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    // Свойство для хранения ошибок установки
    public $errors = [];

    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("TOLORRIC_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("TOLORRIC_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = Loc::getMessage("TOLORRIC_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("TOLORRIC_PARTNER_URI");
    }

    public function DoInstall()
    {
        // Проверяем, не установлен ли модуль
        if ($this->isAlreadyInstalled()) {
            $this->errors[] = Loc::getMessage("TOLORRIC_MODULE_ALREADY_INSTALLED");
            return false;
        }
        
        // Регистрируем модуль в системе
        ModuleManager::registerModule($this->MODULE_ID);
        
        // Здесь в будущем будем копировать файлы или создавать таблицы БД
        
        return true;
    }

    public function DoUninstall()
    {
        // Снимаем регистрацию модуля
        ModuleManager::unRegisterModule($this->MODULE_ID);
        
        // Здесь в будущем будем удалять файлы или таблицы БД
        
        return true;
    }

    // Проверка, не установлен ли уже модуль
    private function isAlreadyInstalled(): bool
    {
        return ModuleManager::isModuleInstalled($this->MODULE_ID);
    }

}
