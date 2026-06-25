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

final class MdlForwardPod
{
    use TraitCore;
    use TraitUtil;
    use TraitInfra;
    use TraitDomain;
    use TraitResponse;

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ConnectionException
     * @throws ExceptApp
     */
    public function handle($request, Closure $next): mixed
    {
        $response = $this->_forward($request);
        if (isset($response['message']) && json_validate($response['message'])) {
            $response['message'] = json_decode($response['message'], true);
        }
        $this->_ResponseParam::set('develop', $response);
        return $next($request);
    }

    /**
     * @param Request $request
     * @return string
     * @throws ExceptApp
     */
    private function _mustEndpoint(Request $request): string
    {
        $server = Str::afterLast(dirname($request->path()), '/');
        $ep = match($server) {
            'api' => $this->_Config::develop()->api_endpoint,
            default => false
        };
        if ($ep === false) {
            throw $this->_Except::app(TypeExcept::DevelopGeneralError);
        }
        return $ep;
    }

    /**
     * @throws ExceptApp
     * @throws ConnectionException
     * @throws Exception
     */
    private function _forward(Request $request): array
    {
        $endpoint = $this->_mustEndpoint($request);
        $action = $request->route('action');
        $pod_api = $endpoint . '/' . $action;
        if ($request->isMethod('get')) {
            $res = Http::get($pod_api, $request)->throw();
            return ['status' => $res->status(), 'body' => $res->body()];
        }

        $is_pb = $request->boolean('pb', true);
        if (!$is_pb) {
            $res = Http::post($pod_api, $request);
            return json_decode($res, true);
        }

        // @note protoBuf
        // @note composer.json に "autoload.psr-4.Proto//" の設定があるか確認
        $api = Str::studly($action);
        $proto_name = "\\Proto\\$api";
        $req_class_name = "$proto_name\\Req$api";

        $payload = $request->all();
        if (!class_exists($req_class_name)) {
            $except_params['#1'] = $req_class_name;
            throw $this->_Except::app(TypeExcept::DevelopNoneProtoBuf, $except_params);
        }

        /** @var Message $req_protocol */
        $req_protocol = new $req_class_name($payload);
        $bin = $req_protocol->serializeToString();

        $res_binary = Http::withBody($bin, 'application/x-protobuf')
            ->post($pod_api);

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
