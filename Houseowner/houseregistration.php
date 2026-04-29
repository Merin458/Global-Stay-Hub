<?php
include_once('header.php');
?>
<script src="../jquery-3.6.0.min.js"> </script>
<script>
  $(document).ready(function () {
    $("input[name='city']").change(function () {
      var country_id = $("input[name='city']:checked").val();

      // alert(country_id);
      $.ajax({
        url: "gethouse.php",
        method: "POST",
        data: { countryid: country_id },
        success: function (response) {
          $("#selectresult").html(response);
        },
        error: function () {
          $("#selectresult").html("Error occurred while getting location!");
        }
      });  
    });

    $("#countrySelect").change(function () {
      var country_id = $(this).val();

      $.ajax({
        url: "getcity.php",
        method: "POST",
        data: { countryid: country_id },
        success: function (response) {
          $("#selectresult").html(response);
        },
        error: function () {
          $("#selectresult").html("Error occurred while getting location!");
        }
      });
    });
  
  $("form").submit(function(e) {
      $(".error-message").remove();
      let valid = true;

      if ($("input[name='hname']").val().trim() === "") {
        $("input[name='hname']").after('<div class="error-message text-red-500 text-sm mt-1">Please enter House Name</div>');
        valid = false;
      }
      if ($("input[name='desc']").val().trim() === "") {
        $("input[name='desc']").after('<div class="error-message text-red-500 text-sm mt-1">Please enter Description</div>');
        valid = false;
      }
      let persons = $("input[name='hnopersons']").val().trim();
      if (persons === "" || isNaN(persons) || parseInt(persons) <= 0) {
        $("input[name='hnopersons']").after('<div class="error-message text-red-500 text-sm mt-1">Enter a valid number of persons</div>');
        valid = false;
      }
      let rate = $("input[name='rate']").val().trim();
      if (rate === "" || isNaN(rate) || parseFloat(rate) <= 0) {
        $("input[name='rate']").after('<div class="error-message text-red-500 text-sm mt-1">Enter a valid rate</div>');
        valid = false;
      }
      let images = $("#himages")[0].files;
      if (images.length === 0) {
        $("#himages").after('<div class="error-message text-red-500 text-sm mt-1">Select at least one image</div>');
        valid = false;
      } else {
        for (let i = 0; i < images.length; i++) {
          if (!images[i].type.startsWith('image/')) {
            $("#himages").after('<div class="error-message text-red-500 text-sm mt-1">Only image files are allowed</div>');
            valid = false;
            break;
          }
        }
      }
      if (!$("input[name='city']:checked").val()) {
        $("input[name='city']").last().after('<div class="error-message text-red-500 text-sm mt-1">Select City or University</div>');
        valid = false;
      }

      if (!valid) e.preventDefault();
    });
    });
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Main Styling -->
  <link href="../assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5" rel="stylesheet" />

  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
  <!-- Navbar -->
  <nav
    class="absolute top-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 mt-6 mb-4 shadow-none lg:flex-nowrap lg:justify-start">
    <div class="container flex items-center justify-between py-0 flex-wrap-inherit">
      <button navbar-trigger
        class="px-3 py-1 ml-2 leading-none transition-all bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-lg ease-soft-in-out lg:hidden"
        type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6 h-6 bg-none">
          <span bar1
            class="w-5.5 rounded-xs duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
          <span bar2
            class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
          <span bar3
            class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
        </span>
      </button>
      <div navbar-menu
        class="items-center flex-grow transition-all ease-soft duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-xl lg:flex lg:basis-auto">
        <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
          <li>
            <a class="flex items-center px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75"
              aria-current="page" href="../pages/dashboard.html">
              <i class="mr-1 text-white lg-max:text-slate-700 fa fa-chart-pie opacity-60"></i>
              Dashboard
            </a>
          </li>
          <li>
            <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75"
              href="../pages/profile.html">
              <i class="mr-1 text-white lg-max:text-slate-700 fa fa-user opacity-60"></i>
              Profile
            </a>
          </li>
          <li>
            <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75"
              href="../pages/sign-up.html">
              <i class="mr-1 text-white lg-max:text-slate-700 fas fa-user-circle opacity-60"></i>
              Sign Up
            </a>
          </li>
          <li>
            <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75"
              href="../pages/sign-in.html">
              <i class="mr-1 text-white lg-max:text-slate-700 fas fa-key opacity-60"></i>
              Sign In
            </a>
          </li>
        </ul>
        <!-- online builder btn  -->
        <!-- <li class="flex items-center">
            <a
              class="leading-pro ease-soft-in border-white/75 text-xs tracking-tight-soft rounded-3.5xl hover:border-white/75 hover:scale-102 active:hover:border-white/75 active:hover:scale-102 active:opacity-85 active:shadow-soft-xs active:border-white/75 bg-white/10 hover:bg-white/10 active:hover:bg-white/10 mr-2 mb-0 inline-block cursor-pointer border border-solid py-2 px-8 text-center align-middle font-bold uppercase text-white shadow-none transition-all hover:text-white hover:opacity-75 hover:shadow-none active:scale-100 active:bg-white active:text-black active:hover:text-white active:hover:opacity-75 active:hover:shadow-none"
              target="_blank"
              href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053"
              >Online Builder</a
            >
          </li> -->
      </div>
    </div>
  </nav>

  <main class="mt-0 transition-all duration-200 ease-soft-in-out">
    <section class="min-h-screen mb-32">
      <div
        class="relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-center bg-cover min-h-50-screen rounded-xl"
        style="
            background-image: url('../uploads/housereg1.jpeg');
          ">
        <span
          class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-60"></span>
        <div class="container z-10">
          <div class="flex flex-wrap justify-center -mx-3">
            <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
              <h1 class="mt-12 mb-2 text-white">Welcome!</h1>
              <p class="text-white">
                Welcome to the house registration page. Here you can register your house for Rent or lease.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
          <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
            <div
              class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                <h5>House Registration</h5>
              </div>

              <div class="flex-auto p-6">
                <form role="form text-left" action="houseregistrationaction.php" method="post" class="forms-sample" enctype="multipart/form-data">
                  <div class="mb-4">
                    <label>House Name</label>
                    <input type="text"
                      class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                      placeholder="Name" aria-label="Name"  name="hname"/>
                  </div>
                  <div class="mb-4">
                    <label>Description</label>
                    <input type="text"
                      class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                      placeholder="Description" aria-label="Description" name="desc" />
                  </div>
                  <div class="mb-4">
                    <label>No.of Persons</label>
                    <input type="text"
                      class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                      placeholder="No.of persons" aria-label="number of persons" name="hnopersons"/>
                  </div>
                  <div class="mb-4">
                    <label>Rate</label>
                    <input type="text"
                      class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                      placeholder="Rate" aria-label="Rate" name="rate" />
                  </div>
                  
                  <div class="mb-4">
                            <label>House Images</label>
                            <input type="file"
                              class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                              name="himages[]" 
                              id="himages"
                              multiple
                              accept="image/*"
                            />
 
                  </div>


                  <div class="mb-4" id="">

                    <label>Select</label><br>
                    <input type="radio" name="city" value="city" id="select" />
                    <label for="city">City </label>
                    <input type="radio" name="city" value="university" id="select" />
                    <label for="university">University</label>
                  </div>
                   <div class="mb-4" id="selectresult">
                    
                  </div>
                  <div class="text-center">
                    <button type="submit"
                      class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white" name="submit">
                      Register
                    </button>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php
    include_once('footer.php');
    ?>