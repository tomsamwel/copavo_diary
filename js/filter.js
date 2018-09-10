$(document).ready(function(){

    var date_input=$('input[name="date"]');      //date input
    var options={                                //set format to match DB
        format: 'yyyy-mm-dd',
        autoclose: true,
    };
    date_input.datepicker(options);              //initialize 

    $("#datefilter").on("change", function() {   //when value changes, compare value
    var value = $(this).val().toLowerCase();     //toLowerCare(); is unnecessairy for dates but useful for text
    $("#posts li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
})
