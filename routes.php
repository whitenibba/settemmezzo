<?php

class DumpHTTPRequestToFile {
	public function execute($targetFile) {
		$data = sprintf(
			"%s %s %s\n\nHTTP headers:\n",
			$_SERVER['REQUEST_METHOD'],
			$_SERVER['REQUEST_URI'],
			$_SERVER['SERVER_PROTOCOL']
		);

		foreach ($this->getHeaderList() as $name => $value) {
			$data .= $name . ': ' . $value . "\n";
		}

		$data .= "\nRequest body:\n";

		file_put_contents(
			$targetFile,
			$data . file_get_contents('php://input') . "\n"
		);

	}

	private function getHeaderList() {
		$headerList = [];
		foreach ($_SERVER as $name => $value) {
			if (preg_match('/^HTTP_/',$name)) {
				// convert HTTP_HEADER_NAME to Header-Name
				$name = strtr(substr($name,5),'_',' ');
				$name = ucwords(strtolower($name));
				$name = strtr($name,' ','-');

				// add to list
				$headerList[$name] = $value;
			}
		}

		return $headerList;
	}
}


(new DumpHTTPRequestToFile)->execute('./dumprequest.txt');

session_start();

require_once __DIR__.'/router.php';
if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
      $origin = $_SERVER['HTTP_ORIGIN'];
  }
  else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
      $origin = $_SERVER['HTTP_REFERER'];
  } else {
      $origin = $_SERVER['REMOTE_ADDR'];
  }
header('Access-Control-Allow-Origin: '.$origin ); 
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');



any("/test","test.php");


//------------VIEW-------------

get("/","views/app/index.php");



//------------API------------
      //SESSION
post("/login","api/session/login.php");
any("/logout","api/session/logout.php");

      //DASHBOARD
post("/getProducts","api/dashboard/getProducts.php");
post("/addProduct","api/dashboard/addProduct.php");
post("/updateProduct","api/dashboard/updateProduct.php");
post("/deleteProduct","api/dashboard/deleteProduct.php");



any('/404','views/404.php');
