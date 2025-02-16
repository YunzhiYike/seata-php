<?php

declare(strict_types=1);
/**
 * Copyright 2019-2022 Seata.io Group.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */
namespace Hyperf\Seata\Core\Rpc;

use Hyperf\Seata\Core\Protocol\AbstractMessage;
use Hyperf\Seata\Core\Protocol\AbstractResultMessage;

interface TransactionMessageHandler
{
    /**
     * On a request received.
     *
     * @param request received request message
     * @param context context of the RPC
     * @return response to the request
     */
    public function onRequest(AbstractMessage $request, ?RpcContext $context): AbstractResultMessage;

    /**
     * On a response received.
     *
     * @param response received response message
     * @param context  context of the RPC
     */
    public function onResponse(AbstractResultMessage $response, ?RpcContext $context);
}
