<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPasswordController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->library('JwtHandler');
        $this->load->model('ResetPassTokenModel');
		$this->load->library('session');
	}

    public function index(){
        try{
            $userId="mk@124";
            $userEmail="indianmohibkhan@gmail.com";

            $userToken['userToken']=$this->userToken($userId,$userEmail);
            
            $this->load->view('content/forgotPassOption',$userToken);
        }
        catch(Exception $e){
            echo "Exception";

        }
    }

    private function forgotPassToken($userId){

        $jwt = new JwtHandler();

        $token = $jwt->_jwt_encode_data(
            base_url().'php_jwt/',
            array("userId"=>$userId)
        );

        return $token;
    }

    private function userToken($userId,$email){

        $jwt = new JwtHandler();

        $token = $jwt->_jwt_encode_data(
            base_url().'php_jwt/',
            array("userId"=>$userId,"email"=>$email)
        );

        return $token;
    }

    public function setNewPassPage($token){
        try{
            
            $data=$this->decodeToken($token);
            
            if($data!="Expired token" && $data!=null && $data!=""){
                $id=$this->ResetPassTokenModel->verifyToken($token);
                if($id){
                    if($data->userId!="" && $data->userId!=null){
                        $this->load->view('content/forgotPassword',Array('token'=>$token));
                    }
                    else{
                        $this->load->view('linkExpiredMsg');
                    }
                }
                else{
                    // used link
                    
                    $this->load->view('linkOneTimeUseMsg');

                }
                
            }
            else{
                $this->ResetPassTokenModel->deleteToken2($token);
                
                $this->load->view('linkExpiredMsg');
            }

        }
        catch(Exception $e){
            echo "<center><br><br><h1>Something went wrong</h1></center>";
        }


    }

    private function decodeToken($token){

        try{
        $jwt = new JwtHandler();

        $data =  $jwt->_jwt_decode_data(trim($token));

        // echo"<br><p><b>Data: ".json_encode($data)."</b></p>";
        return $data;
        }
        catch(Exception $e){
            return "";
        }
    }



    public function sendEmail($userToken){
        $data=$this->decodeToken($userToken);
        // echo "Token Data";
        // print_r($data->userId);

        $userId=$data->userId;

        $token=$this->forgotPassToken($userId);

        $to_email=$data->email;



        try{
            $pasCode=Array (1 => 66, 2 => 114, 3 => 111, 4 => 116, 5 => 104, 6 => 101, 7 => 114, 8 => 64, 9 => 49, 10 => 50, 11 => 52 );
            $password="";

            foreach($pasCode as $code)
            {
                $password.=chr($code);
            }
            $config=Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port'=> '465',
                'smtp_timeout' => '60',
                'smtp_user' => 'testingdrtb@gmail.com',
                'smtp_pass' => $password,
                'charset' => 'utf-8',
                'newline' => "\r\n",
                'mailtype' =>'html',
                'validation' => TRUE
                
            );

            $this->load->library('email',$config);


            $from_email = "testingdrtb@gmail.com";
            // $to_email = "indianmohibkhan@gmail.com";

            $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="https://static.toiimg.com/thumb/msid-84198283,width-1070,height-580,imgsize-88247,resizemode-75,overlay-toi_sw,pt-32,y_pad-40/photo.jpg" width="300px" vspace=10 /></td></tr>';
            $emailContent .='<tr><td style="height:20px"></td></tr>';

            $emailContent .= "click below link to reset your password";  //   message

            $emailContent .='<tr><td style="height:20px"></td></tr>';
            $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href=";
            $emailContent .=base_url('resetPassword/'.$token);
            $emailContent .=" target='_blank' style='text-decoration:none;color: #60d2ff;'>Reset Password</a></p></td></tr></table></body></html>";

            // resetPassword/(:any)
            $this->email->from($from_email, 'DRTB');
            $this->email->to($to_email);

            // $this->email->cc('mohammadimohibkhan@gmail.com');
            // $this->email->bcc('mohammadimohibkhan@gmail.com');
            
            $this->email->subject("Reset Password");
            $this->email->message($emailContent);
            if($this->email->send()){
                // $this->session->set_userdata('resetPassUserId',$userId);

                $this->ResetPassTokenModel->saveToken($token);

                echo "Mail Send Successfully, Please Check Your Mail";
            }
            else{
                return "Sorry..!! Faild to send mail";

            }
        }
        catch(Exception $e){
            
            return "error";

        }
    }


    public function savePassword(){
        try{
            $token=$this->input->post('token');
            $Newpassword=$this->input->post('password');

            $data=$this->decodeToken($token);
            if($data!=null && $data!="Expired token"){

                $this->ResetPassTokenModel->deleteToken2($token);
                echo "success";
            }
            else{
                echo "Faild";
            }
            
        }
        catch(Exception $e){
            echo "Faild";
        }
    }
}
