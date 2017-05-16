<?php 

namespace Moonshiner\Cms\Parser; 
/**
* 
*/
class ConfigParser 
{
	protected $config; 
	function __construct(array $config)
	{
		$this->config = $config; 
	}
	private function prependStatics(){
		if(!isset($this->config['statics'])){
			return; 
		}
		$statics = $this->config['statics']; 
		$this->config['templates'] = array_map(function($value) use ($statics){

			$value['additional_fields'] = array_merge($statics, $value['additional_fields']); 
			return $value; 
		}, $this->config['templates']);

		return $this;  
	}
	public function build(){
		$this->prependStatics(); 

		return $this->config; 
	}
}

