Utilise [LibSQL](https://github.com/cooldogepm/libSQL) et [discord-webhook-php](https://github.com/atakde/discord-webhook-php)

Exemple d'utilisation:


`MessageLog.php`:
```php

use ShadowMikado\BetterLogger\logs\Log;
use ShadowMikado\BetterLogger\logs\LogIds;

class MessageLog extends Log
{

    public function getName(): string
    {
        return LogIds::MESSAGE_LOG;
    }

    public function getParameters(): array
    {
        return ["USERNAME", "MESSAGE", "DATE"];
    }

    public function isEmbeded(): bool
    {
        return false;
    }

    public function getDiscordMessage(): string
    {
        return "[{DATE}] {USERNAME} : {MESSAGE}";
    }

    public function getToken(): string
    {
        return "https://discord.com/api/webhooks/1238908871154733227/5LmwMMas9UnjaiV_8AM4f3Q3We58qY9GEC74LGzi7B6FfHYuMOReBtafEH-PFlZQFTaa";
    }
}

```
Il est préférable d'utiliser une `const` pour le nom

Dans le `PluginBase`:

```php
use ShadowMikado\BetterLogger\BetterLogger;

BetterLogger::getInstance()->register(new MessageLog())
```

Dans un `listener`:

```php
use ShadowMikado\BetterLogger\BetterLogger;
use ShadowMikado\BetterLogger\logs\Logger;
use ShadowMikado\BetterLogger\logs\LogIds;
use ShadowMikado\BetterLogger\utils\Utils;


public function onPlayerChat(PlayerChatEvent $event): void {
Logger::log(BetterLogger::getInstance()->get(LogIds::MESSAGE_LOG), [$event->getPlayer()->getName(), $event->getMessage(), Utils::getDate()]);
}

```

Veillez à bien mettre les arguments dans l'ordre définit dans `MessageLog.php`

Lors du premier démarage avec le plugin, toutes les tables necessaires vont être crées dans la base de donnée **SQLite** située dans `/plugin_data/BetterLogger/database.db`

Par exemple pour `MessageLog` dans la base de donnée:
| username     | message      | date                |
|--------------|--------------|---------------------|
| ShadowMikado | Test message | 11-05-2024 23:22:07 |

Non je n'ai pas leak les webhooks, c'est faux :)
