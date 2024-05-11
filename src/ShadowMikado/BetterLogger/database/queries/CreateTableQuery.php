<?php


namespace ShadowMikado\BetterLogger\database\queries;

use ShadowMikado\BetterLogger\database\query\SQLiteQuery;
use ShadowMikado\BetterLogger\logs\Log;
use SQLite3;

final class CreateTableQuery extends SQLiteQuery
{
    public function __construct(protected $log)
    {
    }

    public function onRun(SQLite3 $connection): void
    {
        $statement = $connection->prepare($this->getQuery());
        $statement->execute();

        $this->setResult(true);
        $statement->close();
    }

    public function getQuery(): string
    {
        /** @var Log $log */
        $log = igbinary_unserialize($this->log);
        return "CREATE TABLE IF NOT EXISTS " . $log->getName() . " (" . $this->formatString($log->getParameters()) . ")";
    }

    private function formatString(array $array)
    {
        return implode(", ", $this->formatArray($array));
    }

    private function formatArray(array $array): array
    {
        return array_map(function ($arg) {
            return strtolower($arg) . " TEXT";
        }, $array);
    }
}