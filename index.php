<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>mapthebelonging</title>
    <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/style.css"/>
    <!--    <script src="./index.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript" src="js/signInFunctions.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<!--<body>-->
<body>

<div class="alert alert-danger" id="toast-warning">
    <div class="toast-header d-inline-block " id="toast-header-warning">
        <strong class="mr-auto text-primary d-block">Warning</strong>
    </div>
    <div class="toast-body">
        <p><strong></strong></p>
    </div>
</div>


<div id="popUp" class="pop-up">
    <form id="form">
        <div class="container">
            <h4>Save Location</h4>
            <hr>
            <h6>User Details</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-age">Age</label>
                        <select class="form-select" aria-label="Default select example" id="selector-age">
                            <option value="1">0-19</option>
                            <option value="2">20-39</option>
                            <option value="3">40-60</option>
                            <option value="4">61+</option>
                            <option value="0" selected>Prefer not to answer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-religion">Religion and Spirituality</label>
                        <select class="form-select" aria-label="Default select example" id="selector-religion">
                            <option value="32">Agnostic</option>
                            <option value="33">Atheist</option>
                            <option value="34">Buddhist</option>
                            <option value="35">Eastern Orthodox</option>
                            <option value="36">Hindu, Jain, or Sikh</option>
                            <option value="37">Humanist</option>
                            <option value="38">Jewish</option>
                            <option value="39">Muslim</option>
                            <option value="40">None/Nonreligious</option>
                            <option value="41">Protestant</option>
                            <option value="42">Roman Catholic</option>
                            <option value="43">Unitarian Universalist</option>
                            <option value="44">Other</option>
                            <option value="0" selected>Prefer not to answer</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-gender">Gender Identity and Sexual Orientation</label>
                        <select class="form-select" aria-label="Default select example" id="selector-gender">
                            <option value="15">Female</option>
                            <option value="16">Male</option>
                            <option value="17">Transgender</option>
                            <option value="18">Gender Queer</option>
                            <option value="19">Gender Non-Conforming</option>
                            <option value="20">Gender Non-Binary</option>
                            <option value="21">Lesbian</option>
                            <option value="22">Gay</option>
                            <option value="23">Bisexual</option>
                            <option value="24">Queer</option>
                            <option value="25">Pansexual</option>
                            <option value="26">Asexual</option>
                            <option value="27">Agender</option>
                            <option value="28">Demisexual</option>
                            <option value="29">Straight</option>
                            <option value="30">Intersex</option>
                            <option value="31">Two-Spirit</option>
                            <option value="0" selected>Prefer not to answer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-race">Race, Ethnicity and National of Origin</label>
                        <select class="form-select" aria-label="Default select example" id="selector-race">
                            <option value="5">Person of Color</option>
                            <option value="6">Black</option>
                            <option value="7">Indigenous/Native American</option>
                            <option value="8">Latinx</option>
                            <option value="9">Asian/Pacific Islander</option>
                            <option value="10">White</option>
                            <option value="11">Middle Eastern/North African/Arab</option>
                            <option value="12">Multiracial / Two or more races</option>
                            <option value="13">Immigrant</option>
                            <option value="14">Foreign Born Person</option>
                            <option value="0" selected>Prefer not to answer</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-disability">Person with a disability</label>
                        <select class="form-select" aria-label="Default select example" id="selector-disability">
                            <option value="45">Cognitive</option>
                            <option value="46">Emotional</option>
                            <option value="47">Hearing</option>
                            <option value="48">Mental</option>
                            <option value="49">Physical</option>
                            <option value="50">Visual</option>
                            <option value="0" selected>Prefer not to answer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-socioeconomy">Socioeconomic Class</label>
                        <select class="form-select" aria-label="Default select example" id="selector-socioeconomy">
                            <option value="51">Working class</option>
                            <option value="52">Lower middle class</option>
                            <option value="53">Upper middle class</option>
                            <option value="54">Upper class</option>
                            <option value="0" selected>Prefer not to answer</option>
                        </select>
                    </div>
                </div>
            </div>


        </div>


        <div class="row">
            <div class="form-group">
                <h6>Description</h6>
                <textarea class=" form-control mx-2" id='description' placeholder='Description' required
                          style="width: 100%"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <button style="margin-left: 30%" type="button" class="btn btn-primary " onclick="saveData()">Save
                </button>
                <button style="margin-left: 1rem" type="button" class="btn btn-danger " onclick="cancelSave()">Cancel
                </button>
            </div>
        </div>


    </form>

</div>

<div id="filterPopUp" class="filter-pop-up">
    <form id="formFilter">
        <div class="container">
            <h4>Filter Locations</h4>
            <hr>
            <h6>User Details</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-filter-age">Age</label>
                        <select class="form-select" aria-label="Default select example" id="selector-filter-age">
                            <option value="-1" selected>Filter not selected</option>
                            <option value="1">0-19</option>
                            <option value="2">20-39</option>
                            <option value="3">40-60</option>
                            <option value="4">61+</option>
                            <option value="0">Prefer not to answer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-filter-religion">Religion and Spirituality</label>
                        <select class="form-select" aria-label="Default select example" id="selector-filter-religion">
                            <option value="-1" selected>Filter not selected</option>
                            <option value="32">Agnostic</option>
                            <option value="33">Atheist</option>
                            <option value="34">Buddhist</option>
                            <option value="35">Eastern Orthodox</option>
                            <option value="36">Hindu, Jain, or Sikh</option>
                            <option value="37">Humanist</option>
                            <option value="38">Jewish</option>
                            <option value="39">Muslim</option>
                            <option value="40">None/Nonreligious</option>
                            <option value="41">Protestant
                            <option value="42">Roman Catholic</option>
                            <option value="43">Unitarian Universalist</option>
                            <option value="44">Other</option>
                            <option value="0">Prefer not to answer</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-filter-gender">Gender Identity and Sexual Orientation</label>
                        <select class="form-select" aria-label="Default select example" id="selector-filter-gender">
                            <option value="-1" selected>Filter not selected</option>
                            <option value="15">Female</option>
                            <option value="16">Male</option>
                            <option value="17">Transgender</option>
                            <option value="18">Gender Queer</option>
                            <option value="19">Gender Non-Conforming</option>
                            <option value="20">Gender Non-Binary</option>
                            <option value="21">Lesbian</option>
                            <option value="22">Gay</option>
                            <option value="23">Bisexual</option>
                            <option value="24">Queer</option>
                            <option value="25">Pansexual</option>
                            <option value="26">Asexual</option>
                            <option value="27">Agender</option>
                            <option value="28">Demisexual</option>
                            <option value="29">Straight</option>
                            <option value="30">Intersex</option>
                            <option value="31">Two-Spirit</option>
                            <option value="0">Prefer not to answer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-filter-race">Race, Ethnicity and National of Origin</label>
                        <select class="form-select" aria-label="Default select example" id="selector-filter-race">
                            <option value="-1" selected>Filter not selected</option>
                            <option value="5">Person of Color</option>
                            <option value="6">Black</option>
                            <option value="7">Indigenous/Native American</option>
                            <option value="8">Latinx</option>
                            <option value="9">Asian/Pacific Islander</option>
                            <option value="10">White</option>
                            <option value="11">Middle Eastern/North African/Arab</option>
                            <option value="12">Multiracial / Two or more races</option>
                            <option value="13">Immigrant</option>
                            <option value="14">Foreign Born Person</option>
                            <option value="0">Prefer not to answer</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-filter-disability">Person with a disability</label>
                        <select class="form-select" aria-label="Default select example" id="selector-filter-disability">
                            <option value="-1" selected>Filter not selected</option>
                            <option value="45">Cognitive</option>
                            <option value="46">Emotional</option>
                            <option value="47">Hearing</option>
                            <option value="48">Mental</option>
                            <option value="49">Physical</option>
                            <option value="50">Visual</option>
                            <option value="0">Prefer not to answer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selector-filter-socioeconomy">Socioeconomic Class</label>
                        <select class="form-select" aria-label="Default select example"
                                id="selector-filter-socioeconomy">
                            <option value="-1" selected>Filter not selected</option>
                            <option value="51">Working class</option>
                            <option value="52">Lower middle class</option>
                            <option value="53">Upper middle class</option>
                            <option value="54">Upper class</option>
                            <option value="0">Prefer not to answer</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <button style="margin-left: 30%" type="button" class="btn btn-primary "
                                onclick="resetFilter()">Reset
                        </button>
                        <button style="margin-left: 1rem" type="button" class="btn btn-danger "
                                onclick="cancelFilter()">Cancel
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<div id="map" style="position: relative;width: 100%"></div>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?keyapi_key&callback=initMap&libraries=&v=weekly"
        async></script>


</body>

</html>
