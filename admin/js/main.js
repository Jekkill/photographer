var ed = document.querySelectorAll('.edit');

for (var i = 0; i < ed.length; i++) {
	ed[i].onclick = function() {
		var id  = this.attributes.rel.value;
		var url = 'http://localhost/photographer/main/admin/' + section + '_edit.php?id=' + id;
		window.location.href = url;
	}
}

var ed = document.querySelectorAll('.remove');

for (var i = 0; i < ed.length; i++) {
	ed[i].onclick = function() {
		if (confirm('Вы уверены что хотите удалить эту запись?')) {
			var id  = this.attributes.rel.value;
			var url = 'http://localhost/photographer/main/admin/' + section + '_delete.php?id=' + id;
			window.location.href = url;
		}
	}
}