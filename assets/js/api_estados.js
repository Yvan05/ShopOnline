/* global thisClass */
$.ajax({
            url: 'https://www.universal-tutorial.com/api/getaccesstoken',
            method: 'GET',
            headers: {
                "Accept": "application/json",
                "api-token": "Hb8Lxl79lFOGdocMfOul3h4CPuKYZxNxaL55GeQUrcAXIRFt8sWMszO5oHvSzLuxDVs",
                "user-email": "yaelivan16@gmail.com"
            },
            success: function (data) {
                if(data.auth_token){
                    var auth_token = data.auth_token;
                    $.ajax({
                        url: 'https://www.universal-tutorial.com/api/countries/',
                        method: 'GET',
                        headers: {
                            "Authorization": "Bearer " + auth_token,
                            "Accept": "application/json"
                        },
                        success: function (data) {
                            var countries = data;
                            //<option  value="0" selected disabled hidden>Choose here</option>
                            var comboCountries = "<option selected disabled hidden>Choose here</option>";
                            countries.forEach(element => {
                                comboCountries += '<option value="' + element['country_name'] + '">' + element['country_name']+'</option>';
                            });
                            $("#item-details-countryValue").html(comboCountries);
                            // State list
                            $("#item-details-countryValue").on("change", function(){
                                var country = this.value;
                                $.ajax({
                                    url: 'https://www.universal-tutorial.com/api/states/' + country,
                                    method: 'GET',
                                    headers: {
                                        "Authorization": "Bearer " + auth_token,
                                        "Accept": "application/json"
                                    },
                                    success: function (data) {
                                        var states = data;
                                        var comboStates = "<option  selected disabled hidden>Choose here</option>";
                                        states.forEach(element => {
                                            comboStates += '<option value="' + element['state_name'] + '">' + element['state_name'] + '</option>';
                                        });
                                        $("#item-details-stateValue").html(comboStates);
                                        // City list
                                        $("#item-details-stateValue").on("change", function () {
                                            var state = this.value;
                                            $.ajax({
                                                url: 'https://www.universal-tutorial.com/api/cities/' + state,
                                                method: 'GET',
                                                headers: {
                                                    "Authorization": "Bearer " + auth_token,
                                                    "Accept": "application/json"
                                                },
                                                success: function (data) {
                                                    var cities = data;
                                                    var comboCities = "<option selected disabled hidden>Choose here</option>";
                                                    cities.forEach(element => {
                                                        comboCities += '<option value="' + element['city_name'] + '">' + element['city_name'] + '</option>';
                                                    });
                                                    $("#item-details-cityValue").html(comboCities);
                                                   // if (thisClass.cityValue) { $("#item-details-cityValue").val(thisClass.cityValue).trigger("change"); }
                                                },
                                                error: function (e) {
                                                    console.log("Error al obtener countries: " + e);
                                                }
                                            });
                                        });
                                       // if (thisClass.stateValue) { $("#item-details-stateValue").val(thisClass.stateValue).trigger("change"); }
                                    },
                                    error: function (e) {
                                        console.log("Error al obtener countries: " + e);
                                    }
                                });
                            });
                           // if (thisClass.countryValue) { $("#item-details-countryValue").val(thisClass.countryValue).trigger("change"); }
                        },
                        error: function (e) {
                            console.log("Error al obtener countries: " + e);
                        }
                    });
                }
            },
            error: function (e) {
                console.log("Error al obtener countries: " + e);
            }
        });
                   