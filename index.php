<!doctype html>
<html class="no-js" lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Video</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="/css/style2.css" type="text/css" media="all">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <script type="text/javascript">
    console.log("%cBiiALab", "background: red; color: yellow; font-size: x-large");
    </script>
    <!-- VAMO a hacerlo responsive

                   _,........__
            ,-'            "`-.
          ,'                   `-.
        ,'                        \
      ,'                           .
      .'\               ,"".       `
     ._.'|             / |  `       \
     |   |            `-.'  ||       `.
     |   |            '-._,'||       | \
     .`.,'             `..,'.'       , |`-.
     l                       .'`.  _/  |   `.
     `-.._'-   ,          _ _'   -" \  .     `
`."""""'-.`-...,---------','         `. `....__.
.'        `"-..___      __,'\          \  \     \
\_ .          |   `""""'    `.           . \     \
  `.          |              `.          |  .     L
    `.        |`--...________.'.        j   |     |
      `._    .'      |          `.     .|   ,     |
         `--,\       .            `7""' |  ,      |
            ` `      `            /     |  |      |    _,-'"""`-.
             \ `.     .          /      |  '      |  ,'          `.
              \  v.__  .        '       .   \    /| /              \
               \/    `""\"""""""`.       \   \  /.''                |
                `        .        `._ ___,j.  `/ .-       ,---.     |
                ,`-.      \         ."     `.  |/        j     `    |
               /    `.     \       /         \ /         |     /    j
              |       `-.   7-.._ .          |"          '         /
              |          `./_    `|          |            .     _,'
              `.           / `----|          |-............`---'
                \          \      |          |
               ,'           )     `.         |
                7____,,..--'      /          |
                                  `---.__,--.'


    -->
    <style type="text/css">

        .content, .cnt-video iframe {
            max-width: 100%;
        }

        #questions_box {
            position: relative;
            max-width: 100%;
            width: 640px;
        }
        #question_text {
            width: 75%;
            box-sizing: border-box;
            height: 45px;
        }
        #send_question {
            width: 25%;
        }
    </style>
    <body>
        <div class="content">
            <div class="cnt-video">
                <iframe src="" width="640" height="390" frameborder="0" scrolling="no"> </iframe>
                <div class="form-dni">
                    <div class="cnt-interna-l">
                        <div style="font-size:13px; margin-bottom:8px"></div>
                        <input type="text" name="dni" id="dni" placeholder="Ingresa tu identificación" maxlength="12">
                        <div id="mensaje" class="error">Ingresa tu número de cédula</div>
                        <a href="#" id="send-btn" class="btn btn-primary">Ingresar</a>
                    </div>
                </div>
            </div>
            <div id="alert_box" style="display:none;"><p id="alert_text"></p></div>
            <div id="register_fields" style="display:none;">
                <div class="field">
                    <input type="text" style="height: 40px;width: 100%;" id="username" placeholder="Escriba su nombre">
                </div>
              <button id="enter">Ingresar a sala de preguntas</button>
            </div>
            <div id="questions_box" style="display:none;">
              <div id="question_form">
                <input type="hidden" id="question_email" />
                <input type="hidden" id="question_user" />
                <input type="text" id="question_text" placeholder="%name%, ingrese su pregunta acá" />
                <button data-chat-id="11ago" id="send_question">Enviar pregunta</button>
              </div>
              <h4>Preguntas</h4>
              <ul id="questions"></ul>
            </div>
        </div>
        <script src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#send-btn').click(function(){
                    var dni = $("#dni").val();
                    if(dni == ""){
                        $("#mensaje").fadeIn("slow");
                        return false;
                    }
                    else{
                        $.ajax({
                        url: "https://plataforma.biialab.org/site/reproductor/save-info",
                        data : {doc : $('#dni').val()},
                        type : 'POST',
                        dataType: "json",
                        beforeSend: function( xhr ) {
                          xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                        }
                        }).done(function(data){
                            if(data.success == true) {
                                var src = "http://livestream.com/accounts/12844744/events/4494171/player";
                                $("iframe").attr('src',src); 
                                $(".form-dni").hide();
                            } 
                            else {
                                alert('Se perdio la conexión, vuelva a intentarlo en unos minutos');
                            }
                        });
                        
                    }
                });
                $("#dni").keyup(function(){
                    if($(this).val()!=""){
                        $("#mensaje").fadeOut();
                        return false;
                    }
                });
            });
        </script>

        
            
            <script type="text/javascript" src="/js/cookie.js"></script>
            <script type="text/javascript" src="/js/coffee-script.js"></script>
            <script type="text/coffeescript" src="/js/app.coffee"></script>
            <script type="text/javascript">
            $('#question_text').keypress(function(event){
          
              var keycode = (event.keyCode ? event.keyCode : event.which);
              if(keycode == '13'){
                $("#send_question").click();
              }

            });
            </script>
    </body>
</html>