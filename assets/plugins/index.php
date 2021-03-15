<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <title>Permission Denied</title>
    <style>
        html {
            background-color: #000121;
            font-family: 'Roboto', sans-serif;

        }

        .maincontainer {
            position: relative;
            top: -101px;
            transform: scale(0.8);
            background: url("https://www.blissfullemon.com/wp-content/uploads/2018/09/HauntedHouseBackground.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 700px 600px;
            width: 800px;
            height: 600px;
            margin: 0px auto;
            display: grid;
        }

        .foregroundimg {
            position: relative;
            width: 100%;
            top: -230px;
            z-index: 5;
        }

        .errorcode {
            position: relative;
            top: -200px;
            font-family: 'Creepster', cursive;
            color: white;
            text-align: center;
            font-size: 6em;
            letter-spacing: 0.1em;
        }

        .errortext {
            position: relative;
            top: -260px;
            color: #FBD130;
            text-align: center;
            text-transform: uppercase;
            font-size: 1.8em;
        }

        .bat {
            opacity: 0;
            position: relative;
            transform-origin: center;
            z-index: 3;
        }

        .bat:nth-child(1) {
            top: 380px;
            left: 120px;
            transform: scale(0.5);
            animation: 13s 1s flyBat1 infinite linear;
        }

        .bat:nth-child(2) {
            top: 280px;
            left: 80px;
            transform: scale(0.3);
            animation: 8s 4s flyBat2 infinite linear;
        }

        .bat:nth-child(3) {
            top: 200px;
            left: 150px;
            transform: scale(0.4);
            animation: 12s 2s flyBat3 infinite linear;
        }

        .body {
            position: relative;
            width: 50px;
            top: 10px;
        }

        .wing {
            width: 150px;
            position: relative;
            transform-origin: right center;
        }

        .leftwing {
            left: 30px;
            animation: 0.8s flapLeft infinite ease-in-out;
        }

        .rightwing {
            left: -180px;
            transform: scaleX(-1);
            animation: 0.8s flapRight infinite ease-in-out;
        }

        @keyframes flapLeft {
            0% {
                transform: rotateZ(0);
            }

            50% {
                transform: rotateZ(10deg) rotateY(40deg);
            }

            100% {
                transform: rotateZ(0);
            }
        }

        @keyframes flapRight {
            0% {
                transform: scaleX(-1) rotateZ(0);
            }

            50% {
                transform: scaleX(-1) rotateZ(10deg) rotateY(40deg);
            }

            100% {
                transform: scaleX(-1) rotateZ(0);
            }
        }

        @keyframes flyBat1 {
            0% {
                opacity: 1;
                transform: scale(0.5)
            }

            25% {
                opacity: 1;
                transform: scale(0.5) translate(-400px, -330px)
            }

            50% {
                opacity: 1;
                transform: scale(0.5) translate(400px, -800px)
            }

            75% {
                opacity: 1;
                transform: scale(0.5) translate(600px, 100px)
            }

            100% {
                opacity: 1;
                transform: scale(0.5) translate(100px, 300px)
            }
        }

        @keyframes flyBat2 {
            0% {
                opacity: 1;
                transform: scale(0.3)
            }

            25% {
                opacity: 1;
                transform: scale(0.3) translate(200px, -330px)
            }

            50% {
                opacity: 1;
                transform: scale(0.3) translate(-300px, -800px)
            }

            75% {
                opacity: 1;
                transform: scale(0.3) translate(-400px, 100px)
            }

            100% {
                opacity: 1;
                transform: scale(0.3) translate(100px, 300px)
            }
        }

        @keyframes flyBat3 {
            0% {
                opacity: 1;
                transform: scale(0.4)
            }

            25% {
                opacity: 1;
                transform: scale(0.4) translate(-350px, -330px)
            }

            50% {
                opacity: 1;
                transform: scale(0.4) translate(400px, -800px)
            }

            75% {
                opacity: 1;
                transform: scale(0.4) translate(-600px, 100px)
            }

            100% {
                opacity: 1;
                transform: scale(0.4) translate(100px, 300px)
            }
        }

        .btn {
            border: 2px solid black;
            background-color: white;
            color: black;
            padding: 14px 28px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Green */
        .success {
            border-color: #4CAF50;
            color: green;
        }

        .success:hover {
            background-color: #4CAF50;
            color: white;
        }

        /* Blue */
        .info {
            border-color: #2196F3;
            color: dodgerblue;
        }

        .info:hover {
            background: #2196F3;
            color: white;
        }

        /* Orange */
        .warning {
            border-color: #ff9800;
            color: orange;
            border-radius: 10%;
            width: 300px;
            height: 50px;
            justify-content: space-between;
        }

        .warning:hover {
            background: #ff9800;
            color: white;
        }

        /* Red */
        .danger {
            border-color: #f44336;
            color: red;
        }

        .danger:hover {
            background: #f44336;
            color: white;
        }

        /* Gray */
        .default {
            border-color: #e7e7e7;
            color: black;
        }

        .default:hover {
            background: #e7e7e7;
        }

        /*@media only screen and (max-width: 850px) {
  .maincontainer {
    transform: scale(0.6);
    width: 600px;
    height: 400px;
    background-size: 600px 400px;
  }
  
  .errortext {
    font-size: 1em;
  }
}*/
    </style>
</head>

<body>
    <div class="maincontainer">
        <div class="bat">
            <img class="wing leftwing" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/bat-wing.png">
            <img class="body" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/bat-body.png" alt="bat">
            <img class="wing rightwing" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/bat-wing.png">
        </div>
        <div class="bat">
            <img class="wing leftwing" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/bat-wing.png">
            <img class="body" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/bat-body.png" alt="bat">
            <img class="wing rightwing" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/bat-wing.png">
        </div>
        <div class="bat">
            <img class="wing leftwing" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/bat-wing.png">
            <img class="body" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/bat-body.png" alt="bat">
            <img class="wing rightwing" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/bat-wing.png">
        </div>
        <img class="foregroundimg" src="https://www.blissfullemon.com/wp-content/uploads/2018/09/HauntedHouseForeground.png" alt="haunted house">

    </div>
    <h1 class="errorcode">ERROR 403</h1>
    <div class="errortext">This area is forbidden. Turn back now!</div><br>
    <div class="errortext"><button class="btn warning" id="return">Back to previous page</button></div>
</body>

</html>
<script>
    $(document).on("click", "#return", function() {
        window.history.back(-1);
    });
</script>