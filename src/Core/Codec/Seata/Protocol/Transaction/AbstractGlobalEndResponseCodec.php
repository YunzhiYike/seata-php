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
namespace Hyperf\Seata\Core\Codec\Seata\Protocol\Transaction;

use Hyperf\Seata\Core\Model\GlobalStatus;
use Hyperf\Seata\Core\Protocol\AbstractMessage;
use Hyperf\Seata\Core\Protocol\Transaction\AbstractGlobalEndResponse;
use Hyperf\Seata\Utils\Buffer\ByteBuffer;
use InvalidArgumentException;

class AbstractGlobalEndResponseCodec extends AbstractTransactionResponseCodec
{
    public function getMessageClassType(): string
    {
        return AbstractGlobalEndResponse::class;
    }

    public function encode(AbstractMessage $message, ByteBuffer $buffer): ByteBuffer
    {
        parent::encode($message, $buffer);

        if (! $message instanceof AbstractGlobalEndResponse) {
            throw new InvalidArgumentException('Invalid message');
        }

        $buffer->putUByte($message->getGlobalStatus()->getStatus());
        return $buffer;
    }

    public function decode(AbstractMessage $message, ByteBuffer $buffer): AbstractMessage
    {
        parent::decode($message, $buffer);

        if (! $message instanceof AbstractGlobalEndResponse) {
            throw new InvalidArgumentException('Invalid message');
        }

        $message->setGlobalStatus(new GlobalStatus((int) $buffer->readUByte()));
        return $message;
    }
}
