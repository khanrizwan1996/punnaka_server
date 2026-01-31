$(document).ready(function() {
    
    $("input[name='bus_sch_mon_24']").on("click", function() {
        if($(this).val() == 1) {
            document.getElementById('bus_sch_mon_set_time').style.display = 'block';
            document.getElementById('bus_sch_mon_start').value = '';
            document.getElementById('bus_sch_mon_end').value = '';
            document.getElementById('bus_sch_mon_24_set_time').value='1';
            
            document.getElementById('bus_sch_mon_start').setAttribute('required', 'required');
            document.getElementById('bus_sch_mon_end').setAttribute('required', 'required');
            document.getElementById('bus_sch_mon_24_set_time').setAttribute('required', 'required');

            
        }else if ($(this).val() == 2) {
            document.getElementById('bus_sch_mon_set_time').style.display = 'none';
            document.getElementById('bus_sch_mon_start').value = '';
            document.getElementById('bus_sch_mon_end').value = '';
            document.getElementById('bus_sch_mon_24_hours').value='2';
            document.getElementById('bus_sch_mon_start').removeAttribute('required');
            document.getElementById('bus_sch_mon_end').removeAttribute('required');
            document.getElementById('bus_sch_mon_24_set_time').removeAttribute('required');
        }
    });


    $("input[name='bus_sch_tue_24']").on("click", function() {
        if($(this).val() == 1) {
            document.getElementById('bus_sch_tue_set_time').style.display = 'block';
            document.getElementById('bus_sch_tue_start').value = '';
            document.getElementById('bus_sch_tue_end').value = '';
            document.getElementById('bus_sch_tue_24_set_time').value='1';
            document.getElementById('bus_sch_tue_start').setAttribute('required', 'required');
            document.getElementById('bus_sch_tue_end').setAttribute('required', 'required');

        }else if ($(this).val() == 2) {
            document.getElementById('bus_sch_tue_set_time').style.display = 'none';
            document.getElementById('bus_sch_tue_start').value = '';
            document.getElementById('bus_sch_tue_end').value = '';
            document.getElementById('bus_sch_tue_24_hours').value='2';
            document.getElementById('bus_sch_tue_start').removeAttribute('required');
            document.getElementById('bus_sch_tue_end').removeAttribute('required');
        }
    });

    $("input[name='bus_sch_wed_24']").on("click", function() {  
        if($(this).val() == 1) {
            document.getElementById('bus_sch_wed_set_time').style.display = 'block';
            document.getElementById('bus_sch_wed_start').value = '';
            document.getElementById('bus_sch_wed_end').value = '';
            document.getElementById('bus_sch_wed_24_set_time').value='1';
            document.getElementById('bus_sch_wed_start').setAttribute('required', 'required');
            document.getElementById('bus_sch_wed_end').setAttribute('required', 'required');

        }else if ($(this).val() == 2) {
            document.getElementById('bus_sch_wed_set_time').style.display = 'none';
            document.getElementById('bus_sch_wed_start').value = '';
            document.getElementById('bus_sch_wed_end').value = '';
            document.getElementById('bus_sch_wed_24_hours').value='2';
            document.getElementById('bus_sch_wed_start').removeAttribute('required');
            document.getElementById('bus_sch_wed_end').removeAttribute('required');
        }
    });

     $("input[name='bus_sch_thu_24']").on("click", function() {
        if($(this).val() == 1) {
            document.getElementById('bus_sch_thu_set_time').style.display = 'block';
            document.getElementById('bus_sch_thu_start').value = '';
            document.getElementById('bus_sch_thu_end').value = '';
            document.getElementById('bus_sch_thu_24_set_time').value='1';
            document.getElementById('bus_sch_thu_start').setAttribute('required', 'required');
            document.getElementById('bus_sch_thu_end').setAttribute('required', 'required');

        }else if ($(this).val() == 2) {
            document.getElementById('bus_sch_thu_set_time').style.display = 'none';
            document.getElementById('bus_sch_thu_start').value = '';
            document.getElementById('bus_sch_thu_end').value = '';
            document.getElementById('bus_sch_thu_24_hours').value='2';
            document.getElementById('bus_sch_thu_start').removeAttribute('required');
            document.getElementById('bus_sch_thu_end').removeAttribute('required');
        }
    });

    $("input[name='bus_sch_fri_24']").on("click", function() {
        if($(this).val() == 1) {
            document.getElementById('bus_sch_fri_set_time').style.display = 'block';
            document.getElementById('bus_sch_fri_start').value = '';
            document.getElementById('bus_sch_fri_end').value = '';
            document.getElementById('bus_sch_fri_24_set_time').value='1';
            document.getElementById('bus_sch_fri_start').setAttribute('required', 'required');
            document.getElementById('bus_sch_fri_end').setAttribute('required', 'required');

        }else if ($(this).val() == 2) {
            document.getElementById('bus_sch_fri_set_time').style.display = 'none';
            document.getElementById('bus_sch_fri_start').value = '';
            document.getElementById('bus_sch_fri_end').value = '';
            document.getElementById('bus_sch_fri_24_hours').value='2';
            document.getElementById('bus_sch_fri_start').removeAttribute('required');
            document.getElementById('bus_sch_fri_end').removeAttribute('required');
        }
    });

    $("input[name='bus_sch_sat_24']").on("click", function() {
        if($(this).val() == 1) {
            document.getElementById('bus_sch_sat_set_time').style.display = 'block';
            document.getElementById('bus_sch_sat_start').value = '';
            document.getElementById('bus_sch_sat_end').value = '';
            document.getElementById('bus_sch_sat_24_set_time').value='1';
            document.getElementById('bus_sch_sat_start').setAttribute('required', 'required');
            document.getElementById('bus_sch_sat_end').setAttribute('required', 'required');

        }else if ($(this).val() == 2) {
            document.getElementById('bus_sch_sat_set_time').style.display = 'none';
            document.getElementById('bus_sch_sat_start').value = '';
            document.getElementById('bus_sch_sat_end').value = '';
            document.getElementById('bus_sch_sat_24_hours').value='2';
            document.getElementById('bus_sch_sat_start').removeAttribute('required');
            document.getElementById('bus_sch_sat_end').removeAttribute('required');
        }
    });
    
    $("input[name='bus_sch_sun_24']").on("click", function() {
        if($(this).val() == 1) {
            document.getElementById('bus_sch_sun_set_time').style.display = 'block';
            document.getElementById('bus_sch_sun_start').value = '';
            document.getElementById('bus_sch_sun_end').value = '';
            document.getElementById('bus_sch_sun_24_set_time').value='1';
            document.getElementById('bus_sch_sun_start').setAttribute('required', 'required');
            document.getElementById('bus_sch_sun_end').setAttribute('required', 'required');

        }else if ($(this).val() == 2) {
            document.getElementById('bus_sch_sun_set_time').style.display = 'none';
            document.getElementById('bus_sch_sun_start').value = '';
            document.getElementById('bus_sch_sun_end').value = '';
            document.getElementById('bus_sch_sun_24_hours').value='2';
            document.getElementById('bus_sch_sun_start').removeAttribute('required');
            document.getElementById('bus_sch_sun_end').removeAttribute('required');
        }
    });


    $("input[name='bus_sch_mon_status']").on("click", function() {
        if ($(this).val() == 0) {
            $("#bus_sch_mon_start").attr("disabled", "disabled");
            $("#bus_sch_mon_end").attr("disabled", "disabled");

            document.getElementById('bus_sch_mon_start').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_mon_end').style.backgroundColor="gainsboro";
            
            document.getElementById('bus_sch_mon_24_div').style.display = 'none';
            document.getElementById('bus_sch_mon_set_time').style.display = 'none';

            document.getElementById('bus_sch_mon_start').value = '';
            document.getElementById('bus_sch_mon_end').value = '';
            document.getElementById('bus_sch_mon_start').required = false;
            document.getElementById('bus_sch_mon_end').required = false;


        } else {
            $("#bus_sch_mon_start").removeAttr('disabled');
            $("#bus_sch_mon_end").removeAttr('disabled');

            document.getElementById('bus_sch_mon_24_div').style.display = 'block';
 
            var bus_sch_mon_start_var = document.getElementById('bus_sch_mon_start');
            var bus_sch_mon_start_color = document.getElementById('bus_sch_mon_start').style.backgroundColor="white";
            bus_sch_mon_start_var.setAttribute("required", "");

            var bus_sch_mon_end_var = document.getElementById('bus_sch_mon_end');
            var bus_sch_mon_end_color = document.getElementById('bus_sch_mon_end').style.backgroundColor="white";
            bus_sch_mon_end_var.setAttribute("required", "");
        }
    });

    $("input[name='bus_sch_tue_status']").on("click", function() {
        if ($(this).val() == 0) {
            $("#bus_sch_tue_start").attr("disabled", "disabled");
            $("#bus_sch_tue_end").attr("disabled", "disabled");
            
            document.getElementById('bus_sch_tue_24_div').style.display = 'none';
            document.getElementById('bus_sch_tue_set_time').style.display='none';

            document.getElementById('bus_sch_tue_start').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_tue_end').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_tue_start').value = '';
            document.getElementById('bus_sch_tue_end').value = '';
            document.getElementById('bus_sch_tue_start').required = false;
            document.getElementById('bus_sch_tue_end').required = false;
        } else {
            $("#bus_sch_tue_start").removeAttr('disabled');
            $("#bus_sch_tue_end").removeAttr('disabled');

            document.getElementById('bus_sch_tue_24_div').style.display = 'block';
            var pfl_sch_mon_start_color = document.getElementById('bus_sch_tue_start').style.backgroundColor="white";
            var bus_sch_tue_start_var = document.getElementById('bus_sch_tue_start');
            bus_sch_tue_start_var.setAttribute("required", "");

            var bus_sch_tue_end_color = document.getElementById('bus_sch_tue_end').style.backgroundColor="white";
            var bus_sch_tue_end_var = document.getElementById('bus_sch_tue_end');
            bus_sch_tue_end_var.setAttribute("required", "");
        }
    });



    $("input[name='bus_sch_wed_status']").on("click", function() {
        //alert($(this).val());
        if ($(this).val() == 0) {
            $("#bus_sch_wed_start").attr("disabled", "disabled");
            $("#bus_sch_wed_end").attr("disabled", "disabled");

            document.getElementById('bus_sch_wed_24_div').style.display = 'none';
            //document.getElementById('bus_sch_wed_24').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_wed_set_time').style.display='none';

            document.getElementById('bus_sch_wed_start').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_wed_end').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_wed_start').value = '';
            document.getElementById('bus_sch_wed_end').value = '';
            document.getElementById('bus_sch_wed_start').required = false;
            document.getElementById('bus_sch_wed_end').required = false;
        } else {
            $("#bus_sch_wed_start").removeAttr('disabled');
            $("#bus_sch_wed_end").removeAttr('disabled');

            document.getElementById('bus_sch_wed_24_div').style.display = 'block';

            var bus_sch_wed_start_color = document.getElementById('bus_sch_wed_start').style.backgroundColor="white";
            var bus_sch_wed_start_var = document.getElementById('bus_sch_wed_start');
            bus_sch_wed_start_var.setAttribute("required", "");
            
            var bus_sch_wed_end_color = document.getElementById('bus_sch_wed_end').style.backgroundColor="white";
            var bus_sch_wed_end_var = document.getElementById('bus_sch_wed_end');
            bus_sch_wed_end_var.setAttribute("required", "");
        }
    });

    $("input[name='bus_sch_thu_status']").on("click", function() {
        if ($(this).val() == 0) {
            $("#bus_sch_thu_start").attr("disabled", "disabled");
            $("#bus_sch_thu_end").attr("disabled", "disabled");

            document.getElementById('bus_sch_thu_24_div').style.display = 'none';
            //document.getElementById('bus_sch_thu_24').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_thu_set_time').style.display='none';

            document.getElementById('bus_sch_thu_start').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_thu_end').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_thu_start').value = '';
            document.getElementById('bus_sch_thu_end').value = '';
            document.getElementById('bus_sch_thu_start').required = false;
            document.getElementById('bus_sch_thu_end').required = false;
        } else {
            $("#bus_sch_thu_start").removeAttr('disabled');
            $("#bus_sch_thu_end").removeAttr('disabled');

            document.getElementById('bus_sch_thu_24_div').style.display = 'block';

            var bus_sch_thu_start_color = document.getElementById('bus_sch_thu_start').style.backgroundColor="white";
            var bus_sch_thu_start_var = document.getElementById('bus_sch_thu_start');
            bus_sch_thu_start_var.setAttribute("required", "");

            var bus_sch_thu_end_color = document.getElementById('bus_sch_thu_end').style.backgroundColor="white";
            var bus_sch_thu_end_var = document.getElementById('bus_sch_thu_end');
            bus_sch_thu_end_var.setAttribute("required", "");
        }
    });


    $("input[name='bus_sch_fri_status']").on("click", function() {
        if ($(this).val() == 0) {
            $("#bus_sch_fri_start").attr("disabled", "disabled");
            $("#bus_sch_fri_end").attr("disabled", "disabled");

            document.getElementById('bus_sch_fri_24_div').style.display = 'none';
            //document.getElementById('bus_sch_fri_24').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_fri_set_time').style.display='none';

            document.getElementById('bus_sch_fri_start').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_fri_end').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_fri_start').value = '';
            document.getElementById('bus_sch_fri_end').value = '';
            document.getElementById('bus_sch_fri_start').required = false;
            document.getElementById('bus_sch_fri_end').required = false;
        } else {
            $("#bus_sch_fri_start").removeAttr('disabled');
            $("#bus_sch_fri_end").removeAttr('disabled');

            document.getElementById('bus_sch_fri_24_div').style.display = 'block';

            var bus_sch_fri_start_color = document.getElementById('bus_sch_fri_start').style.backgroundColor="white";
            var bus_sch_fri_start_var = document.getElementById('bus_sch_fri_start');
            bus_sch_fri_start_var.setAttribute("required", "");

            var bus_sch_fri_end_color = document.getElementById('bus_sch_fri_end').style.backgroundColor="white";
            var bus_sch_fri_end_var = document.getElementById('bus_sch_fri_end');
            bus_sch_fri_end_var.setAttribute("required", "");
        }
    });


    $("input[name='bus_sch_sat_status']").on("click", function() {
        if ($(this).val() == 0) {
            $("#bus_sch_sat_start").attr("disabled", "disabled");
            $("#bus_sch_sat_end").attr("disabled", "disabled");

            document.getElementById('bus_sch_sat_24_div').style.display = 'none';
            //document.getElementById('bus_sch_sat_24').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_sat_set_time').style.display='none';

            document.getElementById('bus_sch_sat_start').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_sat_end').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_sat_start').value = '';
            document.getElementById('bus_sch_sat_end').value = '';
            document.getElementById('bus_sch_sat_start').required = false;
            document.getElementById('bus_sch_sat_end').required = false;
        } else {
            $("#bus_sch_sat_start").removeAttr('disabled');
            $("#bus_sch_sat_end").removeAttr('disabled');

            document.getElementById('bus_sch_sat_24_div').style.display = 'block';
            
            var bus_sch_sat_start_color = document.getElementById('bus_sch_sat_start').style.backgroundColor="white";
            var bus_sch_sat_start_var = document.getElementById('bus_sch_sat_start');
            bus_sch_sat_start_var.setAttribute("required", "");

            var bus_sch_sat_end_color = document.getElementById('bus_sch_sat_end').style.backgroundColor="white";
            var bus_sch_sat_end_var = document.getElementById('bus_sch_sat_end');
            bus_sch_sat_end_var.setAttribute("required", "");
        }
    });

    $("input[name='bus_sch_sun_status']").on("click", function() {
        if ($(this).val() == 0) {
            $("#bus_sch_sun_start").attr("disabled", "disabled");
            $("#bus_sch_sun_end").attr("disabled", "disabled");

            document.getElementById('bus_sch_sun_24_div').style.display = 'none';
            //document.getElementById('bus_sch_sun_24').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_sun_set_time').style.display='none';

            document.getElementById('bus_sch_sun_start').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_sun_end').style.backgroundColor="gainsboro";
            document.getElementById('bus_sch_sun_start').value = '';
            document.getElementById('bus_sch_sun_end').value = '';
            document.getElementById('bus_sch_sun_start').required = false;
            document.getElementById('bus_sch_sun_end').required = false;
        } else {
            $("#bus_sch_sun_start").removeAttr('disabled');
            $("#bus_sch_sun_end").removeAttr('disabled');

            document.getElementById('bus_sch_sun_24_div').style.display = 'block';
            
            var bus_sch_sun_start_color = document.getElementById('bus_sch_sun_start').style.backgroundColor="white";
            var bus_sch_sun_start_var = document.getElementById('bus_sch_sun_start');
            bus_sch_sun_start_var.setAttribute("required", "");

            var bus_sch_sun_end_color = document.getElementById('bus_sch_sun_end').style.backgroundColor="white";
            var bus_sch_sun_end_var = document.getElementById('bus_sch_sun_end');
            bus_sch_sun_end_var.setAttribute("required", "");
        }
    });
});