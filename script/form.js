let i = 0;
let j = 0;

function add() {
	const xhttp = new XMLHttpRequest();
	const fd = new FormData();
	xhttp.onreadystatechange = function () {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById('error').innerHTML = xhttp.responseText;
		}
	};
	xhttp.open('POST', './php/add_form.php', true);
	fd.append('photo1', document.getElementById('photo1').files[0]);
	fd.append('photo2', document.getElementById('photo2').files[0]);
	fd.append('photo3', document.getElementById('photo3').files[0]);
	fd.append('photo4', document.getElementById('photo4').files[0]);
	fd.append('category', document.getElementById('category').value);
	fd.append('mark', document.getElementById('mark').value);
	fd.append('model', document.getElementById('model').value);
	fd.append('workingWidth', document.getElementById('workingWidth').value);
	fd.append('fromCountry', document.getElementById('fromCountry').value);
	fd.append('price', document.getElementById('price').value);

	for (const el of document.getElementsByClassName('engine')) {
		for (const child of el.children) {
			fd.append(child.id, child.value);
		}
	}

	for (const el of document.getElementsByClassName('specification')) {
		for (const child of el.children) {
			fd.append(child.id, child.value);
		}
	}

	xhttp.send(fd);

	// '" . addslashes(file_get_contents($_FILES['zdjecie']['tmp_name'])) . "'
}

function sendFile() {
	const xhr = new XMLHttpRequest();

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
		element.id += j;
	}
	document.getElementById('engine').appendChild(clone);
}

function setForm() {
	const select = document.getElementById('category');
	if (select.value == 'Traktory') {
		document.getElementById('mark').style.display = 'inline-block';
		document.getElementById('model').style.display = 'inline-block';
		document.getElementById('buttonSpecification').style.display =
			'inline-block';
		document.getElementById('specification').style.display = 'inline-block';
		document.getElementById('engine').style.display = 'inline-block';
		document.getElementById('buttonEngine').style.display = 'inline-block';
		document.getElementById('workingWidth').style.display = 'none';
	} else if (
		select.value == 'Kombajny' ||
		select.value == 'Kosiarki Rolnicze' ||
		select.value == 'Uprawa Ziemniaków' ||
		select.value == 'Uprawa Buraków'
	) {
		document.getElementById('mark').style.display = 'inline-block';
		document.getElementById('model').style.display = 'inline-block';
		document.getElementById('buttonSpecification').style.display =
			'inline-block';
		document.getElementById('buttonEngine').style.display = 'inline-block';
		document.getElementById('specification').style.display = 'inline-block';
		document.getElementById('engine').style.display = 'inline-block';
		document.getElementById('workingWidth').style.display = 'inline-block';
	} else if (
		select.value == 'Siewniki' ||
		select.value == 'Opryskiwacze' ||
		select.value == 'Pługi' ||
		select.value == 'Kultywatory' ||
		select.value == 'Prasy Do Siana' ||
		select.value == 'Rozrzutniki' ||
		select.value == 'Rozsiewacze'
	) {
		document.getElementById('mark').style.display = 'inline-block';
		document.getElementById('model').style.display = 'inline-block';
		document.getElementById('buttonSpecification').style.display = 'none';
		document.getElementById('buttonEngine').style.display = 'none';
		document.getElementById('specification').style.display = 'none';
		document.getElementById('engine').style.display = 'none';
		document.getElementById('workingWidth').style.display = 'inline-block';
	} else if (select.value == 'Przyczepy' || select.value == 'Paszowozy') {
		document.getElementById('mark').style.display = 'inline-block';
		document.getElementById('model').style.display = 'inline-block';
		document.getElementById('buttonSpecification').style.display = 'none';
		document.getElementById('buttonEngine').style.display = 'none';
		document.getElementById('specification').style.display = 'none';
		document.getElementById('engine').style.display = 'none';
		document.getElementById('workingWidth').style.display = 'none';
	} else if (select.value == 'Nawozy' || select.value == 'Rośliny') {
		document.getElementById('mark').style.display = 'inline-block';
		document.getElementById('model').style.display = 'none';
		document.getElementById('buttonSpecification').style.display = 'none';
		document.getElementById('buttonEngine').style.display = 'none';
		document.getElementById('specification').style.display = 'none';
		document.getElementById('engine').style.display = 'none';
		document.getElementById('workingWidth').style.display = 'none';
	} else {
		document.getElementById('mark').style.display = 'none';
		document.getElementById('model').style.display = 'none';
		document.getElementById('buttonSpecification').style.display = 'none';
		document.getElementById('buttonEngine').style.display = 'none';
		document.getElementById('specification').style.display = 'none';
		document.getElementById('engine').style.display = 'none';
		document.getElementById('workingWidth').style.display = 'none';
	}
}
