let i = 0;
let j = 0;

function add() {
	const xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			document.getElementById('error').innerHTML = xhr.responseText;
		}
	};
	xhttp.open('GET', './add_form.php', true);
	xhttp.send();

	// '" . addslashes(file_get_contents($_FILES['zdjecie']['tmp_name'])) . "'
}

function sendFile() {
	const xhr = new XMLHttpRequest();
	const fd = new FormData();
	var file = document.getElementById('photo_1').files[0];
	console.log(file[0]);

	xhr.open('POST', './php/add_form.php', true);
	xhr.onreadystatechange = function () {};
	fd.append('myFile', file);
	xhr.send(fd);
}

function addSpecification() {
	i++;
	const specifications = document.getElementsByClassName('specification');
	let clone = specifications[0].cloneNode(true);
	clone.style.display = 'block';
	for (let element of clone.children) {
		element.id += i;
	}
	document.getElementById('specification').appendChild(clone);
}

function addEngine() {
	j++;
	const engines = document.getElementsByClassName('engine');
	let clone = engines[0].cloneNode(true);
	clone.style.display = 'block';
	for (let element of clone.children) {
		element.id += i;
	}
	document.getElementById('engine').appendChild(clone);
}

function setForm() {
	const select = document.getElementById('category');
	console.log(select.value);
}
