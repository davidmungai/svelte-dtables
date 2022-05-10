<?php

/**
 * Created by PhpStorm.
 * User: Allan
 * Date: 11/10/2018
 * Time: 11:08
 */

require('app/Loader.php');
require_once('vendor/autoload.php');

use app\application\library\commonFunctions;
use application\model\DbConnection;

$dbh = DbConnection::getInstance();

$fnc = new commonFunctions();
const log_file = "research_email.log";
//get all clients affected
try {

    $query = "SELECT allnames, e_mail, member_no FROM members WHERE CONFIRMED = 1 and e_mail is not null  order by member_no asc ";
    $sth = $dbh->dbConn->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_OBJ);


    //var_dump($result);
    //$url1 = "https://www.sanlam.com/kenya/about/resultsandreports/Documents/Unit%20Trusts%20Annual%20Report%202018.pdf";
    //$url2 = "mailto:gaurang.chavda@sanlameastafrica.com?subject=AGM Confirmation";

    //$body1 = "Kindly find attached the Sanlam Investments East Africa Market Update for October 2019.";
    //$body2 = "Our Pesa+ Money Market Fund is now at 9.88% p.a as at 3rd October 2019.";
    //$body3 = "Please note the Sanlam Unit Trust Collection office has relocated to 1st Floor Sanlam House, Kenyatta Avenue.";
    //$bold = "Financial planning & How to grow your wealth in a pandemic environment session";
    //$body1="Kindly find attached the Sanlam Investments East Africa Market Research for December 2020.";
    //$body1="Sanlam Unit Trust takes this opportunity to We wish you a Happy Easter weekend.";
    $body1 = "";

    //$body2="Top up now with us through our Mpesa Paybill No 888111 or our Bank details as below:-";
    $body2 = "";
    //$body3="Bank - Stanbic";
    $body3 = "";
    //$body4 = "Account Name - Sanlam Unit Trust";
    $body4 = "";
    //$body5 = "Account Number - 0100003738118";
    $body5 = "";
    //$body6 = "Branch - Kenyatta Avenue ";
    $body6 = "";
    $body7 = "";

    //$body10="For any questions or queries contact us on clientservice@sanlameastafrica.com or 0719 067000";

    //'Email us if you have any questions or queries: - clientservice@sanlameastafrica.com';
    // "If you no longer wish to receive this report in future, you may unsubscribe.";

    foreach ($result as $item) {

        //$salutation = "Dear Valued Client";   //$item->allnames;
        $member_no = $item->member_no;
        //echo $member_no;
        $token = $fnc->generateRandomToken(20);
        $url = "http://client.sanlameastafrica.com/public/unsubscribe?token=$token";
        $body10 = '<a href=' . $url . ' target="_blank">you may unsubscribe here</a>';
        $message_body = "

                <tr>
                    <td>
                        <p style='font-size: 12pt; font-family:Garamond,Baskerville,Baskerville Old Face,Hoefler Text,Times New Roman,serif; color:#1f64ad;'>  " . ucwords(strtolower($salutation)) . " </p>

                        <p style = 'font-size:12pt; font-family:Garamond,Baskerville,Baskerville Old Face,Hoefler Text,Times New Roman,serif; color:#1f64ad;' > " . $body1 . "</p >
                         <p style = 'font-size:12pt; font-family:Garamond,Baskerville,Baskerville Old Face,Hoefler Text,Times New Roman,serif; color:#1f64ad;' > " . $body2 . "</p>
          </td>
                  </tr>


                 <tr>
    <td align='left'>
           <img src='Happy-Holidays---SIEAL-Client.jpg' width='60%' height='80%'>
        </td>
    </tr>
        <tr>
        </tr>


    </tr>
        <tr>
        <td>
                <p style = 'font-size:12pt; font-family:Garamond,Baskerville,Baskerville Old Face,Hoefler Text,Times New Roman,serif; color:#1f64ad;' > <br>
                        <br>

                        </p>
                </td>
        </tr>

                                ";
        try {
            $mailer = new PHPMailer();


            $mailer->SMTPDebug = false;
            $mailer->isSMTP();
            $mailer->SMTPAuth = true;
            $mailer->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mailer->Username = 'uts@sanlameastafrica.com';
            $mailer->Password = '$Kuh!F@dh!B0r@$';
            $mailer->Host = 'smtp.office365.com';
            $mailer->SMTPSecure = 'tls';
            $mailer->Port = (int)587;
            //$mailer->addAddress('uts@sanlameastafrica.com');
            $mailer->setFrom('uts@sanlameastafrica.com', 'Sanlam Investments East Africa Ltd');
            //$mailer->AddEmbeddedImage('Happy-Holidays---SIEAL-Client\'s-Card.jpg', 'logo');
            //client email
            $member_email = trim($item->e_mail);
            $member_email = preg_replace('/\s+/', '', $member_email);

            foreach (explode(';', $member_email) as $email) {
                $mailer->addAddress($email);
                //$mailer->addAddress('prestone@wizglobal.co.ke');
                //$mailer->addAddress('lawrence.itotia@sanlameastafrica.com');
                //$mailer->addAddress('gaurang.chavda@sanlameastafrica.com');
                //$mailer->addAddress('gaura70@yahoo.com');
                //$mailer->addAddress('gaura79@gmail.com');;
                //echo $email;

            }

            $mailer->Subject = "Merry Christmas and a Prosperous New Year";
            $mailer->msgHTML($message_body);
            $mailer->WordWrap = 20;
            //$mailer->addAttachment("Audited Financial Statements - SIEAL 2018.pdf");
            //$mailer->addAttachment("Sanlam Investments East Africa - December update.pdf");

            $send = $mailer->send();


            if ($send) {
                $Qry = "INSERT INTO subscriptions(member_no, plan_id, subscription_status,created_at, updated_at, token)
                                        VALUES (:member_no, 1,1,CURRENT_TIMESTAMP , CURRENT_TIMESTAMP ,:token)";
                $sth = $dbh->dbConn->prepare($Qry);
                $sth->bindParam(":member_no", $member_no);
                $sth->bindParam(":token", $token);
                $sth->execute();

                $mailer->clearAllRecipients();
                $mailer->clearAttachments();
                $mailer->ClearBCCs();
                echo "Email successfully send";
                $message = "Time " . date('l, Y-m-d h:i:s') . "\r\n";
                $message .= "................................................................................................\r\n";
                $message .= $mailer->Debugoutput = 'html' . " Email successfully send for member number " . $member_no . " \r\n";
                $message .= "................................................................................................\r\n";
            } else {
                $mailer->clearAllRecipients();
                $mailer->clearAttachments();
                $mailer->ClearBCCs();
                echo "Error sending mail \n";
                $message = "Time " . date('l, Y-m-d h:i:s') . "\r\n";
                $message .= "................................................................................................\r\n";
                $message .= $mailer->Debugoutput = 'html' . " Error sending mail for member number " . $member_no . "  \r\n";
                $message .= "................................................................................................\r\n";
            }
        } catch (phpmailerException $m) {
            $mailer->clearAllRecipients();
            $mailer->clearAttachments();
            $mailer->ClearBCCs();
            $message = "Time " . date('l, Y-m-d h:i:s') . "\r\n";
            $message .= "................................................................................................\r\n";
            $message .= $mailer->Debugoutput = 'html' . " Error sending mail for member number " . $member_no . "  \r\n";
            $message .= "................................................................................................\r\n";
            $message .= $m->getMessage() . " Error sending mail for member number " . $member_no . " \r\n";
            $message .= "................................................................................................\r\n";
        }

        file_put_contents(log_file, $message . "\r\n", FILE_APPEND);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
