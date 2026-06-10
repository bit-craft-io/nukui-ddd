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

#[Description('外部公開用ユーザ識別子よりユーザ情報を取得')]
#[IsReadOnly]
class McpToolGetUserInfo extends Tool
{
    use TraitDomain;

    public function handle(Request $req): ResponseFactory
    {
        $public_id = $req->string('public_id') ?? '';
        $rep_user = $this->_Domain::rep(RepHub::REP_USER);
        $ent_user = $rep_user->findByPublicId($public_id);
        return Response::structured([
            'id' => $ent_user->id,
            'public_id' => $ent_user->public_id,
            'nick_name' => $ent_user->nick_name,
            'energy' => $ent_user->energy,
            'energy_max_regen' => $ent_user->energy_max_regen,
            'energy_max_stock' => $ent_user->energy_max_stock,
        ]);
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'public_id' => $schema->string()->description('外部公開用ユーザ識別子')->required(),
        ];
    }
}
