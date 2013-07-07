<?php
/**
 * 生成和解析URL类。采用策略模式来实现真正的URL操作。
 * 系统内置3种简单的UrlHandler，应用可以自己实现UrlHandler，并替换。
 * 
 * @author tangjianhui 2013-7-4 下午2:36:20
 *
 */
class ZcUrl {

	private $urlHandler = array();

	public function __construct() {
		$urlHandlerConfig = ZcFactory::getConfig()->get('url.handler');
		
		if (!empty($urlHandlerConfig ['file'])) {
			require_once (Zc::C('dir.fs.app') . $urlHandlerConfig ['file']);
		}
		$this->urlHandler = new $urlHandlerConfig['class'];
	}

	public function parse() {
		$url = $this->urlHandler->parseBack();
	}

	public function url($route, $params, $ssl) {
		$url = $this->urlHandler->buildUrl($route, $params, $ssl);
		return $url;
	}
}