<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <body style="margin:5rem;padding:0;">
        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
            <tr>
                <td align="center" style="padding:0; position: relative">
                   <img  src="{{asset('images/email-photo.png')}}" alt="">
                   <h1>{{$msg}}</h1>
                   <p>{{$clickMessage}}</p>

                   <a href="{{$url}}" style="text-decoration: none; color:white; background-color:lightgreen; padding: 1rem 5rem; margin-top: 15px; border-radius: 12px;">{{$buttonText}}</a>
                </td>
            </tr>
        </table>
    </body>
</html>