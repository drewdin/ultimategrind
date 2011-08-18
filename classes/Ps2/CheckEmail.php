<?php
class Ps2_CheckEmail {
	protected $_email;
	protected $_errors = array();
	protected $_domain;
	protected $_pattern_email = '/\A(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)\Z/';
	
	public function __construct( $email ) {
		$this->_email = $email;
	}
	
	public function isValid( $this->_email ) {
		//now check if the domain is registered, only works on a linux/unix machine
		//strip out everything but the domain name from the email
		$domain = preg_replace( $this->_pattern_email, '', $this->_email );
		
		if( !checkdnsrr( $domain ) ) {
			$this->_errors = 'Your email address is invalid. <br />';
		}
	}
	
	public function check() {
		if( !preg_match( $this->_pattern_email, $this->_email ) ) { 
			// the email address is not valid
			$this->_errors[] =  'Your email address is invalid.<br />';
		}
		
		if( $this->_email ) {	
			//now check if the domain is registered, only works on a linux/unix machine
			//strip out everything but the domain name from the email
			$domain = preg_replace( $emailPattern, '', $this->_email );
			if( !checkdnsrr( $domain ) ) {
				$this->_errors = 'Your email address is invalid. <br />';
			}
		}
		return $this->_errors ? false : true;
	}
	
	public function getErrors() {
		return $this->_errors;
	}
}

