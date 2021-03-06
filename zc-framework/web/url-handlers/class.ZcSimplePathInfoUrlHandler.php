<?php
class ZcSimplePathInfoUrlHandler implements ZcUrlHandler {

	public function buildUrl($route, $params = '', $ssl = false) {
		$scheme = $ssl ? 'https' : 'http';
		$domain = $_SERVER['HTTP_HOST'];
		$port = $_SERVER['SERVER_PORT'];

		$route = trim($route, '/');
			
		$url = $scheme . '://' . $domain . ($port == 80 ? '' : ':' . $port) . '/index.php/' . $route;

		if (is_array($params)) {
			$params = http_build_query($params, '', '&');
		}

		if ($params) {
			$url .= '?' . ltrim($params, '&');
		}
		return $url;
	}

	public function parseBack() {
		if (isset($_SERVER['PATH_INFO'])) {
			$_GET['route'] = trim($_SERVER['PATH_INFO'], '/');
		}
	}
}
