<?php

namespace Corbpie\KennyLoggings;

use PDO;

class LoggerView extends LoggerCreate
{
    public function selectLogTypes(): array
    {//Example call to view all log result types and their ids
        $select = $this->db->query("SELECT `lid`, `type` FROM `log_type`;");
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectProjects(): array
    {//Example call to view all projects and their ids
        $select = $this->db->query("SELECT `pid`, `project_name`, `date_added` FROM `projects`;");
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectTasks(): array
    {//Example call to view all tasks and their ids
        $select = $this->db->query("SELECT `tid`, `task`, `date_added` FROM `tasks`;");
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectAllRecentLogsForProject(): array
    {//Example call on viewing 50 most recent logs for all log result types
        $pid = $this->selectProjectId();
        $select = $this->db->prepare(
            "SELECT l.date_time, lt.type, t.task, l.message FROM logs as l
         INNER JOIN log_type lt on l.lid = lt.lid
         INNER JOIN tasks t on l.tid = t.tid WHERE l.pid = ? ORDER BY l.date_time DESC LIMIT 50;"
        );
        $select->execute([$pid]);
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectRecentLogsForProjectByLogType(int $log_type): array
    {//Example call on viewing 50 recent logs for log result type (e.g 5 = fails)
        $pid = $this->selectProjectId();
        $select = $this->db->prepare(
            "SELECT l.date_time, lt.type, t.task, l.message FROM logs as l
         INNER JOIN log_type lt on l.lid = lt.lid
         INNER JOIN tasks t on l.tid = t.tid WHERE l.pid = ? AND l.lid = ? ORDER BY l.date_time DESC LIMIT 50;"
        );
        $select->execute([$pid, $log_type]);
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectRecentLogsForProjectByTaskType(string $task): array
    {//Example call on viewing 50 recent logs for a log task
        $pid = $this->selectProjectId();
        $tid = $this->selectTaskId($task);
        $select = $this->db->prepare(
            "SELECT l.date_time, lt.type, t.task, l.message FROM logs as l
         INNER JOIN log_type lt on l.lid = lt.lid
         INNER JOIN tasks t on l.tid = t.tid WHERE l.pid = ? AND l.tid = ? ORDER BY l.date_time DESC LIMIT 50;"
        );
        $select->execute([$pid, $tid]);
        return $select->fetchAll(\PDO::FETCH_ASSOC);
    }
}