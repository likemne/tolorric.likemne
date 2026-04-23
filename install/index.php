public function DoInstall()
{
    if ($this->isAlreadyInstalled()) {
        $this->errors[] = Loc::getMessage("TOLORRIC_MODULE_ALREADY_INSTALLED");
        return false;
    }
    
    ModuleManager::registerModule($this->MODULE_ID);
    
    // Создаём таблицу в БД
    $this->installDB();
    
    return true;
}

public function installDB()
{
    $connection = \Bitrix\Main\Application::getConnection();
    if (!$connection->isTableExists(\Tolorric\Likemne\NoteTable::getTableName())) {
        \Tolorric\Likemne\NoteTable::getEntity()->createDbTable();
    }
}

public function uninstallDB()
{
    $connection = \Bitrix\Main\Application::getConnection();
    if ($connection->isTableExists(\Tolorric\Likemne\NoteTable::getTableName())) {
        $connection->dropTable(\Tolorric\Likemne\NoteTable::getTableName());
    }
}
