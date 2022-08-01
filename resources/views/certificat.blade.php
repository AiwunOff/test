<!DOCTYPE html>
<html>

<head>
    <title>Hi</title>

    <style>
        .bodyCertificat {
            position: absolute;
            top: 0;
            left: 0;
            width: 29.7cm;
            height: 21cm;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: flex-start;
            color: black;
            font-family: sans-serif;
            /* line-height: 24px; */
        }        
        
        .containerCertificat {
            width: 29.7cm;
            height: 21cm;
            margin: 0;
            padding: 0;
            position: absolute;
            top: 0;
            left: 0;
            color: black;
            font-family: sans-serif;
        }

        h2 {
            width: 100%;
            font-size: 24px;
            text-align: center;
            margin-top: 200px;
            margin-bottom: 0;
        }

        h3 {
            width: 100%;
            font-size: 20px;
            /* font-weight: bold; */
            text-align: center;
            margin-top: 25px;
            margin-bottom: 0;
            padding: 0 10%;
        }

        h1 {
            width: 80%;
            margin-left: 10%;
            font-size: 28px;
            line-height: 30px;
            text-align: center;
            color: #dd1111;
            margin-top: 80px;
            margin-bottom: 0;
        }

        p {
            width: 100%;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            line-height: 28px;
            margin-top:20px;
            margin-bottom: 0;
        }

        span {
            position: absolute;
            bottom: 30px;
            left: 0;
            width: 100%;
            font-size: 18px;
            text-align: center;
            line-height: 20px;
        }
    </style>
</head>

<body class="bodyCertificat">
    <div class="containerCertificat">
        <h2>{{$prenom}}&nbsp;&nbsp;{{$nom}}</h2>
        <h1>{{$formation}}</h1>
        <h3>{{$detail}}</h3>
        <span>Le&nbsp;{{$date}}</span>
    </div>



    <!-- <br/>
    <strong>Public Folder:</strong>
    <img src="{{ public_path('images/certificat.png') }}" style="width: 200px; height: 200px">
   -->

    <img src="{{ storage_path('app/public/images/certificat.jpg') }}" style="width: 29.7cm; height: 21cm;">
</body>

</html>