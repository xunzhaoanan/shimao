<?php
/**
 * Author: ZhangP
 * Date: 2016/09/02
 * Time: 10:12
 */

namespace common\models;

use Yii;

class Test extends BaseModel {
	public function test($params) {
		$this->getResult('test',$params);
	}
}