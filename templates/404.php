<!DOCTYPE html>
<html>
<head>
    <style>

        body {
            background: linear-gradient(to right, #000000, #333333);
        }

        @keyframes rotate {
            from {
                transform: rotateY(0deg);
            }
            to {
                transform: rotateY(1turn);
            }
        }

        .scene {
            width: 200px;
            height: 200px;
            perspective: 1000px;
            margin: 0 auto;
            position: relative;
            top: 50%;
        }

        .cube {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transform: rotateY(0deg);
            animation: rotate 5s infinite linear;
        }

        .cube div {
            position: absolute;
            width: 200px;
            height: 200px;
            background: #f00;
            color: #fff;
            text-align: center;
            line-height: 200px;
            font-size: 40px;
            font-family: Arial, sans-serif;
        }

        .front  { transform: rotateY(  0deg) translateZ(100px); }
        .right  { transform: rotateY( 90deg) translateZ(100px); }
        .back   { transform: rotateY(180deg) translateZ(100px); }
        .left   { transform: rotateY(-90deg) translateZ(100px); }
        .top    { transform: rotateX( 90deg) translateZ(100px); }
        .bottom { transform: rotateX(-90deg) translateZ(100px); }
    </style>
</head>
<body>
    <div id="scene"></div>
    <h1 style="text-align: center; color: white;">404 - Page not found</h1>
    <h2 style="text-align: center; color: white;">La page semble ne pas exister, appuyez sur le bouton ci-dessous pour retourner au home</h2>

    <div style="text-align: center;">
        <a href="/" style="text-align: center; color: white;">Retourner au home</a>
    </div>
    <script>
        window.onload = function() {
            var scene = document.getElementById('scene');
            scene.className = 'scene';

            var cube = document.createElement('div');
            cube.className = 'cube';

            ['front', 'back', 'left', 'right', 'top', 'bottom'].forEach(function(className) {
                var face = document.createElement('div');
                face.className = className;
                face.textContent = '404';
                cube.appendChild(face);
            });

            scene.appendChild(cube);
        };
    </script>
</body>
</html>