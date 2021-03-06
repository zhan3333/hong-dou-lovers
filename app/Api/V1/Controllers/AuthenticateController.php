<?php
/**
 * @author zhan <grianchan@gmail.com>
 * 2017/6/10 22:02
 */

namespace App\Api\V1\Controllers;


use App\Api\V1\BaseController;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends BaseController
{
    /**
     * 获取token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'identifier' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = \DB::table('users')
            ->where('email', $request->input('identifier'))
            ->orWhere('name', $request->input('identifier'))
            ->first(['id', 'email']);
        $uid = empty($user->id)?0:$user->id;
        if (empty($uid)) return $this->formatReturn([], -1, '用户不存在');
        $credentials = ['email' => $user->email, 'password' => $request->input('password')];
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->formatReturn([], -1, '账号或密码错误');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->formatReturn([], -1, '服务器错误');
        }

        // all good so return the token
        return $this->formatReturn(['token' => $token, 'uid' => $uid]);
    }

    /**
     * 用户注册
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:users,name|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:255',
        ]);
        $data = $request->all();
        User::insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => str_random(60),
        ]);
        return $this->formatReturn([], '0', '注册成功');
    }

    /****
     * 获取用户的信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        // the token is valid and we have found the user via the sub claim
        return $this->formatReturn(compact('user'));
    }

    /**
     * 判断用户是否登陆
     */
    public function isLogin(Request $request)
    {
        $isLogin = !empty($request->user());
        return $this->formatReturn(['isLogin' => $isLogin]);
    }
}