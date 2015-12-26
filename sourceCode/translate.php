<?php
require_once('workflows.php');

class Translate{
	private $url = "http://www.iciba.com/index.php?c=search&a=suggestnew&s=";
	public function getMeans($query){
		$workflows = new Workflows();
		$api = $this->url.$query;
		$res = $workflows->request($api);
		$res = json_decode( $res );
		if ($res->status === 1) {
			$means = $res->message[0]->means;
			foreach ($means as $key => $mean) {
				$i= implode(',',$mean->means);
				$workflows->result($key,'',$mean->part.$i,'','');
			}
		}else{
			$workflows->result(	'','','查不到\''.$query.'\'','没查到要找的单词','');
		}
		echo $workflows->toxml();
	}
}



