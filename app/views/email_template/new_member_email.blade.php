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
                                <a href="{{ URL::to('login') }}"><img class="deviceWidth" src="{{ URL::to('assets/img/email_template/headliner/headliner_new_member.jpg') }}"></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="center" style="font-size: 12px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px; " >
                                Please welcome our new Samahang Pinoy Racqueteers member {{ $data['user_fullname'] }}<br/>
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