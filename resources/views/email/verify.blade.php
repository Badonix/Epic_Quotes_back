<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>

<body style='background: #181623; padding-right: 5%;'>
    <div style="width: 100%; background: #181623; padding-left: 5%; padding-right: 5%; color:white; padding-top:100px;"
        class='body'>
        <div
            style="position: absolute;top:20px; left:50%; transform: translateX(-50%); display:flex; justify-content:center; align-items:center; flex-direction:column;">
            <img style="width: 22px; margin: 0 auto;"
                src="https://www.linkpicture.com/q/Movie-quotes-Desktop-movie-quotes-Vector.png" />
            <h1
                style="font-family: 'Open Sans', sans-serif; margin-top:5px; text-align:center; font-size:12px; color: #DDCCAA; margin: 0 auto;">
                MOVIE QUOTES</h1>
        </div>
        <p style="font-family: 'Open Sans', sans-serif;">Hola {{ $username }}!</p>
        <p style="font-family: 'Open Sans', sans-serif;">Thanks for joining Movie quotes! We really appreciate it.
            Please click the button below to verify your
            account:
        </p>
        <a style="        
    display: block;
    padding-top: 7px;
    padding-bottom: 7px;
    padding-left: 13px;
    padding-right: 13px;
    background-color: #E31221;
    color: #ffffff;
    font-weight: 700;
    font-size: 16px;
    text-align: center;
    width: 128px;
    border-radius: 4px;
    cursor: pointer;
    border: none;
    text-decoration: none;
    "
            href="{{ $url }}">Verify account</a>
        <p style="font-family: 'Open Sans', sans-serif;">If clicking doesn't work, you can try copying and pasting it to
            your browser:</p>
        <p style="color: #DDCCAA;font-family: 'Open Sans', sans-serif;">{{ $url }}</p>
        <p style="font-family: 'Open Sans', sans-serif;">If you have any problems, please contact us:
            support@moviequotes.ge</p>
        <p style="font-family: 'Open Sans', sans-serif;">MovieQuotes Crew</p>
    </div>

</body>

</html>
