<?php
class InputValidator{

  private $fieldname; //name, email
  private $inputype; //email, id, password, string, text
  private $datatype; //numeric, string, integer, boolean, timestamp
  private $minLength; //minlenght
  private $maxLength; //maxlenght
  private $required; //is required or not

  public $language;
  public $messages;

  public function __CONSTRUCT($lang){
      $this->language = $lang;
      switch($this->language){
        case "ES":
            require 'es.lang.php';
        break;
        case "EN":
            require 'en.lang.php';
        break;
      }
  }

  public function email( $myVar, $rules){

    $rules = explode("|", $rules);

    $messages = array(
      'isset' => VAR_ISSET,
      'required' => VAR_REQUIRED,
      'format' => VAR_EMAIL_FORMAT
    );

    $result['messages'] = null;

    if( !isset($myVar) ){
       $result['messages'] = $messages['isset'];
    }else{

      if( in_array("required", $rules)  && empty($myVar) ){
        $result['messages'] = $messages['required'];
      }

      if( !empty($myVar) ){
        $myVar = strip_tags( trim( $myVar ) );
        $myVar = filter_var($myVar, FILTER_SANITIZE_EMAIL);
        if ( !filter_var($myVar, FILTER_VALIDATE_EMAIL) ) {
              $result['messages'] = $messages['format'];
        }
      }

    }
    $result['email'] = $myVar;
    return $result; // Si es un array vacio, indica que todo esta ok

  }

  public function input_text( $myVar, $rules){

    $rules = explode("|", $rules);

    $messages = array(
      'isset' => VAR_ISSET,
      'required' => VAR_REQUIRED,
      'format' => VAR_STRING
    );

    $result['messages'] = null;

    if( !isset($myVar) ){
       $result['messages'] = $messages['isset'];
    }else{

      if( in_array("required", $rules)  && empty($myVar) ){
        $result['messages'] = $messages['required'];
      }

      if( !empty($myVar) ){

        $myVar = strip_tags( trim( $myVar ) );
        $myVar = filter_var($myVar, FILTER_SANITIZE_STRING);

        if (!preg_match("/^[a-zA-Z ]*$/",$myVar)) {
              $result['messages'] = $messages['format'];
        }

      }

    }
    $result['input_text'] = $myVar;
    return $result; // Si es un array vacio, indica que todo esta ok

  }


}

/*
$gump->validation_rules(array(
	'username'    => 'required|alpha_numeric|max_len,100|min_len,6',
	'password'    => 'required|max_len,100|min_len,6',
	'email'       => 'required|valid_email',
	'gender'      => 'required|exact_len,1|contains,m f',
	'credit_card' => 'required|valid_cc'
));

$gump->filter_rules(array(
	'username' => 'trim|sanitize_string',
	'password' => 'trim',
	'email'    => 'trim|sanitize_email',
	'gender'   => 'trim',
	'bio'	   => 'noise_words'
));
*/

$_REQUEST['email'] = "claudiaeforero@gmail.com";
$email_rules = "email|required";

$inputValidator = new InputValidator("EN");
$message = $inputValidator->email($_REQUEST['email'], $email_rules);

echo $_REQUEST['email']."</br>";
echo "<pre>".print_r($message, true)."</pre>";

$_REQUEST['name'] = "<h1>Claudia Liliana</h1> 998";
$input_text_rules = "input_text|required|string|min_len:3|max_len:10";

$message = $inputValidator->input_text($_REQUEST['name'], $input_text_rules);

echo $_REQUEST['name']."</br>";
echo "<pre>".print_r($message, true)."</pre>";




?>
