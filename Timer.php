<script>
var sizePhpDoArray = <?php print(json_encode("#timer" + $data['id'])) ?>;

for(var i = 0; i < sizePhpDoArray; i++){
	var phpDoArray = [<?php print(json_encode("#timer" + $data['id'])) ?>];
}

console.log(phpDoArray);

function startTimer(duration, display) {
    var  minutes, seconds, timer = duration;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);
		
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
		
        display.textContent = minutes + ":" + seconds;
		
        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

function startTime() {
	    var fiveMinutes = 60 * 5;
    for(var i in phpDoArray){
    	alert(phpDoArray[i]);
	        display = document.querySelector("#timer" + phpDoArray[i]);
	    console.log(display);
	    	startTimer(fiveMinutes, display);
	}
};
</script>
<body>
    <div>Registration closes in <span id="time">00:00</span> minutes!</div>
    <input type="button" value="START" id="<?php echo $data['id'];?>" name="sps" onclick="startTime();"></input>
</body>