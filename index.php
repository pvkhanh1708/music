
<html>
<body style="
    background-image: url('rain.jpg');
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
   "
>
    <img
        id="img"
        src="xt.png"
        style="
            position: absolute;
            width: 200px;
            border-radius: 50%;
            z-index: 5;
        "
    />
    <img
        id="img2"
        src="wt.png"
        style="
            position: absolute;
            height: 100%;
            border-radius: 50%;
            z-index: 2;
        "
    />
</body>
</html>
<script>
    audio = new Audio();
    audio.src = "mt4.mp3";
    analyser = null;
    click = 0;
    rote = 0;
    document.getElementById('img').onclick = () => {
        click++;
        if(click<2){
            context = new AudioContext()
            analyser = context.createAnalyser()
            context.createMediaElementSource(audio)
            .connect(analyser)
            analyser.connect(context.destination)
            audio.play()
            loop()
        }
    }
    
    function loop() {
        rote+=0.5;
        if(rote>360) rote = 0;
        rotes = "rotate("+rote+"deg)"
        console.log(rotes)
        window.requestAnimationFrame(loop);
        fbc = new Uint8Array(analyser.frequencyBinCount);
        analyser.getByteFrequencyData(fbc);
        avg = fbc.reduce((a,b) => a + b, 0) / fbc.length;
        document.getElementById('img').style.width = avg * 5
        
        document.getElementById('img2').style.transform = rotes; 
        // document.body.style.backgroundColor =
        // 'rgb('+avg+','+avg+','+avg+')'
        dum = 100 + avg/5;
        document.body.style.backgroundImage = "url('rain.jpg')";
        document.body.style.backgroundSize = dum+"%";
    }
</script>