<?php
class Phone2Country{

	private $_json;
	private $_phone;
	
	public function __construct($src){
		if( is_file( $src ) ){
			$this->_json = json_decode( file_get_contents($src), true );
		}else{
			throw new Exception("Отсутствует файл ".$src);
		}
		foreach( $this->_json as &$_v ){
			$_regex=preg_replace( '/[^#a-zа-яё\d]/ui', '', $_v['mask'] ); // убираем нефункциональные символы из исходной маски
			$_v['pattern']='/^'.preg_replace( '/[#]/ui', '[\da-zа-яё]{1}', $_regex ).'/ui'; // образец поиска - маска, задающий правило поиска
			$_v['weght']=strlen( preg_replace( '/[^\d]/ui', '', $_regex )); // вес маски, если больше цифр есть в маске, то телефон с большим колличеством совпадений имеет больший вес
		}
	}
	
	public function setPhone($phone){
		$this->_phone=preg_replace( '/[^#a-zа-яё\d]/ui', '', $phone ); // убираем нефункциональные символы из телефонного номера
		return $this;
	}
	
	public function getValue($name=false){
		$_arrWeights=[]; // массив весов соответствий 
		foreach( $this->_json as $_v ){
			if( preg_match( $_v['pattern'], $this->_phone ) ){
				$_arrWeights[$_v['weght']]=$_v;
			}
		}
		if( empty( $_arrWeights ) || empty( $_arrWeights[max(array_keys($_arrWeights))][$name] ) ){
			if( empty( $name ) ){
				return $_arrWeights[max(array_keys($_arrWeights))];
			}
			return '';
		}
		return $_arrWeights[max(array_keys($_arrWeights))][$name];
	}
	
}
?>