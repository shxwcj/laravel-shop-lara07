<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressRequest;
use App\Http\Resources\Resource;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    /**
     * 获取售货地址列表
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($userId = $request->get('user')){
            if ($user = User::query()->find($userId)){
                return new Resource($user->addresses()->get());
            }
           throw new \Exception('没有此用户',404);
        }
        return Resource::collection(UserAddress::query()->latest()->paginate($request->get('per_page',15)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserAddressRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function store(UserAddressRequest $request)
    {
        //1 需先拿去user信息
//        return new Resource(
//            $request->user()->addresses()->create($request->only([
//                'province',
//                'city',
//                'district',
//                'address',
//                'zip',
//                'contact_name',
//                'contact_phone',
//            ]))
//        );

        //2
        return new Resource(
            User::query()->find($request->get('user_id',1))->addresses()->create($request->only([
                'province',
                'city',
                'district',
                'address',
                'zip',
                'contact_name',
                'contact_phone',
            ]))
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
