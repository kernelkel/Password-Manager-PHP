function create() {
	var password ="";
	var pool = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*-_+=~:.?";

	//Random Number
	function getRndInteger(min, max) {
		return Math.floor(Math.random() * (max - min)) + min;
	}

	//Password Create
	for (var i = 0; i < 15; i++) {
		var num = getRndInteger(0,78);
		password += pool[num];
	}

	document.getElementById('password').value=password;
}