function onHover(i) {
	var span = document.getElementById("detail-" + i);
	span.style.display = "block";
	span.style.top = event.clientY;
	span.style.left = event.clientX;
}

function onOut(i) {
	var span = document.getElementById("detail-" + i);
	span.style.display = "none";
}

function init() {
	var tr = document.getElementsByTagName("tr");
	for (var i = 1; i < tr.length; i++) {
		tr[i].addEventListener("mouseover", function(e) {     
			var id = e.path[1].id.substring(4);
			onHover(id);
		});
		tr[i].addEventListener("mouseout", function(e) {     
			var id = e.path[1].id.substring(4);
			onOut(id);
		});
	}
}

window.onload = init();