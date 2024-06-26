<?php

/**
 *  Copyright (c) 2021-2023 cooldogedev
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 */

declare(strict_types=1);

namespace ShadowMikado\BetterLogger\database\thread;

use SQLite3;

final class SQLiteThread extends SQLThread
{
    protected static ?SQLite3 $connection = null;

    public function __construct(protected string $databasePath)
    {
        parent::__construct();
    }

    public function getConnection(): SQLite3
    {
        if (self::$connection === null) {
            $this->reconnect();
        }

        return self::$connection;
    }

    protected function onRun(): void
    {
        if (self::$connection === null) {
            $this->reconnect();
        }

        parent::onRun();
    }

    public function reconnect(): void
    {
        self::$connection = new SQLite3($this->databasePath);
        self::$connection->busyTimeout(60000);
    }
}
