<?php
/**
 * Q01004ReqBO.php
 *
 * @author libojian <bojian.li@foxmail.com>
 * @since 2023/7/21 11:46 PM
 * @version 0.1
 */

namespace Bojian\CertificatePay\Certificate;

class Q01004ReqBO
{
    /**
     * 证联分配商户号（子商户）
     */
    public String $instuId;

    /**
     * 收款户名
     */
    public String $payeeName;

    /**
     * 收款账号
     */
    public String $payeeCardNo;

    /**
     * 开始时间
     */
    public String $startTime;
    /**
     * 结束时间
     */
    public String $endTime;
}
