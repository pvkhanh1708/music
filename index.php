
<html>
<body style="
    background-image: url('rain.jpg');
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    height: 100%;
    width: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 160% 100%;
    overflow: hidden;
   "
>
    <img
        id="img"
        src="xt.png"
        style="
            position: absolute;
            width: 400px;
            border-radius: 50%;
            z-index: 5;
        "
    />
    <img
        id="img2"
        src="wt.png"
        style="
            position: absolute;
            width: 1200px;
            height: 1200px;
            border-radius: 50%;
            z-index: 2;
            overflow: hidden;
        "
    />
    <!-- <h1 id="play" style="
        position: absolute;
        height: 50px;
        width: 100px;
        border-radius: 50%;
        z-index: 10;
        background: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    ">Play</h1> -->
</body>
</html>
<script>
    
    var rote = 0;
    var pl = 0;
    document.getElementById('img').onclick = function(){
        pl=1;
        if(pl==1){
            var audio = new Audio();
            audio.src = "mt4.mp3";
            context = new AudioContext();
            audio.muted = false;
            analyser = context.createAnalyser();
            context.createMediaElementSource(audio).connect(analyser);
            analyser.connect(context.destination);
            audio.play();
            loop();
        }
    }
    
    function loop() {
        if(rote>360) rote = 0;
        rotes = "rotate("+rote+"deg)"
        window.requestAnimationFrame(loop);
        fbc = new Uint8Array(analyser.frequencyBinCount);
        
        analyser.getByteFrequencyData(fbc);
        avg = fbc.reduce((a,b) => a + b, 0) / fbc.length;
        document.getElementById('img').style.width = (400 + (avg * 4))
        //  document.getElementById('img').style.width = (document.getElementById('img').style.width - avg)
        rote+=(avg/10);
        document.getElementById('img2').style.transform = rotes; 
        // document.body.style.backgroundColor =
        // 'rgb('+avg+','+avg+','+avg+')'
        dum = 160 + (avg/5);
        dum2 = 100 + (avg/5);
        document.body.style.backgroundImage = "url('rain.jpg')";
        document.body.style.backgroundSize = dum+"% "+dum2+"%";
        
    }
</script>