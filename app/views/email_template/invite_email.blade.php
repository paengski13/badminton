<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Samahang Pinoy Racqueteers</title>

        <!-- Meta -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <style type="text/css">
            .ReadMsgBody {width: 100%; background-color: #ffffff;}
            .ExternalClass {width: 100%; background-color: #ffffff;}
            body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
            table {border-collapse: collapse;}
            
            @media only screen and (max-width: 640px)  {
                            body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                            body[yahoo] .center {text-align: center!important;}  
                    }
                    
            @media only screen and (max-width: 479px) {
                            body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                            body[yahoo] .center {text-align: center!important;}  
                    }
        </style>
    </head>
    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

        <!-- Wrapper -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
                <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">
                    
                    <!--Start Header-->
                    <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                        <tr>
                            <td style="padding: 6px 0px 0px">
                           </td>
                        </tr>
                    </table> 
                    <!--End Header-->

                    <!-- Start Headliner-->
                    <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                        <tr>
                            <td valign="top" style="padding: 0px " class="center">
                                <a href="{{ URL::to('login') }}"><img class="deviceWidth" src="{{ URL::to('assets/img/email_template/headliner/headliner_invite.jpg') }}"></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                We are honoured to invite you to be part of SPaRtans (Samahang Pinoy Racqueteers) badminton group.<br/>
                                <a href="{{ URL::to('confirm_invite/' . $data['user_key']) }}">Click here</a> to proceed with the registration.
                           </td>
                        </tr>
                    </table>
                    <!-- Start Headliner-->

                    <!-- Features Introduction -->
                    <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                        <tr>
                            <td width="100%" bgcolor="#ffffff">
                                <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                    <tr>
                                        <td class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            We are still on the process of brewing the awesomeness of the website to make it as friendly and interactive as possible. Please take a look some of the features available in our website.
                                       </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- End Features Introduction -->

                    <!-- Features -->
                    <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                        <tr>
                            <td width="100%" bgcolor="#f7f7f7">
                                <!--Right box-->
                               <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/spartan_profile.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px;">
                                            Member's Profiles
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            Allow members to update their own profiles:<br/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&#8226; Personal information<br/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&#8226; Contact and Emergency<br/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&#8226; Past tournament results<br/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&#8226; Payments history and Debts<br/>
                                            We only keep necessary information for our group.
                                        </td>
                                    </tr>
                                </table> 
                                <!--End left box--> 
                                
                                <!-- Left box  -->
                                <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/reservation.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px 0;">
                                            Fun Game Reservation
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            Reservation of slot for Sunday fun games is not fun at all. We added to the sytem where you can reserve a slot for you and your brothers and sisters SPaRtans on your behalf as easy as possible.
                                        </td>
                                    </tr>
                                </table>
                                <!--End left box-->    
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="100%" bgcolor="#f7f7f7">
                                <!--Right box-->
                                <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/event.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px;">
                                            Events
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            All events are special if it is organized by SParTans! :)<br/>
                                            Everyone are allowed to post an event provided that it is approved by any SPartan Committee<br/>
                                            Joining an event is as easy as ahoo ahoo! 
                                        </td>
                                    </tr>
                                </table>
                                <!--End left box--> 
                                
                                <!-- Left box  -->
                                <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/payment.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px 0;">
                                            Payments
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            paid already ah? You can attach payment transaction once you settle any transaction made by you to SPaRtan Committee and update the status to Paid.<br/>
                                        </td>
                                    </tr>
                                </table>
                                <!--End left box-->    
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="100%" bgcolor="#f7f7f7">
                                <!--Right box-->
                               <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/birthday.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px;">
                                            Birthday Greetings
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            SParTan celebrates each member's birthday with a bang! You will no longer be forgotten :D<br/>
                                            We will greet you before anyone else does.
                                        </td>
                                    </tr>
                                </table>
                                <!--End left box--> 
                                
                                <!-- Left box  -->
                                <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/announcement.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px 0;">
                                            News & Announcements
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            Whether it is news update of on-going tournament, future event, survey or any related announcements. You will be informed and notified!
                                        </td>
                                    </tr>
                                </table>
                                <!--End left box-->    
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="100%" bgcolor="#f7f7f7">
                                <!--Right box-->
                               <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/video.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px;">
                                            Videos
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            "Da moves", share your replays or video clip that will get a standing ovation. :P<br/>
                                            We have a limited space, therefore please upload your video to youtube, and we will reflect it to our website.
                                        </td>
                                    </tr>
                                </table>
                                <!--End left box-->   
                                
                                <!-- Left box  -->
                                <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/photo.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px 0;">
                                            Photos
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            Picture is worth a thousand words, share it to us by uploading it to our website
                                        </td>
                                    </tr>
                                </table>
                                <!--End left box-->    
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="100%" bgcolor="#f7f7f7">
                                <!--Right box-->
                               <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/tournament.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px;">
                                            Tournaments
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            This is where we showcase what we trained and strive hard for. You can register together with your partner in the category you desire! goodluck! 
                                        </td>
                                    </tr>
                                </table>
                                <!--End left box-->   
                                
                                <!-- Left box  -->
                                <table width="40%"  border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                    <tr>
                                        <td valign="top" style="padding: 40px 20px " class="center">
                                            <img width="300" hight="170" src="{{ URL::to('assets/img/email_template/feedback.jpg') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #303030; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px 0;">
                                            Feedback
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            Innovation and Change! That's how we grow, send us your feedback on how we can improve our gladiatorial school ahem website! Your name will be a history for what have you contributed! Gratitude!
                                        </td>
                                    </tr>
                                </table>
                                <!--End left box-->    
                            </td>
                        </tr>
                    </table>
                    <!-- End Features -->
                    
                    <div style="height:15px">&nbsp;</div><!-- divider -->
                    
                    <!-- Features Introduction -->
                    <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                        <tr>
                            <td width="100%" bgcolor="#ffffff">
                                <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                    <tr>
                                        <td class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                            We are expanding and will conquer Rome!<br/>
                                            We are planning to expand our group into a community, the forum for Filbadcom is on the way!<br/>
                                            Please support us to make it happen by being proactive! :)
                                       </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- End Features Introduction -->

                    <!-- Media Contacts -->
                    <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                        <tr>
                            <td width="100%" bgcolor="#a5d1da" class="center">
                                <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                    <tr>
                                        <td valign="top" style="padding: 20px 10px " class="center">
                                            <img width="32" hight="32" src="{{ URL::to('assets/img/email_template/icons/icon_facebook.png') }}">
                                        </td>
                                        <td valign="top" style="padding: 20px 10px " class="center">
                                            <img width="32" hight="32" src="{{ URL::to('assets/img/email_template/icons/icon_youtube.png') }}">
                                        </td>
                                    </tr>
                                </table>
                                <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                    <tr>
                                        <td class="center" style="font-size: 16px; color: #ffffff; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 0px 10px; ">
                                            Stay Connected With Us                            
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- Media Contacts -->

                    <!-- Footer -->
                    <table width="700"  border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth"  > 
                        <tr>
                            <td  bgcolor="#ffffff" class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 50px 0px 50px; " >
                                Copyright © SParTans 2015
                            </td>
                        </tr>
                        </tr>
                    </table>
                    <!--End Footer-->
                </td>
            </tr>
        </table> 
        <!-- End Wrapper -->
    </body>
</html>