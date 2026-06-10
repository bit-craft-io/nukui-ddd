<?php

namespace App\Mcp\Tools;

use App\Core\Libraries\Traits\TraitDomain;
use App\Domains\RepHub;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[Description('内部用ユーザ識別子より所持アイテムを全件取得。個数（amount）、入手日(created_at)などの情報も含まれる')]
#[IsReadOnly]
class McpToolGetUserItems extends Tool
{
    use TraitDomain;

    public array $_result = [];

    public function handle(Request $req): ResponseFactory
    {
        $user_id = $req->integer('user_id') ?? 0;
        $rep_item = $this->_Domain::rep(RepHub::REP_ITEM);
        $ent_items = $rep_item->getByUserId($user_id);
        foreach ($ent_items as $ent_item) {
            $this->_result['items'][] = $ent_item->toArray();
        }
        if (empty($this->_result['items'])) {
            return Response::structured([
                'items'   => [],
                'message' => 'item is empty',
            ]);
        }
        return Response::structured($this->_result);
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'user_id' => $schema->integer()->description('内部用ユーザ識別子')->required(),
        ];
    }
}
