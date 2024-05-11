<?php

namespace ShadowMikado\BetterLogger\database\queries;

use ShadowMikado\BetterLogger\database\query\SQLiteQuery;
use ShadowMikado\BetterLogger\logs\Log;
use SQLite3;

final class LogQuery extends SQLiteQuery
{


    public function __construct(protected $log, protected $args)
    {
    }

    public function onRun(SQLite3 $connection): void
    {

        /** @var Log $log */
        $log = igbinary_unserialize($this->log);

        /** @var array $args */
        $args = igbinary_unserialize($this->args);

        $statement = $connection->prepare($this->getQuery());

        foreach ($this->formatArrayEntry($log->getParameters()) as $index => $column) {
            $statement->bindValue($column, $args[$index]);
        }
        //     $statement->bindValue(":date", date("d-m-Y H:i:s"));

        $statement->execute();
        $this->setResult($connection->changes() > 0);
        $statement->close();
    }

    public function getQuery(): string
    {
        /** @var Log $log */
        $log = igbinary_unserialize($this->log);
        return "INSERT INTO " . $log->getName() . " (" . $this->formatTextColumn($log->getParameters()) . ") VALUES (" . $this->formatTextEntry($log->getParameters()) . ")";
    }

    private function formatTextColumn(array $columns): string
    {
        return implode(", ", $this->formatArrayColumn($columns));
    }

    private function formatArrayColumn(array $columns): array
    {
        return array_map(function ($entry) {
            return strtolower($entry);
        }, $columns);
    }

    private function formatTextEntry(array $entries): string
    {
        return implode(", ", $this->formatArrayEntry($entries));
    }

    private function formatArrayEntry(array $entries): array
    {
        return array_map(function ($entry) {
            return ":" . strtolower($entry);
        }, $entries);
    }
}