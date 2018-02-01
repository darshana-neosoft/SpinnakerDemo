
$( "#score_form" ).submit(function( event ) {
	var case_size = document.getElementById("case-size");
	var case_size_score = Number(case_size.options[case_size.selectedIndex].value);
  	var industry = document.getElementById("industry");
	var industry_score = Number(industry.options[industry.selectedIndex].value);
	var states = document.getElementById("state");
	var state_score = Number(states.options[states.selectedIndex].value);
	var seasonality = document.getElementById("seasonality");
	var seasonality_score = Number(seasonality.options[seasonality.selectedIndex].value);
	var broker = document.getElementById("broker");
	var broker_score =Number(broker.options[broker.selectedIndex].value);
	var total_score = case_size_score+industry_score+state_score+seasonality_score+broker_score
      $("#score-output-value").html(total_score);   
  	$("#score-output-div").show();
});


function reset_div() {
    $('#score-output-div').hide();
}