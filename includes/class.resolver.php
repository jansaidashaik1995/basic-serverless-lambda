<?php
	
	class resolver {
		
		public function __default() {
			
		}
		
		public function decode() {
			echo "<pre>";
			//print_r($_SERVER);
						
			$req = [
				'environment' => 'test',
				'host' => null,
				'handle' => null,
				'path' => null,
				'breadcrumbs' => [],
				'vars' => [],	
			];
			
			//$req['query'] = $_SERVER['REQUEST_URI'];						
			$req['path'] = strtok($_SERVER['REQUEST_URI'], '?');
			$req['breadcrumbs'] = explode("/", $req['path']);
			unset($req['breadcrumbs'][0]);
			$req['breadcrumbs'] = array_values($req['breadcrumbs']);
			if (count($req['breadcrumbs'])==1 and empty($req['breadcrumbs'][0])) { $req['breadcrumbs'] = []; }
			
			
			
			if (isset($_SERVER['HTTP_X_PROVIDER_HOST'])) {
				$req['host'] = $_SERVER['HTTP_X_PROVIDER_HOST'];
			} else {
				$req['host'] = $_SERVER['HTTP_HOST'];
			}				
			if (($req['host'] == "cacher.trady.dev" or $req['host'] == "cacher.trady.com") and isset($_SERVER['HTTP_CF_WORKER'])) {
				$req['host'] = $_SERVER['HTTP_CF_WORKER'];
				
				//host is either trady.dev or trady.com
				if (count($req['breadcrumbs'])>0) {
					$req['handle'] = $req['breadcrumbs'][0];
					//remove handle as first part of path as not used for nav
					unset($req['breadcrumbs'][0]);
					$req['breadcrumbs'] = array_values($req['breadcrumbs']);					
				} else {
					die("no handle given??");
				}
			}	
			
			if ($req['host'] != "trady.dev") {
				$req['environment'] = "live";
			}														
			
			$req['vars'] = $_REQUEST;
			
			
			//$req['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
			
			print_r($req);
		}
		
		public function check() {
			
		}
		
	}