<?php

namespace App\Core\Http\Middlewares;

use App\Core\Libraries\Traits\TraitApplication;
use Closure;
use Protobuf\Health\V1\ReqHealth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Protobuf\Health\V1\ResHealth;

final class MdlForwardGameServer
{
    use TraitApplication;

    public function handle($request, Closure $next)
    {
        return $this->_forward($request);
    }

    private function _forward(Request $request)
    {
        // @note hallo
        //$payload = $request->all();
        //$jsonPb = json_encode($payload);
        //$game_server_api = $this->_Config::gameServer()->endpoint . '/' . $request->route('action');
        //$res = Http::withHeaders(['Content-Type' => 'application/json'])
        //    ->post($game_server_api, ['body' => $jsonPb]);
        //return response($res->body(), $res->status(), $res->headers());

        // @note protoBuf
        //$payload = $request->all();
        //$reqPb = new ReqHealth();
        //$reqPb->setMessage($payload['message']);
        //$reqPb->setInProgress($payload['in_progress']);
        //$reqPb->setTimestamp(intval(Carbon::now()->timestamp));
        //$bin = $reqPb->serializeToString();

        $payload = $request->all();
        $reqPb = new ReqHealth($payload);
        $bin = $reqPb->serializeToString();

        $game_server_api = $this->_Config::gameServer()->endpoint . '/' . $request->route('action');

        $resBin = Http::withBody($bin, 'application/x-protobuf')
            ->post($game_server_api);

        // 1. まずステータスと生の中身をチェック！
        if ($resBin->failed()) {
            dd(
                "エラーコード: " . $resBin->status(),
                "生のレスポンス: " . $resBin->body() // ここに「Unauthorized」とか入ってへんか？
            );
        }

        $resPb = new ResHealth();
        $resPb->mergeFromString($resBin->body());

        dd($resPb->getIsSuccess(), $resPb->getMessage());
//        $res = Http::withHeaders([
//            'Content-Type' => 'application/x-protobuf',
//        ])->withBody(
//            $binary,
//            'application/x-protobuf'
//        )->post('http://host.docker.internal:30180/health');

//        $req->setMessage($payload['message']);
//        $req->setInProgress($payload['in_progress']);
//        $req->setTimestamp(Carbon::now()->timestamp);
//        $bin = $req->serializeToJsonString();

        // TODO temp

//        $jsonPb = json_encode([]);
//        $game_server_api = $this->_Config::gameServer()->endpoint . '/' . $request->route('action');
//        $res = Http::withHeaders(['Content-Type' => 'application/json'])
//            ->send($request->method(), $game_server_api, ['body' => $jsonPb]);

        // 4. gs のレスポンスをそのまま返す
        return response(
            $res->body(),
            $res->status(),
            $res->headers()
        );
    }
}
