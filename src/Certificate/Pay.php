<?php
/**
 * Pay.php
 * 该demo模拟商户发起交易
 * @author libojian <bojian.li@foxmail.com>
 * @since 2023/7/21 10:12 PM
 * @version 0.1
 */

namespace Bojian\CertificatePay\Certificate;


use WpOrg\Requests\Requests;

class Pay
{
    //商户公钥证书序列号
    protected string $signNo;
    //证联公钥证书序列号
    protected string $encrpNo;
    //证联接入地址
    protected string $url;
    //证联公钥文件路径
    protected string $encrpPath;
    //商户私钥文件路径
    protected string $signPath;
    //商户私钥密码
    protected string $signPwd;
    //版本号
    protected string $version = '1.1.1';
    //设置魔术方法
    protected string $function;
    //暂存请求params信息
    protected array $params;
    //设置请求header信息
    protected array $header = [
        'Content-Type' => 'applictation/json;charset=utf-8',
        'Accept' => 'application/json;charset=utf-8'
    ];
    //设置请求body信息
    protected array $body;
    //设置请求options信息
    protected array $options;

    public function __construct(string $route, array $params = [], array $options = [])
    {
        $this->params = $params;
        $this->signNo = Helper::getEnv('certificate.sign_no');
        $this->encrpNo = Helper::getEnv('certificate.encrp_no');
        $this->url = Helper::getEnv('certificate.url');
        $this->encrpPath = Helper::getEnv('certificate.encrp_path');
        $this->signPath = Helper::getEnv('certificate.sign_path');
        $this->signPwd = Helper::getEnv('certificate.sign_pwd');
        $this->function = $route;
        $this->options = $options;
    }

    /**
     * 设置验签授权
     */
    protected function setAuthorization() {
        // TODO: Implement setAuthorization() method.
        !empty($this->params['msgId']) && $this->header['msgId'] =$this->params['msgId'];
        !empty($this->params['merchNo']) && $this->header['merchNo'] = $this->params['merchNo'];
        !empty($this->params['txCode']) && $this->header['txCode'] = $this->params['txCode'];
        !empty($this->params['version']) && $this->header['version'] = $this->params['version'];
        $this->header['signNo'] = $this->signNo;
        $this->header['encrp'] = 1;
        $this->header['encrpNo'] = $this->encrpNo;
        $this->header['timestamp'] = date('YmdHis');
    }

    /**
     * 设置请求body信息
     *
     * @return void
     */
    protected function setRequestBody()
    {
        $bo = new Q01004ReqBO();
        $bo->instuId = 'B00000935';
        $bo->payeeName = '异乡好居测试商户待清分户';
        $bo->payeeCardNo = '0401820000000935';
        $bo->startTime = '20230509134900';
        $bo->endTime = '20230709144900';
        $reqBO = json_encode($bo);
//        // 加密数据
//        String jsonData = SM4Util.sm4EcbEncrypt(key, reqBO, "NoPadding");
//		//加密对称加密的秘钥
//		// 获取公钥
//		String publicKey = getPublicKey();
//		String secrtKey = SM2Util.encrypt(publicKey, key);
//
//		// 将密文放入body
//		body.setData(jsonData);
//		body.setSign(sign(jsonData));
//		body.setSecret(secrtKey);
    }

    /**
     * 获取请求结果
     * @return mixed
     */
    public function getResult()
    {
        // TODO: Implement getResult() method.
        $this->setAuthorization();
        $this->setRequestBody();
        $response = Requests::post($this->url, $this->header, $this->body, $this->options);
        return $this->{$this->function}($response);
    }

    protected function getAuthorization($response)
    {
        var_dump($response);
//        System.out.println("应答内容："+"");
//        MessageBody respBody = JSON.parseObject(result,MessageBody.class);
//		// 验签
//		boolean checkResult = SM2Util.verify(publicKey, encrpNo, respBody.getSign(), respBody.getData());
//		System.out.println("验签结果：" + checkResult);
//		// 获取私钥
//		String privateKey = getPrivateKey();
//		// 解密对称秘钥
//		String k = SM2Util.decrypt(privateKey, respBody.getSecret());
//		System.out.println("对称秘钥：" + k);
//		// 解密业务报文
//		String backData = SM4Util.sm4EcbDecrypt(k, respBody.getData());
//		System.out.println("返回业务报文：" + backData);
//		//业务报文转化对象
//		MessageResponse responseBO = JSON.parseObject(backData, new TypeReference<MessageResponse>() {});
//		System.out.println("返回业务报文对象：" + responseBO);
//		ResultBO<Q01004ResBO> resultBO = new ResultBO<Q01004ResBO>();
//		if(null != responseBO && "000000".equals(responseBO.getSysRtnCode())) {
//            resultBO = JSON.parseObject(responseBO.getBizData(), new TypeReference<ResultBO<Q01004ResBO>>() {});
//		}
//		if (null != resultBO.getData()) {
//            List<Q01004ResEntity> bankSns = null;
//			byte[] retData = ZipUtil.inflater(resultBO.getData().getBankSns());
//			bankSns = (List<Q01004ResEntity>) JSON.parse(retData);
//			System.out.println("返回业务报文bankSns：" + bankSns);
//		}
    }

    /**
     * @param int $length
     * @return void
     */
    private function generateKey(int $length) {

    }
}
