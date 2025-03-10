document.addEventListener("DOMContentLoaded", function () {
  // Initialize steppers
  const stepper1Element = document.querySelector("#individual-stepper1");
  const stepper2Element = document.querySelector("#juridical-stepper2");
  const stepper3Element = document.querySelector("#transportation-stepper3");

  if (stepper1Element) window.stepper1 = new Stepper(stepper1Element);
  if (stepper2Element) window.stepper2 = new Stepper(stepper2Element);
  if (stepper3Element) window.stepper3 = new Stepper(stepper3Element);
});

// Dashboard navigation
$("#dashboard-link").click(function () {
  $("#dashboard").removeClass("d-none");
  $("#individual, #juridical, #transportation").addClass("d-none");
});

$("#individual-link").click(function () {
  $("#individual").removeClass("d-none");
  $("#dashboard, #juridical, #transportation").addClass("d-none");
});

$("#juridical-link").click(function () {
  $("#juridical").removeClass("d-none");
  $("#dashboard, #individual, #transportation").addClass("d-none");
});

$("#transportation-link").click(function () {
  $("#transportation").removeClass("d-none");
  $("#dashboard, #individual, #juridical").addClass("d-none");
});

// Profile Import Button Functionality
$(document).on("click", ".btn-import", function () {
  console.log("Import button clicked!");
  // Trigger a file input dialog
  const fileInput = document.createElement("input");
  fileInput.type = "file";
  fileInput.accept = "image/*"; // Accept only images
  fileInput.click();

  fileInput.addEventListener("change", function (event) {
    console.log("File selected:", event.target.files);
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        console.log("File loaded:", e.target.result);
        const imgElement = $(".profile-user-img");
        if (imgElement.length) {
          imgElement.attr("src", e.target.result);
        } else {
          console.error("Profile image element not found.");
        }
      };

      reader.readAsDataURL(file);
    } else {
      alert("No file selected.");
    }
  });
});

// Hide below 24 yrs.old
$(function () {
  // Initialize the date picker
  $("#reservationdate").datetimepicker({
    format: "L", // Format: MM/DD/YYYY
  });

  // Event listener for date of birth input
  $("#firstnext").click(function () {
    const dobValue = $("#dobInput").val(); // Get the input value from dobInput
    //  if (!dobValue) return;

    const dobDate = new Date(dobValue); // Parse the input date
    const currentYear = new Date().getFullYear();
    const birthYear = dobDate.getFullYear();

    //  console.log(dobDate, currentYear, birthYear);

    const age = currentYear - birthYear;

    //  console.log(sage);

    //  Toggle visibility of the child form
    if (age < 24) {
      $("#childForm").removeClass("d-none"); // Show the form
    } else {
      $("#childForm").addClass("d-none"); // Hide the form
    }
  });
});

// JURIDICAL
document.addEventListener("DOMContentLoaded", function () {
  let today = new Date();
  let formattedDate =
    (today.getMonth() + 1).toString().padStart(2, "0") +
    "/" +
    today.getDate().toString().padStart(2, "0") +
    "/" +
    today.getFullYear();
  document.getElementById("dobDisplay").value = formattedDate;
});

//navigation

//Select2 
$(document).ready(function () {
  $('.select2').select2({
    selectOnClose: true,
    allowClear: true
    // theme: "bootstrap4"
  });
});

//Province API
document.addEventListener("DOMContentLoaded", function () {
  const regionSelect = $("#region");
  const provinceSelect = $("#province");
  const citySelect = $("#city");
  const barangaySelect = $("#barangay");

  // regionSelect.select2();
  // provinceSelect.select2();
  // citySelect.select2();
  // barangaySelect.select2();

  fetch("https://psgc.gitlab.io/api/regions/")
    .then((response) => response.json())
    .then((data) => {
      data.forEach((region) => {
        regionSelect.append(new Option(region.name, region.code, false, false));
      });
    })
    .catch((error) => console.error("Error fetching regions:", error));

  // Region
  regionSelect.on("change", function () {
    const regionCode = regionSelect.val();

    provinceSelect.empty().append(new Option("Select Province", ""));
    citySelect.empty().append(new Option("Select City", ""));
    barangaySelect.empty().append(new Option("Select Barangay", ""));

    if (!regionCode) return;

    fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/provinces/`)
      .then((response) => response.json())
      .then((data) => {
        data.forEach((province) => {
          provinceSelect.append(new Option(province.name, province.code, false, false));
        });
      })
      .catch((error) => console.error("Error fetching provinces:", error));
  });

  // Province
  provinceSelect.on("change", function () {
    const provinceCode = provinceSelect.val();

    citySelect.empty().append(new Option("Select City", ""));
    barangaySelect.empty().append(new Option("Select Barangay", ""));

    if (!provinceCode) return;

    fetch(
      `https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`
    )
      .then((response) => response.json())
      .then((data) => {
        data.forEach((city) => {
          citySelect.append(new Option(city.name, city.code, false, false));
        });
      })
      .catch((error) => console.error("Error fetching Cities:", error));
  });

  // City
  citySelect.on("change", function () {
    const cityCode = citySelect.val();

    barangaySelect.empty().append(new Option("N/A", "N/A"));

    if (!cityCode) {
      barangaySelect.prop("disabled", true);
      return;
    }

    fetch(`https://psgc.gitlab.io/api/cities/${cityCode}/barangays/`)
      .then((response) => response.json())
      .then((data) => {
        if (data.length === 0) {
          barangaySelect.prop("disabled", true);
          barangaySelect.empty().append(new Option("N/A", "N/A"));
        } else {
          barangaySelect.prop("disabled", false);
          barangaySelect.empty().append(new Option("Select Barangay", ""));

          data.forEach((barangay) => {
            barangaySelect.append(new Option(barangay.name, barangay.code, false, false));
          });
        }
      })
      .catch((error) => {
        console.error("Error fetching Barangays:", error);
        barangaySelect.prop("disabled", true);
        barangaySelect.empty().append(new Option("N/A", "N/A"));
      });
  });
});

$(document).ready(function () {

  // Generate random entity number
  $('#firstname').change(function () {
    let entityNoField = $('#entityNum');

    if ($.trim(entityNoField.val()) === '') {
      $.ajax({
        type: 'POST',
        url: '../pages/server_side/genRandEntity.php',
        dataType: 'text',
        success: function (response) {
          let generatedID = $.trim(response);
          entityNoField.val(generatedID);
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "success",
            title: 'Generated Entity No:' + ' ' + generatedID,
          });
        },
        error: function (xhr, status, error) {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "error",
            title: 'Error generating entity ID:' + ' ' + error,
          });
        }
      });
    }
  });



  // Select individual
  $("#entity1").select2({
    theme: "bootstrap4",
    width: "100%",
    ajax: {
      // url: "/vamos-local/pages/server_side/process_sccdrrmo.php",
      url: "/kyan-vamos-scims/pages/server_side/process_sccdrrmo.php",
      type: "POST",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          searchTerm: params.term,
        };
      },
      processResults: function (response) {
        return {
          results: response,
        };
      },
      cache: true,
    },
  });



  $("#entity1").on("select2:select", function (e) {
    var selectedData = e.params.data;

    $("#entityNum").val(selectedData.id);
    $("#firstname").val(selectedData.firstname);
    $("#middlename").val(selectedData.middlename);
    $("#lastname").val(selectedData.lastname);
    $("#suffix").val(selectedData.suffix);
    $("#contact").val(selectedData.contact);
    $("#civil_status").val(selectedData.civil_status);

    console.log(selectedData);

    // Convert status to lowercase for case-insensitive comparison
    let statusText = selectedData.status.toLowerCase();
    let badge = $("#statusBadge");

    // Fade out, change text & class, then fade back in
    badge.fadeOut(200, function () {
      $(this).text(selectedData.status);
      if (statusText === "verified") {
        $(this).removeClass("badge-primary").addClass("badge-success");
      } else {
        $(this).removeClass("badge-success").addClass("badge-primary");
      }
      $(this).fadeIn(200);
    });


    //Reflect Date of Birth
    var birthdate = selectedData.birthdate ? selectedData.birthdate.replace(/-/g, '/') : 'YYYY/MM/DD';
    $("#dobInput").attr("placeholder", "YYYY/MM/DD").val(birthdate);

    //Reflect Photo
    var baseUrl = "https://vamosmobile.app/sccdrrmo/flutter/images/";
    var photo = selectedData.photo ? selectedData.photo : "default.jpg";
    var imgElement = $("#photo");
    imgElement.fadeOut(200, function () {
      $(this).attr("src", baseUrl + photo).fadeIn(200);
    });

    //Reflect Gender
    var genderValue = selectedData.gender ? selectedData.gender.toLowerCase() : '';
    if (genderValue === 'male' || genderValue === 'female') {
      $("#gender").val(genderValue.charAt(0).toUpperCase() + genderValue.slice(1)).trigger("change");
    }

    // Reflect Civil Status
    if (selectedData.civil_status) {
      let civilStatusValue = selectedData.civil_status.trim().toLowerCase();

      // Mapping backend values to match select options
      let civilStatusMap = {
        "single": "Single",
        "married": "Married",
        "widowed": "Widow/Widower",
        "divorced": "Seperated/Annulled",
        "separated": "Seperated/Annulled",
        "annulled": "Seperated/Annulled",
        "partner": "Living with Partner",
        "living with partner": "Living with Partner"
      };

      let mappedStatus = civilStatusMap[civilStatusValue] || ""; // Default to empty if no match

      $("#civilstatus").val(mappedStatus).trigger("change");
    }

    // Reflect Religion
    if (selectedData.religion) {
      let religionValue = selectedData.religion.trim().toLowerCase();

      // Mapping backend values to match select options
      let religionMap = {
        "roman catholic": "Roman Catholic",
        "catholic": "Roman Catholic",
        "bible baptist": "Bible Baptist",
        "baptist conference": "Baptist Conference of the Philippines",
        "church of christ": "Church of Christ of the Latter Day Saints",
        "latter day saints": "Church of Christ of the Latter Day Saints",
        "mormon": "Church of Christ of the Latter Day Saints",
        "muslim": "Muslim",
        "islam": "Muslim",
        "dios amahan": "Dios Amahan",
        "protestant": "Protestant",
        "jehova's witness": "Jehova's Witness",
        "jehovah witness": "Jehova's Witness",
        "ladder of praise": "Ladder of Praise",
        "baptist fellowship": "Baptist Fellowship",
        "hindu": "Hinduism",
        "hinduism": "Hinduism",
        "iglesia ni cristo": "Iglesia ni Cristo",
        "seventh day adventist": "Seventh Day Adventist",
        "sda": "Seventh Day Adventist",
        "born again": "Born Again"
      };

      let mappedReligion = religionMap[religionValue] || ""; // Default to empty if no match

      $("#religion").val(mappedReligion).trigger("change");
    }

    // Normalize religion value and set it correctly in the dropdown
    var religionValue = selectedData.religion ? selectedData.religion.trim() : '';

    $("#religion option").each(function () {
      if ($(this).text().toLowerCase() === religionValue.toLowerCase()) {
        $("#religion").val($(this).text()).trigger("change");
      }
    });
  });
});

// $(document).ready(function () {
//   $("#dobInput").datepicker({
//     dateFormat: "yy/mm/dd", // YYYY/MM/DD format
//     showAnim: "fadeIn", // Adds a smooth opening effect
//     onClose: function (dateText, inst) {
//       if (dateText) {
//         let formattedDate = dateText.replace(/-/g, "/"); // Ensure correct format
//         $(this).val(formattedDate);
//       }
//     }
//   });
// });


// $(document).on("submit", "#personalInfoForm", function (e) {
//   e.preventDefault(); // Prevent form submission if validation fails

//   let isValid = true; // Assume form is valid
//   let errorMessage = "";

//   // Loop through all required inputs inside the form
//   $("#personalInfoForm input[required], #personalInfoForm select[required]").each(function () {
//     if (!$(this).val().trim()) {
//       isValid = false;
//       errorMessage += $(this).attr("name") + " is required.\n"; // Collect error messages
//       $(this).addClass("is-invalid"); // Add Bootstrap error class (if using Bootstrap)
//     } else {
//       $(this).removeClass("is-invalid"); // Remove error class if fixed
//     }
//   });

//   if (!isValid) {
//     alert("Please fill in all required fields:\n" + errorMessage);
//     return; // Stop execution if validation fails
//   }

//   // If all required fields are filled, proceed with FormData creation
//   let formData = new FormData($("#personalInfoForm")[0]);

//   $.ajax({
//     url: "your-server-endpoint.php",
//     type: "POST",
//     data: formData,
//     processData: false,
//     contentType: false,
//     success: function (response) {
//       console.log("Success:", response);
//     },
//     error: function (xhr, status, error) {
//       console.error("Error:", error);
//     }
//   });
// });


$(document).ready(function () {
  $("#formSave").click(function (e) {
    e.preventDefault(); // Prevent form submission until validation passes

    let isValid = true;
    let errorMessage = "";

    // Validate required fields in both forms
    $("#personalInfoForm, #addressForm")
      .find("input[required], select[required], textarea[required]")
      .each(function () {
        if (!$(this).val().trim()) {
          isValid = false;
          let fieldName = $(this).attr("name") || "This field"; // Get field name if available
          errorMessage += `${fieldName} is required.\n`;
          $(this).addClass("is-invalid"); // Add Bootstrap error class
        } else {
          $(this).removeClass("is-invalid"); // Remove error class if fixed
        }
      });

    if (!isValid) {
      Swal.fire({
        icon: "error",
        title: "Missing Required Fields",
        text: errorMessage,
        confirmButtonText: "OK",
      });
      return; // Stop execution if validation fails
    }

    // Create FormData objects for both forms
    let formData = new FormData($("#personalInfoForm")[0]);
    let addressFormData = new FormData($("#addressForm")[0]);

    // Extract values
    let photoValue = $("#photo").attr("src") || "";
    let extractedPhotoValue = photoValue.includes("/images/") ? photoValue.split("/images/")[1] : photoValue;
    let entityNumValue = $("#entityNum").val() || "";
    let statusBadgeValue = $("#statusBadge").text().trim() || "Pending"; // Default if empty

    // Append extra data
    formData.append("photo", extractedPhotoValue);
    formData.append("entityNum", entityNumValue);
    formData.append("status", statusBadgeValue);

    // Append addressFormData fields to formData
    for (let [key, value] of addressFormData.entries()) {
      formData.append(key, value);
    }

    // Debugging: Log all form data (optional)
    console.log("FormData Entries:");
    for (let pair of formData.entries()) {
      console.log(pair[0] + ": " + pair[1]);
    }

    // AJAX Request
    $.ajax({
      url: "../pages/server_side/Create/individual_data.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            toast: true,
            position: "top-end",
            icon: "success",
            title: "Record saved successfully!",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });

          // Reset forms
          $("#personalInfoForm")[0].reset();
          $("#addressForm")[0].reset();
          $("#entityNum").prop("disabled", false).val("").prop("disabled", true);
          $(".select2").val(null).trigger("change"); // Reset Select2 dropdowns
          $("#photo").attr("src", "default.jpg");
          $("#statusBadge").text("");
        } else {
          Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "Error: " + response.message,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", error);
        console.error("Response Text:", xhr.responseText);

        if (!xhr.responseText.trim()) {
          Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "Server returned an empty response.",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
          return;
        }

        try {
          let jsonResponse = JSON.parse(xhr.responseText);
          Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "Error: " + jsonResponse.message,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
        } catch (e) {
          Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "Invalid JSON response from server.",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
          });
        }
      },
    });
  });
});



//<---Educational Background JQuery Code--->
const table = new DataTable('#education', {
  ordering: false, // Disables sorting on all columns
  searching: false, // Disables the search box
  paging: false, // Disables pagination (optional, if needed)
  info: false // Hides "Showing X of Y entries" info (optional)
});

$(document).ready(function () {
  //Date range picker
  $(".reservation").daterangepicker();

  $("#datetimepicker").daterangepicker({
    autoUpdateInput: false,
    locale: {
      format: "MM/DD/YYYY",
      cancelLabel: "Clear"
    }
  });

  // Update input when date is selected
  $("#datetimepicker").on("apply.daterangepicker", function (ev, picker) {
    $(this).val(picker.startDate.format("MM/DD/YYYY") + " - " + picker.endDate.format("MM/DD/YYYY"));
  });

  // Clear input when "Cancel" is clicked
  $("#datetimepicker").on("cancel.daterangepicker", function () {
    $(this).val("");
  });


  // Initialize Select2 and Date Range Picker for the first row
  // $(".select2").select2();
  initializeDateRangePicker($(".reservation")); // Initialize for the first row

  // Function to initialize Date Range Picker
  function initializeDateRangePicker(element) {
    element.daterangepicker({
      autoUpdateInput: false,
      locale: {
        format: "MM/DD/YYYY",
        cancelLabel: "Clear"
      }
    });

    // Update input when date is selected
    element.on("apply.daterangepicker", function (ev, picker) {
      $(this).val(picker.startDate.format("MM/DD/YYYY") + " - " + picker.endDate.format("MM/DD/YYYY"));
    });

    // Clear input when "Cancel" is clicked
    element.on("cancel.daterangepicker", function () {
      $(this).val("");
    });
  }

  $(document).on("click", ".addRow", function () {

    var firstRow = $("#education-tbody tr:first");
    // Destroy Select2 before cloning
    firstRow.find("select.select2").select2("destroy");

    // Clone the first row
    var newRow = firstRow.clone();

    // Restore Select2 in the original row
    firstRow.find("select.select2").select2();

    // Clear input/select values in the new row
    newRow.find("input, select").val("");

    // Remove duplicate IDs to avoid conflicts
    newRow.find("[id]").each(function () {
      $(this).removeAttr("id");
    });

    // Reinitialize Select2 for the new row
    newRow.find("select.select2").select2();

    // Ensure the date range picker is initialized for the new row
    var datepickerInput = newRow.find(".reservation");
    datepickerInput.daterangepicker("destroy"); // Destroy any existing instance
    initializeDateRangePicker(datepickerInput); // Reinitialize

    // Change Add button to Remove button
    newRow.find(".addRow")
      .removeClass("btn-success addRow")
      .addClass("btn-danger removeRow")
      .html('<i class="fa fa-minus"></i>');

    $("#education-tbody").append(newRow); // Append new row to table
  });

  // Remove Row Button Click Event
  $(document).on("click", ".removeRow", function () {
    $(this).closest("tr").remove(); // Remove the clicked row
  });

  $(document).on("click", ".test", function () {
    let tableData = getTableData();

    console.log(getTableData())

    $.ajax({
      url: "../pages/server_side/Create/educational_data.php",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        entityNum: $("#entityNum").val(),
        educationData: getTableData()
      }),
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            toast: true,
            icon: "success",
            title: response.message, // Display success message from server
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
          });
        } else {
          Swal.fire({
            toast: true,
            icon: "error",
            title: response.message, // Display error message from server
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("❌ AJAX Error:", error);
        console.error("❌ Response Text:", xhr.responseText);

        Swal.fire({
          toast: true,
          icon: "error",
          title: "Something went wrong. Please try again.",
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true
        });
      }
    });



  });
});

function getTableData() {
  let tableData = [];

  $("#education-tbody tr").each(function () {
    let rowData = {};

    rowData.level = $(this).find("select.select2").val(); // Select2 Dropdown
    rowData.schoolName = $(this).find("input[name='schoolName']").val(); // School Name
    rowData.period = $(this).find("input.reservation").val(); // Date Range Picker
    rowData.unitsEarned = $(this).find("input[name='unitsEarned']").val(); // Units Earned
    rowData.yearGraduated = $(this).find("input[name='yearGraduated']").val(); // Year Graduated
    rowData.honors = $(this).find("input[name='honors']").val(); // Honors Received
    rowData.remarks = $(this).find("input[name='remarks']").val(); // Remarks

    tableData.push(rowData);
  });

  // Convert table data to JSON string
  // let tableDataJSON = JSON.stringify(tableData);

  // // Append table data to FormData
  // let formData = new FormData($("#personalInfoForm")[0]);
  // formData.append("educationData", tableDataJSON);

  // return formData; // Return the updated FormData object
  // console.log(tableData);
  return tableData;
}
//<---Educational Background JQuery Code--->