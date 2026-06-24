<?php

use App\Mcp\Servers\AppServer;
use Laravel\Mcp\Facades\Mcp;

Mcp::web('/mcp/app', AppServer::class)
    // TODO 認証は動作確認のため無効
    ->withoutMiddleware(['auth']);
