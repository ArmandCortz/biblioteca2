$(document).ready(pagination(1));
$(function () {
	$("#bd-desde").on("change", function () {
		var desde = $("#bd-desde").val();
		var hasta = $("#bd-hasta").val();
		var url = "clientes/busca_producto_fecha.php";
		$.ajax({
			type: "POST",
			url: url,
			data: "desde=" + desde + "&hasta=" + hasta,
			success: function (datos) {
				$("#agrega-registros").html(datos);
			},
		});
		return false;
	});


	$("#bs-prod").on("keyup", function () {
		var dato = $("#bs-prod").val();
		var url = "busqueda.php";
		$.ajax({
			type: "POST",
			url: url,
			data: "dato=" + dato,
			success: function (datos) {
				$("#agrega-registros").html(datos);
			},
		});
		return false;
	});
});



function pagination(partida) {
	var url = "busqueda.php";
	$.ajax({
		type: "POST",
		url: url,
		data: "partida=" + partida,
		success: function (data) {
			var array = eval(data);
			$("#agrega-registros").html(array[0]);
			$("#pagination").html(array[1]);
		},
	});
	return false;
}
