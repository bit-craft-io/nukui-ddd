<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\McpToolGetUserInfo;
use App\Mcp\Tools\McpToolGetUserItems;
use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;

#[Name('App Server')]
#[Version('1.0.0')]
#[Instructions('アプリの各種情報を取得')]
class AppServer extends Server
{
    protected array $tools = [
        McpToolGetUserInfo::class,
        McpToolGetUserItems::class,
    ];

    protected array $resources = [
        //
    ];

    protected array $prompts = [
        //
    ];
}
