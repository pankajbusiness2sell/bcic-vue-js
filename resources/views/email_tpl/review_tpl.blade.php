<!-- resources/views/emails/feedback.blade.php -->
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title>feedback</title>
 
  <style>
    *{
        box-sizing: border-box;
    }
    img:hover {opacity: .6;}
    img {
      border: none;
      -ms-interpolation-mode: bicubic;
      max-width: 100%; 
    }

    body {
      background-color: #eaebed;
      font-family: sans-serif;
      -webkit-font-smoothing: antialiased;
      font-size: 14px;
      line-height: 1.4;
      margin: 0;
      padding: 0;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%; 
    }
    .offer-wrap {display: inline-block; height: 200px;}
    .offer-sec {width: 50%;}
    .offer-img {width: 50%;}
    table, td, div, h1, p {font-family: Arial, sans-serif;}
    @media only screen and (max-width: 480px) {
        .offer-wrap {height: auto; padding-bottom: 15px;}
        p {
            font-size: 14px!important;
        }
        .offer-sec  {
            width: 100%!important;
            padding: 15px!important;
            float: left;
            text-align: center;
        }
        .offer-sec h1 {
            font-size: 22px!important;
        }
        .offer-img {
            width: 100%!important;
            float: left;
            text-align: center;
        }
        .container {
            width: 100%!important;
        }
    }
  </style>
</head>
<body style="margin:0;padding:0;">
  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
      <td align="center" style="padding:0;">
        <table class="container" role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
          <tr>
            <td align="left" style="padding:15px 30px;background:#13bf7c;">
              <a href="https://www.bcic.com.au/"><img src="https://www.bcic.com.au/admin/crons/crons_tpl/review_tpl/logo.png" alt="" width="150" style="height:auto;display:block;" /></a>
            </td>
          </tr>
          <tr>
            <td >
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0; ">
                <tr>
                  <td colspan="2" style="padding:36px 30px 20px 30px;color:#153643;">
                    <p style="margin:0 0 6px 0;font-size:16px;line-height:24px;font-family:calibri,sans-serif;">Hello {{ ucfirst($name) }},</p>
                    <p style="margin:0 0 6px 0;font-size:16px;line-height:24px;font-family:calibri,sans-serif;">{!! $getEmailTpl !!}.</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:30px 20px;background:#337ab7;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:calibri,sans-serif;">
                <tr>
                 
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
