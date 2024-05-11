<?php

namespace ShadowMikado\BetterLogger;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use ShadowMikado\BetterLogger\database\ConnectionPool;
use ShadowMikado\BetterLogger\database\queries\CreateTableQuery;
use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\types\BanLog;
use ShadowMikado\BetterLogger\logs\types\ClickLog;
use ShadowMikado\BetterLogger\logs\types\CommandLog;
use ShadowMikado\BetterLogger\logs\types\ConnectionLog;
use ShadowMikado\BetterLogger\logs\types\DeathLog;
use ShadowMikado\BetterLogger\logs\types\FreezeLog;
use ShadowMikado\BetterLogger\logs\types\ItemLog;
use ShadowMikado\BetterLogger\logs\types\KickLog;
use ShadowMikado\BetterLogger\logs\types\MessageLog;
use ShadowMikado\BetterLogger\logs\types\MuteLog;

class BetterLogger extends PluginBase
{
    use SingletonTrait;

    /**
     * @var Log[]
     */
    public array $logs;

    /**
     * @var ConnectionPool
     */
    private ConnectionPool $connectionPool;

    /**
     * @param string $name
     * @return Log
     */
    public function get(string $name): Log
    {
        if (!isset($this->logs[$name])) {
            throw new \InvalidArgumentException("Log with name $name is not registered");
        } else {
            return $this->logs[$name];
        }
    }

    /**
     * @return ConnectionPool
     */
    public function getConnectionPool(): ConnectionPool
    {
        return $this->connectionPool;
    }

    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {
        $this->connectionPool = new ConnectionPool($this, [
            "provider" => "sqlite",
            "threads" => 4,
            "sqlite" => [
                "path" => "database.db"
            ]
        ]);
        $this->register(new BanLog());
        $this->register(new ClickLog());
        $this->register(new CommandLog());
        $this->register(new ConnectionLog());
        $this->register(new DeathLog());
        $this->register(new FreezeLog());
        $this->register(new ItemLog());
        $this->register(new KickLog());
        $this->register(new MessageLog());
        $this->register(new MuteLog());

        foreach ($this->getAll() as $log) {
            $query = new CreateTableQuery(igbinary_serialize($log));
            $this->connectionPool->submit($query);
        }
    }

    /**
     * @param Log $log
     * @return void
     */
    public function register(Log $log): void
    {
        $name = $log->getName();

        if (isset($this->logs[$name])) {
            throw new \InvalidArgumentException("Log with name $name is already registered");
        }
        $this->logs[$name] = $log;
    }

    /**
     * @return Log[]
     */
    public function getAll(): array
    {
        return $this->logs;
    }

    protected function onDisable(): void
    {
        parent::onDisable();
    }


}