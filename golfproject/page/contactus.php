<?php 
$objDatabase->table='tbl_feedback';
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
   //print_r($_SESSION);
    $fromName=$_POST['name'];
    $fromEmail=$_POST['email'];
    $subject=$_POST['subject'];
    $country=$_POST['country'];
    $address=$_POST['address'];
    $captcha_key=$_POST['captcha_key'];
    $comment=$_POST['comment'];
    if($_POST['name']==""){
        $msg="Name is Empty";
    }else if($comment==""){
        $msg="Please write some comment";
   }  else if($captcha_key==""){
        $msg="Please enter security key";
    }else if($captcha_key!=$_SESSION['security_code']){
        $msg="Invalid Security Key";
    }else{
        $objDatabase->data=array("name"=>$fromName,
                                 "email"=>$fromEmail,
                                 "address"=>$address,
                                 "country"=>$country,
                                 "subject"=>$subject,
                                 "message"=>$comment,
                                 "enquiry_date"=>date('Y-m-d')
                                );
        $success=$objDatabase->insert(); 
        if($success==true){
          echo '<script language="javascript">
                alert("Data Inserted");
              </script>';
              //For Mail open
$email_to = "gclncguy@gmail.com";
$email_subject = "Message From web check";
$email_message = " Hello Anup ,
You have this email received from your website contact form.
Please try responding back as soon as possible on the following inquries.
Form details:\n\n";
function clean_string($string) {
$bad = array("content-type","bcc:","to:","cc:","href");
return str_replace($bad,"",$string);
}
$email_message .= "Name: ".clean_string($fromName)."\n";
$email_message .= "Email: ".clean_string($fromEmail)."\n";
$email_message .= "Subject : ".clean_string($subject)."\n";
$email_message .= "Message: ".clean_string($comment)."\n\n";
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
echo '<script>
alert("Thank You, We will Response you as Soon as Possible");
</script>';
//For Mail Close
         }else{
            $msg = "Error While Inserting";
        }        
        //$objFunction->show_query();
    }    
}
?> 
<h1>Feedback:</h1>
 <p>
     DIT Solution Bagbazar <br/>
     Tel: 01-4268001 <br/>
      <br/>
     
 </p>
    <span style="color:red;font-weight:bold;"><?php echo $msg?></span>
    <span style="color:green;font-weight:bold;"><?php echo $msg1?></span>
    <div id="signup">

        <form action="" method="post" id="feedbackform">
            <div class="suMain">
                <div class="suColL">Name:</div>
                <div class="suColR"><input placeholder="enter your name" value="" name="name" type="text" class="suInpTxt" /></div>
                <div class="clearfloat"></div>
            </div><!-- end of class suMain -->
            <div class="suMain">
                <div class="suColL">Subject:</div>
                <div class="suColR"><input name="subject" value="" type="text" class="suInpTxt" /></div>
                <div class="clearfloat"></div>
            </div><!-- end of class suMain -->
            <div class="suMain">
                <div class="suColL">Country:</div>
                <div class="suColR">
                        <?php echo generateCountrySelect($_POST['country']) ?>
                </div>
                <div class="clearfloat"></div>
            </div><!-- end of class suMain -->
            <div class="suMain">
                <div class="suColL">E-mail ID:</div>
                <div class="suColR"><input name="email" value="" type="text" class="suInpTxt" /><br /></div>
                <div class="clearfloat"></div>
            </div><!-- end of class suMain -->
            <div class="suMain">
                <div class="suColL">Address</div>
                <div class="suColR"><input name="address" value="<?php echo $_POST['address']?>" type="text" class="suInpTxt" /><br /></div>
                <div class="clearfloat"></div>
            </div><!-- end of class suMain -->
            <div class="suMain">
                <div class="suColL">Comment:</div>
                <div class="suColR">
                    <textarea name="comment" rows="4" cols="50"><?php echo $_POST['comment']?></textarea>
                </div>
                <div class="clearfloat"></div>
            </div><!-- end of class suMain -->
            <div class="suMain">
                <div class="suColL"></div>
                <div class="suColR">
                    <img src="<?php //echo SITE_FRONT_URL?>includes/CaptchaSecurityImages.php?height=30&width=150&characters=5"/>
                </div>
                <div class="clearfloat"></div>
            </div><!-- end of class suMain --> 
            <div class="suMain">
                <div class="suColL">Enter Security Key:</div>
                <div class="suColR">
                    <input type="text" name="captcha_key" value=""  class="suInpTxt"/>
                </div>
                <div class="clearfloat"></div>
            </div> 
            <div class="suMain">
                <div class="suColL">&nbsp;</div>
                <div class="suColR"><input name="" type="image" src="images/but-submit.gif" /></div>
                <div class="clearfloat"></div>
            </div><!-- end of class suMain -->
        </form>
    </div>
    <!-- signup ends -->
    <?php 
    //echo 'here';
    //print_r($_SESSION);
    ?>
