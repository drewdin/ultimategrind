<?php
class Ps2_CheckEmail {
	protected $_email;
	protected $_errors = array();
	protected $_domain;
	
	public function __construct( $email ) {
		$this->_email = $email;
	}
	
	public function isValid( $this->_email ) {
		$emailPattern = '/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/';
		
		//now check if the domain is registered, only works on a linux/unix machine
		//strip out everything but the domain name from the email
		$domain = preg_replace( $emailPattern, '', $this->_email );
		
		if( !checkdnsrr( $domain ) ) {
			$this->_errors = 'Your email address is invalid. <br />';
		}
	}
	
	public function check() {
		$emailPattern = '/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/';
		if( !preg_match( $emailPattern, $this->_email ) ) { 
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