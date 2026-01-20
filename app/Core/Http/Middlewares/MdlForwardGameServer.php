<?php

namespace App\Core\Http\Middlewares;

use App\Core\Exceptions\Enum\TypeExcept;
use App\Core\Exceptions\ExceptApp;
use App\Core\Libraries\Traits\TraitDomain;
use App\Core\Libraries\Traits\TraitInfra;
use App\Core\Libraries\Traits\TraitCore;
use App\Core\Libraries\Traits\TraitResponse;
use App\Core\Libraries\Traits\TraitUtil;
use Closure;
use Exception;
use Google\Protobuf\Internal\Message;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

final class MdlForwardGameServer
{
    use TraitCore;
    use TraitUtil;
    use TraitInfra;
    use TraitDomain;
    use TraitResponse;

    public function handle($request, Closure $next)
    {
        $response_gs = $this->_forward($request);
        $this->_ResponseParam::set('response_gs', $response_gs);
        return $next($request);
    }

    /**
     * @throws ExceptApp
     * @throws ConnectionException
     * @throws Exception
     */
    private function _forward(Request $request): array
    {
        // @note hallo
        //$payload = $request->all();
        //$jsonPb = json_encode($payload);
        //$game_server_api = $this->_Config::gameServer()->endpoint . '/' . $request->route('action');
        //$res = Http::withHeaders(['Content-Type' => 'application/json'])
        //    ->post($game_server_api, ['body' => $jsonPb]);
        //return response($res->body(), $res->status(), $res->headers());

        // @note protoBuf
        $proto_ver = "V{$request->header('PROTO_VER', 1)}";
        $action = $request->route('action');
        $api = Str::studly($action);
        $proto_name = "\\Protobuf\\$api\\$proto_ver";
        $req_class_name = "$proto_name\\Req$api";

        $payload = $request->all();
        if (!class_exists($req_class_name)) {
            $except_params['#1'] = $req_class_name;
            throw $this->_Except::app(TypeExcept::DevelopNoneProtoBuf, $except_params);
        }
        /** @var Message $req_protocol */
        $req_protocol = new $req_class_name($payload);
        $bin = $req_protocol->serializeToString();

        $game_server_api = $this->_Config::gameServer()->endpoint . '/' . $action;
        $res_binary = Http::withBody($bin, 'application/x-protobuf')->post($game_server_api);

        if ($res_binary->failed()) {
            $except_params['#1'] = $res_binary->status();
            $except_params['#2'] = $res_binary->body();
            throw $this->_Except::app(TypeExcept::DevelopNoneProtoBuf, $except_params);
        }

        $res_class_name = "$proto_name\\Res$api";
        if (!class_exists($res_class_name)) {
            $except_params['#1'] = $res_class_name;
            throw $this->_Except::app(TypeExcept::DevelopNoneProtoBuf, $except_params);
        }

        /** @var Message $res_protocol */
        $res_protocol = new $res_class_name();
        $res_protocol->mergeFromString($res_binary->body());
        return json_decode($res_protocol->serializeToJsonString(), true);
    }
}
