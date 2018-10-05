<html>
<head>
	<title></title>
	<style type="text/css">
.letter-container h2{
	margin-left: 150px;
}

.letter-container h2 label {
	text-align: center;
	line-height: 0px;
}

.letter-container h2 label span {
	color: #fff;
   	opacity: 1;
   	text-shadow: 0px 0px 2px #063971, 1px 1px 4px rgba(0,0,0,0.7);
	transition: all 1s linear;
	animation: sharpen 0.9s linear backwards;
}
.letter-container h2 label span:hover{
	text-shadow: 0px 0px 40px #ff5;
}
.letter-container h2 label span:nth-child(1) {
	animation-delay: 0.5s;
}
.letter-container h2 label span:nth-child(2) {
	animation-delay: 0.1s;
}
.letter-container h2 label span:nth-child(3) {
	animation-delay: 0.2s;
}
/* ...and so on for all the letters */

@keyframes sharpen {
 0% {
   	opacity: 0;
   	text-shadow: 0px 0px 100px #fff;
   	color: transparent;
 }
 90% {
   	opacity: 0.9;
   	text-shadow: 0px 0px 10px #fff;
   	color: transparent;
 }
 100% {
    color: #fff;
   	opacity: 1;
   	text-shadow: 0px 0px 2px #fff, 1px 1px 4px rgba(0,0,0,0.7);
 }
}

.logo{
	width: 40px;
	position: absolute;
	bottom: 15px;
	left: 200px;

}




	</style>
</head>
<body>
<div id="letter-container" class="letter-container">
	<h2><label><span><img class="img-circle logo" src="<?php echo $url_logo; ?>riom.png">RADIOIMAGENES ODONTOMEDICAS Ltda.</span></label></h2>
</div>
</body>
</html>

