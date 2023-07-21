<?php

namespace Tests\Certificate;

use Bojian\Phpunit\BaseApi;
/**
 * AliyunClient.php
 *
 * @author libojian <bojian.li@foxmail.com>
 * @since 2023/7/14 6:53 PM
 * @version 0.1
 */
class CertificateTest extends BaseApi
{
    /**
     * 测试pay验签
     * @return void
     */
    public function testPay()
    {
        $string = certificatePayClient('setAuthorization');
        $this->assertSame('setAuthorization', $string);
    }

}
