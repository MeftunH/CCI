<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <title>{{trans('mail.newsletter')}}</title>
    <style type="text/css">
        html {
            width: 100%;
        }

        ::-moz-selection {
            background: #fefac7;
            color: #4a4a4a;
        }

        ::selection {
            background: #fefac7;
            color: #4a4a4a;
        }

        body {
            margin: 0;
            width: 100%;
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
            background-color: #f1f1f1;
        }

        .ExternalClass {
            width: 100%;
            background-color: #f1f1f1;
        }

        a {
            color: #ffcccc;
            text-decoration: none;
            font-weight: normal;
            font-style: normal;
        }

        p,
        div,
        span {
            margin: 0 !important;
        }

        table {
            border-collapse: collapse;
        }

        @media only screen and (max-width: 599px) {
            body {
                width: auto !important;
            }

            table table {
                width: 100% !important;
            }

            td.paddingOuter {
                width: 100% !important;
                padding-right: 20px !important;
                padding-left: 20px !important;
            }

            td.fullWidth {
                width: 100% !important;
                display: block !important;
                float: left;
                margin-bottom: 30px !important;
            }

            td.fullWidthNM {
                width: 100% !important;
                display: block !important;
                float: left;
                margin-bottom: 0px !important;
            }

            td.center {
                text-align: center !important;
            }

            td.right {
                text-align: right !important;
            }

            td.spacer {
                display: none !important;
            }

            img.scaleImg {
                width: 100% !important;
                height: auto;
            }
        }
    </style>

</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#eee7e7"
       style="padding: 0; margin: 0;">
    <tr>
        <td align="center" width="700" valign="top">
            <!-- Pre header, display none if preferred - add view online link here if required-->
            <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f3f3f4"
                   style="padding: 0; margin: 0;">
                <tr>
                    <td class="paddingOuter" valign="top" align="center" style="padding: 10px 0px;">
                        <table class="tableWrap" width="640" border="0" align="center" cellpadding="0" cellspacing="0"
                               style="">
                            <tr>
                                <td style="padding: 0px;">
                                    <table class="tableInner" width="640" border="0" align="center" cellpadding="0"
                                           cellspacing="0">
                                        <tr>
                                            <td class="fullWidthNM" width="640" align="left" valign="top"
                                                style="padding: 0;">
                                                <table width="100%" align="left" border="0" cellpadding="0"
                                                       cellspacing="0">
                                                    <tr>
                                                        <td class="center" align="center" valign="top"
                                                            style="margin: 0; padding-bottom: 0; font-size:13px; font-weight: normal; color:#373737; font-family: Garamond, Baskerville, 'Baskerville Old Face', 'Hoefler Text', 'Times New Roman', serif; line-height: 23px;  mso-line-height-rule: exactly;">
                                                                <span>
                                                                {{trans('email.newsletter')}}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- Pre-header End-->


            <!-- Promotional blog - Can be used for sale, blog or similar -->
            @foreach($posts as $post)
                <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff"
                       style="padding: 0; margin: 0; ">
                    <tr>
                        <td class="paddingOuter" valign="top" align="center" style="padding: 0px;">
                            <table class="tableWrap" width="640" border="0" align="center" cellpadding="0"
                                   cellspacing="0" style="">
                                <tr>
                                    <td style="padding: 0px;">
                                        <table class="tableInner" width="640" border="0" align="center" cellpadding="0"
                                               cellspacing="0">
                                            <tr>
                                                <!-- Image section -->
                                                <td class="fullWidthNM" width="390" align="left" valign="top"
                                                    style="padding: 0;">
                                                    <table width="100%" align="left" border="0" align="center"
                                                           cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td align="center" valign="top"
                                                                style="margin: 0; padding-bottom: 0; font-size:14px ; font-weight: normal; color:#9a9a9a; font-family: 'Poppins', Helvetica, Arial, sans-serif; line-height: 0;">
                                                                <span>
                                <a href="#" style="text-decoration: none; font-style: normal; font-weight: normal;">
                                <img class="scaleImg" src="{{$message->embed(asset($post->image))}}" alt="Man on hill" width="390" height="300"
                                     style="display: block;"/>
                                </a>
                              </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <!-- Image section end-->
                                                <!-- Text section-->
                                                <td class="fullWidthNM" bgcolor="#f3f3f4" width="250" align="left"
                                                    valign="top" style="padding:0;">
                                                    <table width="100%" align="left" border="0" cellpadding="0"
                                                           cellspacing="0">
                                                        <tr>
                                                            <td align="center" valign="middle"
                                                                style="padding: 30px 20px;">
                                                                <table width="100%" align="left" border="0"
                                                                       cellpadding="0" cellspacing="0">
                                                                    <!-- Pre-header for section-->
                                                                    <tr>
                                                                        <td align="center" valign="top"
                                                                            style="margin: 0; padding-bottom: 5px; font-size:14px ; font-weight: normal; color:#373737; font-family: Garamond, Baskerville, 'Baskerville Old Face', 'Hoefler Text', 'Times New Roman', serif; line-height: 24px;  mso-line-height-rule: exactly;">

                                                                        </td>
                                                                    </tr>
                                                                    <!-- End pre-header for section-->

                                                                    <!-- Block header -->
                                                                    <tr>
                                                                        <td align="center" valign="top"
                                                                            style="margin: 0; padding-bottom: 8px; text-transform: uppercase; font-size:24px ; font-weight: 300; color:#000000; line-height: 34px;  mso-line-height-rule: exactly;">
                                                                            <span>
                                     {{$post->title}}
                                    </span>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- End block header-->
                                                                    <!-- Smaller information-->
                                                                    <!-- End smaller information-->
                                                                    <!-- CTA -->
                                                                    <tr>
                                                                        <td class="center" align="center" valign="top"
                                                                            style="padding-top: 20px; ">
                                                                            <table border="0" align="center"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="margin: 0;">
                                                                                <tr>
                                                                                    <td class="txt" align="center"
                                                                                        valign="middle">
                                                                                        <span>
                                            <a href="{{route('news.read_more',$post->news_id)}}"
                                               style="text-decoration: none; font-style: normal; font-weight: 500; color:#373737;">
                                           {{trans('back.read_more')}}
                                            </a>
                                          </span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- CTA end -->
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <!-- Text section end-->
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!-- End Blog/Sale Box -->
                <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff"
                       style="padding: 0; margin: 0; ">
                    <tr>
                        <td class="paddingOuter" align="center" valign="top" align="center">
                            <table class="tableWrap" width="640" border="0" align="center" cellpadding="0"
                                   cellspacing="0">
                                <tr>
                                    <td align="center" height="30" style="padding:0; line-height: 0;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!-- Spacer end-->
            @endforeach
            <a href="{{route('subscriber.destroy',['token' => $subscriber->token])}}">{{trans('mail.unsubscribe')}}</a>


            <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff"
                   style="padding: 0; margin: 0; ">
                <tr>
                    <td class="paddingOuter" align="center" valign="top" align="center">
                        <table class="tableWrap" width="640" border="0" align="center" cellpadding="0"
                               cellspacing="0">
                            <tr>
                                <td align="center" height="30" style="padding:0; line-height: 0;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<style type="text/css">
    .txt {
        border: 1px solid #373737;
        display: block;
        padding: 12px 20px;
        text-transform: uppercase;
        font-weight: 500;
        font-size: 14px;
        line-height: 100%;
        font-family: Lato, Helvetica Neue, Helvetica, Arial, sans-serif;
        color: #373737;
        margin: 0 !important;
        mso-line-height-rule: exactly;
    }
</style>

</body>
</html>
