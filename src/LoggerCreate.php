<?php

namespace Corbpie\KennyLoggings;

use PDO;

class LoggerCreate extends LoggerConfig
{
    public \pdo $db;

    public function __construct()
    {
        date_default_timezone_set('UTC');
        $this->db = $this->db_connect();
    }

    private function db_connect(): pdo
    {
        $db = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";
        $options = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
        return new PDO($db, self::DB_USER, self::DB_PASSWORD, $options);
    }

    public function doALog(int $result, string $task_name, string $message): bool
    {
        $pid = $this->selectProjectId();
        $tid = $this->selectTaskId($task_name);
        $insert = $this->db->prepare("INSERT INTO `logs` (`pid`, `lid`, `tid`, `message`, `date_time`) VALUES (?, ?, ?, ?, ?);");
        return $insert->execute([$pid, $result, $tid, $message, date('Y-m-d H:i:s')]);
    }

    protected function selectProjectId(): int
    {
        $select = $this->db->prepare("SELECT `pid` FROM `projects` WHERE `project_name` = ? LIMIT 1;");
        $select->execute([self::PROJECT]);
        $row = $select->fetch(PDO::FETCH_ASSOC);
        if (!empty($row)) {//Row found
            return $row['pid'];
        }//NO row found
        return $this->insertProject();
    }

    private function insertProject(): int
    {
        $insert = $this->db->prepare("INSERT INTO `projects` (`project_name`, `date_added`) VALUES (?, ?);");
        $insert->execute([self::PROJECT, date('Y-m-d H:i:s')]);
        return $this->db->lastInsertId();
    }

    protected function selectTaskId(string $task_name): int
    {
        $select = $this->db->prepare("SELECT `tid` FROM `tasks` WHERE `task` = ? LIMIT 1;");
        $select->execute([$task_name]);
        $row = $select->fetch(PDO::FETCH_ASSOC);
        if (!empty($row)) {
            return $row['tid'];
        }
        return $this->insertTask($task_name);
    }

    private function insertTask(string $task_name): int
    {
        $insert = $this->db->prepare("INSERT INTO `tasks` (`task`, `date_added`) VALUES (?, ?);");
        $insert->execute([$task_name, date('Y-m-d H:i:s')]);
        return $this->db->lastInsertId();
    }
}