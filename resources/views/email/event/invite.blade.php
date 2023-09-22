<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <title>{{ $event->event_title }} etkinliğine davet edildiniz | PwC Alumni</title>

    <style type="text/css">

        body{width: 100%; background-color: #f0f3f8; margin:0; padding:0; -webkit-font-smoothing: antialiased;mso-margin-top-alt:0px; mso-margin-bottom-alt:0px; mso-padding-alt: 0px 0px 0px 0px;}

        p,h1,h2,h3,h4{margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0;}

        span.preheader{display: none; font-size: 1px;}

        html{width: 100%;}

        table{font-size: 12px;border: 0;}

        .menu-space{padding-right:25px;}

        a,a:hover { text-decoration:none; color:#FFF;}


        @media only screen and (max-width:640px)

        {
            body{width:auto!important;}
            table[class=main] {width:440px !important;}
            table[class=two-left] {width:420px !important; margin:0px auto;}
            table[class=full] {width:100% !important; margin:0px auto;}
            table[class=alaine] { text-align:center;}
            table[class=menu-space] {padding-right:0px;}
            table[class=banner] {width:438px !important;}
            table[class=menu] {width:438px !important; margin:0px auto; border-bottom:#e1e0e2 solid 1px;}
            table[class=date] {width:438px !important; margin:0px auto; text-align:center;}
            table[class=two-left-inner] {width:400px !important; margin:0px auto;}
            table[class=menu-icon] { display:block;}
            table[class=two-left-menu] {text-align:center;}
            .external-button {
                padding: 10px 20px;
            }
        }

        @media only screen and (max-width:479px)
        {
            body{width:auto!important;}
            table[class=main]  {width:310px !important;}
            table[class=two-left] {width:300px !important; margin:0px auto;}
            table[class=full] {width:100% !important; margin:0px auto;}
            table[class=alaine] { text-align:center;}
            table[class=menu-space] {padding-right:0px;}
            table[class=banner] {width:308px !important;}
            table[class=menu] {width:308px !important; margin:0px auto; border-bottom:#e1e0e2 solid 1px;}
            table[class=date] {width:308px !important; margin:0px auto; text-align:center;}
            table[class=two-left-inner] {width:280px !important; margin:0px auto;}
            table[class=menu-icon] { display:none;}
            table[class=two-left-menu] {width:310px !important; margin:0px auto;}


        }
    </style>

</head>

<body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!--Main Table Start-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f0f3f8">
    <tr>
        <td align="center" valign="top">

            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                            <tr>
                                <td height="60" align="center" valign="top" style="font-size:60px; line-height:60px;">&nbsp;</td>
                            </tr>
                        </table></td>
                </tr>
            </table>

            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                            <tr>
                                <td align="center" valign="top" style="background:#FFF;"><table width="295" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td height="55" align="center" valign="top" style="font-size:55px; line-height:55px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top"><table width="110" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td align="center" valign="top"><a href="#"><img src="https://www.pwc.com.tr/tr/mail/assets/alumni-site-logo-new.jpg" width="220" height="auto" alt="" /></a></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                        <tr>
                                            <td height="40" align="center" valign="top" style="font-size:40px; line-height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top"><table width="85" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td height="85" align="center" valign="middle" style="border-bottom:4px solid #7d7d7d"><img mc:edit="tm2-02" editable="true" src="https://www.pwc.com.tr/tr/mail/assets/etkinlik-icon-2.png" width="50" height="50" alt="" /></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                        <tr>
                                            <td height="40" align="center" valign="top" style="font-size:40px; line-height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:22px; color:#4b4b4c; line-height:30px; font-weight:normal;">Merhaba {{ $user->name }},</td>
                                        </tr>
                                        <tr>
                                            <td height="40" align="center" valign="top" style="font-size:40px; line-height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:30px; color:#4b4b4c; line-height:30px; font-weight:bold;">{{ $event->event_title }}</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:13px; color:#ff0000; line-height:22px; font-weight:normal;"><div class="external-button">etkinliğine davetlisiniz.</div></td>
                                        </tr>
                                        <!-- Etkinlik Lokasyon detay -->
                                        <tr>
                                            <td align="center" valign="top"><table width="500" border="0" cellspacing="0" cellpadding="0" class="two-left-inner">
                                                    <tbody><tr>
                                                        <td align="center" valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="top"><table width="80%" border="0" cellspacing="0" cellpadding="0">
                                                                <tbody><tr>
                                                                    <td width="200" align="right" valign="top" class="two-left"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
                                                                            <tbody><tr>
                                                                                <td align="right" valign="top"><table width="200" border="0" align="right" cellpadding="0" cellspacing="0">
                                                                                        <tbody><tr>
                                                                                            <td width="45" align="left" valign="top"><img editable="true" mc:edit="tm15-05" src="https://www.pwc.com.tr/tr/mail/assets/location.png" width="29" height="32" alt=""></td>
                                                                                            <td width="200" align="right" valign="top"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
                                                                                                    <tbody><tr>
                                                                                                        <td align="left" valign="top" style="font-family:'Open Sans', Verdana, Arial; font-size:16px; font-weight:bold; color:#242322;" mc:edit="tm15-06"><multiline>Etkinlik Yeri</multiline></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td height="5" align="left" valign="top" style="font-size:5px; line-height:5px;">&nbsp;</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td align="left" valign="top" style="font-family:'Open Sans', Verdana, Arial; font-size:12px; font-weight:normal; color:#666; line-height:24px;" mc:edit="tm15-07"><multiline>{{ $event->event_venue }}</multiline></td>
                                                                                                    </tr>
                                                                                                    </tbody></table></td>
                                                                                        </tr>
                                                                                        </tbody></table></td>
                                                                            </tr>


                                                                            <tr>
                                                                                <td align="left" valign="top">&nbsp;</td>
                                                                            </tr>
                                                                            </tbody></table></td>
                                                                    <td width="200" align="left" valign="top" class="two-left"><table width="200" border="0" align="left" cellpadding="0" cellspacing="0">
                                                                            <tbody><tr>
                                                                                <td width="45" align="left" valign="top"><img editable="true" mc:edit="tm15-08" src="https://www.pwc.com.tr/tr/mail/assets/date.png" width="32" height="32" alt=""></td>
                                                                                <td width="200" align="left" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                                                                        <tbody><tr>
                                                                                            <td align="left" valign="top" style="font-family:'Open Sans', Verdana, Arial; font-size:16px; font-weight:bold; color:#242322;" mc:edit="tm15-09"><multiline>Etkinlik Tarihi</multiline></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="5" align="left" valign="top" style="font-size:5px; line-height:5px;">&nbsp;</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="left" valign="top" style="font-family:'Open Sans', Verdana, Arial; font-size:12px; font-weight:normal; color:#666; line-height:24px;" mc:edit="tm15-10"><multiline>{{ $event->event_start_date->format('d/m/Y H:i') }} <br /> {{ $event->event_end_date->format('d/m/Y H:i') }}</multiline></td>
                                                                                        </tr>
                                                                                        </tbody></table></td>
                                                                            </tr>
                                                                            </tbody></table></td>

                                                                </tr>
                                                                </tbody></table></td>
                                                    </tr>
                                                    </tbody></table></td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:13px; color:#71746f; line-height:22px; font-weight:normal; padding-left: 15px; padding-right: 15px"><div class="external-button">Etkinliğe katılım durumunuzu bildirimek ve etkinlik detaylarını görüntülemek için aşağıdaki butonu tıklayarak etkinlik sayfamızı inceleyebilirsiniz.</div></td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top"><table width="180" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td height="30" align="center" valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td height="60" align="center" valign="middle" style="background:#d04a02; -moz-border-radius: 10px; border-radius: 10px; font-family:'Open Sans', Verdana, Arial; font-size:14px; font-weight:bold; color:#FFF; "><a class="external-button" href="{{ route('events.show', $event->event_seo_url) }}" style="text-decoration:none; color:#FFF;">Etkinlik Detay</a></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                        <!-- Etkinlik Lokasyon detay -->
                                        <tr>
                                            <td height="30" align="center" valign="top" style="font-size:30px; line-height:30px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:10px; color:#71746f; line-height:22px; font-weight:normal;">PwC Türkiye Alumni LinkedIn grubumuza henüz katılmadıysanız aşağıdaki linke tıklayarak katılabilirsiniz.</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top"><table width="85" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td align="center" valign="top"><a href="https://www.linkedin.com/groups/9018311/"><img src="https://www.pwc.com.tr/tr/mail/assets/follow_linkedin.png" width="22" height="22" alt="" /></a></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                        <tr>
                                            <td height="55" align="center" valign="top" style="font-size:55px; line-height:55px;">&nbsp;</td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                </tr>
            </table>

            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                            <tr>
                                <td align="center" valign="top"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td height="40" align="center" valign="top" style="font-size:40px; line-height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:12px; color:#4b4b4c; line-height:30px; font-weight:normal;"> &copy; {{ date('Y') }} PwC Türkiye.</td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:13px; color:#4b4b4c; line-height:20px; font-weight:bold;"><div class="external-button">Tüm hakları saklıdır. Bu belgede PwC ifadesi, PwC ağını veya PwC ağının üyesi olan bağımsız ve farklı tüzel kişiliklerden oluşan PwC Türkiye'yi ifade etmektedir.</div></td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="font-family:'Open Sans', sans-serif, Verdana; font-size:12px; color:#4b4b4c; line-height:30px; font-weight:bold;"><div class="external-button">PwC Danışmanlık Hizmetleri A.Ş. | Mersis no: 0-7330-4313-3900028</div></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                </tr>
            </table>

            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                            <tr>
                                <td height="55" align="center" valign="top" style="font-size:55px; line-height:55px;">&nbsp;</td>
                            </tr>
                        </table></td>
                </tr>
            </table>

        </td>
    </tr>
</table>

<!--Main Table End-->

</body>
</html>
