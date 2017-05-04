var index = -1;
var price = 0;

function fruit(id, name, price, number){
	this.id = id;
	this.name = name;
	this.price = price;
	this.number = number;
}

var fruits = [];

function init(){
	$.ajax({
			url: "http://localhost:80/basket/session",
			beforeSend: function( xhr ) {
				xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
			}
		})
		.done(function( data ) {
			var $response = JSON.parse(data);
			var i;
			for(i=0; i < $response.length; i++){
				var fruitTemp = new fruit($response[i].id, $response[i].name, $response[i].prixHt, $response[i].number);
				fruits.push(fruitTemp);
			}
			reloadPanier();
		});
}

init();

$('li').on('click', function(){
	if(this.id == index){
		$('#' + index).css('background-color', 'white');
		index = -1;
	} else {
		$('#' + index).css('background-color', 'white');
		index = this.id;
		$('#' + index).css('background-color', 'grey');
	}
})

$('#buttonAdd').on('click', function(){
	if(index != -1){
		$.ajax({
			url: "http://localhost:80/basket/1/" + index,
			beforeSend: function( xhr ) {
				xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
			}
		})
		.done(function( data ) {
			var $response = JSON.parse(data);
			var ok = false;
			var i = 0;
			while(!ok && i < fruits.length){
				if(fruits[i].name == $response.nomFruit){
					ok = true;
					fruits[i].number++;
				}
				i++;
			}
			if(!ok){
				var fruitTemp = new fruit($response.id, $response.nomFruit, $response.prixHt, 1);
				fruits.push(fruitTemp);
			}
			reloadPanier();
		});
	}
});

$('#butPayer').on('click', function(){
	if($('#totPrice').html() != "0"){
		$.ajax({
			type: "POST",
			url: "http://localhost:80/basket/store",
			data: fruits,
			beforeSend: function( xhr ) {
				xhr.overrideMimeType( "text/plain; charset=x-user-defined" );

			}
		})
		.done(function ( data ){
			fruits = []
			reloadPanier();
		});
	}
});

function reloadPanier(){
	$('tr').remove(".fruit");
	var totalPrice = 0;
	for(i=0; i < fruits.length; i++){
		totalPrice += fruits[i].number * fruits[i].price;
		$('#Panier').append(
			"<tr class='fruit'><td>" + fruits[i].name + " x " + fruits[i].number +"</td><td>" + fruits[i].price * fruits[i].number+ "</td></tr>"
		);
	}
	$('#Panier').append(
			"<tr class='fruit'><td>TOTAL</td><td id='totPrice'>" + totalPrice + "</td></tr>"
	);
}