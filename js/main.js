function PlayMusic(mp3filename) {
	au = document.getElementById("mp3play");
	au.src = mp3filename;
	au.volume = .5;
	au.loop = "loop";
	au.play();
}
