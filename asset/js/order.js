$(document).ready(function(){
   var DOMAIN = "http://localhost/Assessment_for_the_post_PHP_Developer/";
	addNewRow();

	$("#add").click(function(){
		addNewRow();
	})

	function addNewRow(){
		$.ajax({
			url : DOMAIN+"process.php",
			method : "POST",
			data : {getNewOrderItem:1},
			success : function(data){
				$("#invoice_item").append(data);
				var n = 0;
				$(".number").each(function(){
					$(this).html(++n);
				})
			}
		})
	}
  $("#remove").click(function(){
		$("#invoice_item").children("tr:last").remove();
		calculate(0,0);
	})
  $("#invoice_item").delegate(".product_id","change",function(){
		var pid = $(this).val();
		var tr = $(this).parent().parent();
		$(".overlay").show();
		$.ajax({
			url : DOMAIN+"process.php",
			method : "POST",
			dataType : "json",
			data : {getPriceAndQty:1,id:pid},
			success : function(data){
        // console.log(data);
      	tr.find(".price").val(data["price"]);
				tr.find(".pro_name").val(data["productName"]);
				tr.find(".qty").val(1);

				tr.find(".amt").html( tr.find(".qty").val() * tr.find(".price").val() );
				calculate(0);
			}
		})
	})




	$("#invoice_item").delegate(".qty","keyup",function(){
		var qty = $(this);
		var tr = $(this).parent().parent();
		if (isNaN(qty.val())) {
			alert("Please enter a valid quantity");
			qty.val(1);
		}else{
			if ((qty.val() - 0) > (tr.find(".tqty").val()-0)) {
				alert("Sorry ! This much of quantity is not available");
				aty.val(1);
			}else{
				tr.find(".amt").html(qty.val() * tr.find(".price").val());
				calculate(0);
			}
		}

	})

  function calculate(paid){
		var sub_total = 0;
		var paid_amt = paid;
		var due = 0;
		$(".amt").each(function(){
			sub_total = sub_total + ($(this).html() * 1);
		})
		due = sub_total - paid_amt;
		$("#sub_total").val(sub_total);
		$("#due").val(due);
	}

	$("#paid").keyup(function(){
		var paid = $(this).val();
		calculate(paid);
	})


	/*Order Accepting*/

	$("#order_form").click(function(){

		var invoice = $("#get_order_data").serialize();
		if ($("#cust_name").val() === "") {
			alert("Plaese enter customer name");
		}else if($("#paid").val() === ""){
			alert("Plaese eneter paid amount");
		}else{
			$.ajax({
				url : DOMAIN+"process.php",
				method : "POST",
      	dataType : "json",
				data : $("#get_order_data").serialize(),
				success : function(data){
					if (data < 0) {
						alert(data);
					}else{
						$("#get_order_data").trigger("reset");

					}
				}
			});
		}
	});


});
