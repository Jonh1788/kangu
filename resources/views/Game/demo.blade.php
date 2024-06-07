<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Unity Web Player | KanguPix</title>
    <link rel="shortcut icon" href="TemplateData/favicon.ico">
    <link rel="stylesheet" href="TemplateData/style.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  </head>
  <body>
    <div id="unity-container" class="unity-desktop">
      <canvas id="unity-canvas" width=960 height=600 tabindex="-1"></canvas>
      <div id="unity-loading-bar">
        <div id="unity-logo"></div>
        <div id="unity-progress-bar-empty">
          <div id="unity-progress-bar-full"></div>
        </div>
      </div>
      <div id="unity-warning"> </div>
      <div id="unity-footer">
        <div id="unity-logo-title-footer"></div>
        <div id="unity-fullscreen-button"></div>
        <div id="unity-build-title">KanguPix</div>
      </div>
    </div>
    <script>
      var canvas = document.querySelector("#unity-canvas");

      // Shows a temporary message banner/ribbon for a few seconds, or
      // a permanent error message on top of the canvas if type=='error'.
      // If type=='warning', a yellow highlight color is used.
      // Modify or remove this function to customize the visually presented
      // way that non-critical warnings and error messages are presented to the
      // user.
      function unityShowBanner(msg, type) {
        var warningBanner = document.querySelector("#unity-warning");
        function updateBannerVisibility() {
          warningBanner.style.display = warningBanner.children.length ? 'block' : 'none';
        }
        var div = document.createElement('div');
        div.innerHTML = msg;
        warningBanner.appendChild(div);
        if (type == 'error') div.style = 'background: red; padding: 10px;';
        else {
          if (type == 'warning') div.style = 'background: yellow; padding: 10px;';
          setTimeout(function() {
            warningBanner.removeChild(div);
            updateBannerVisibility();
          }, 5000);
        }
        updateBannerVisibility();
      }

      var buildUrl = "Build2";
      var loaderUrl = buildUrl + "/836402f9cddbc4ef93c29c2721fb94d7.loader.js";
      var config = {
        arguments: [],
        dataUrl: buildUrl + "/b6394b46e3c00edadd21f3ff073cdb2c.data.br",
        frameworkUrl: buildUrl + "/a2e13005f949cf14de59e2b9062ad7dd.framework.js.br",
        codeUrl: buildUrl + "/461af1d912f5984fd5da9fe2d3e22416.wasm.br",
        streamingAssetsUrl: "StreamingAssets",
        companyName: "DefaultCompany",
        productName: "KanguPix",
        productVersion: "0.1",
        showBanner: unityShowBanner,
      };

      // By default, Unity keeps WebGL canvas render target size matched with
      // the DOM size of the canvas element (scaled by window.devicePixelRatio)
      // Set this to false if you want to decouple this synchronization from
      // happening inside the engine, and you would instead like to size up
      // the canvas DOM size and WebGL render target sizes yourself.
      // config.matchWebGLToCanvasSize = false;

      if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        // Mobile device style: fill the whole browser client area with the game canvas:

        var meta = document.createElement('meta');
        meta.name = 'viewport';
        meta.content = 'width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, shrink-to-fit=yes';
        document.getElementsByTagName('head')[0].appendChild(meta);
        document.querySelector("#unity-container").className = "unity-mobile";
        canvas.className = "unity-mobile";

        // To lower canvas resolution on mobile devices to gain some
        // performance, uncomment the following line:
        // config.devicePixelRatio = 1;


      } else {
        // Desktop style: Render the game canvas in a window that can be maximized to fullscreen:
        canvas.style.width = "960px";
        canvas.style.height = "600px";
      }

      document.querySelector("#unity-loading-bar").style.display = "block";

      var script = document.createElement("script");
      script.src = loaderUrl;
      script.onload = () => {
        createUnityInstance(canvas, config, (progress) => {
          document.querySelector("#unity-progress-bar-full").style.width = 100 * progress + "%";
              }).then((unityInstance) => {
                instance = unityInstance;
                var saldo = 100;
                console.log("Saldo: " + saldo);
                var aposta = 5;
                instance.SendMessage('DataHandler', 'PegarSaldo', saldo.toString());
                instance.SendMessage('DataHandler', 'PegarAposta', aposta.toString());
                instance.SendMessage('DataHandler', 'isDemo');  
                document.querySelector("#unity-loading-bar").style.display = "none";
                document.querySelector("#unity-fullscreen-button").onclick = () => {
                  unityInstance.SetFullscreen(1);
                };

              }).catch((message) => {
                alert(message);
              });
            };

      document.body.appendChild(script);

      console.log("DOM carregado")
            var btn = document.getElementById('teste');
            btn.addEventListener('click', function() {
                console.log("clicado")
                instance.SendMessage('DataHandler', 'Voltar');
                
            });


        function voltarAoMenu(){
            var user = "{{ session('user') }}";
            if(user){
              window.location.href = "/deposito"
            } else{
              window.location.href = "/cadastrar";
            }
        }

        function irParaCadastro(score){
            var user = "{{ session('user') }}";
            if(user){
              window.location.href = "/deposito?score=" + score;
            } else{
              window.location.href = "/cadastrar?score=" + score;
            }
        }

        function retornarRespostaSaldo(callbackObject, callbackMethod, saldo){
        
            var dados = {
                saldo: saldo,
                email: "",
                token: ""
            }

            axios.post('/game', dados)
                .then(function(response){
                    instance.SendMessage(callbackObject, callbackMethod, "success");
                    console.log(response.data);
                })
                .catch(function(error){
                    instance.SendMessage(callbackObject, callbackMethod, "error");
                    console.log(error);
                });
        }

    </script>
  </body>
</html>
