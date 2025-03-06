 <h4>Work Experience</h4>
 <hr class="border">
 <div class="row">
    <div class="col">
       <div class="form-group">
          <small><label>Date from/ Date to:</label></small>
          <div class="input-group">
             <div class="input-group-prepend">
                <span class="input-group-text">
                   <i class="far fa-calendar-alt"></i>
                </span>
             </div>
             <input type="text" class="form-control float-right reservation" id="reservation">
          </div>
       </div>
    </div>
    <div class="col">
       <div class="form-group">
          <label>Type of Employment</label>
          <select class="form-control">
             <option>--Select--</option>
             <option>Government Employee</option>
             <option>Private</option>
             <option>Self Employe</option>
          </select>
       </div>
    </div>

    <div class="col">
       <div class="form-group">
          <label>Type of Work </label>
          <select class="form-control">
             <option>--Select--</option>
             <option>Full Time</option>
             <option>Part Time</option>
          </select>
       </div>
    </div>
 </div>

 <h4>Other Information</h4>
 <hr class="border">

 <!-- Container for dynamically added rows -->
 <div id="other-info-container">
    <div class="row other-info-row align-items-end">
       <div class="col">
          <div class="form-group">
             <label>Skills:</label>
             <input type="text" class="form-control" placeholder="Enter Skills">
          </div>
       </div>
       <div class="col">
          <div class="form-group">
             <label>Hobbies:</label>
             <input type="text" class="form-control" placeholder="Enter Hobbies">
          </div>
       </div>
       <div class="col">
          <div class="form-group">
             <label>Non-Academic Distinctions:</label>
             <input type="text" class="form-control" placeholder="Enter Write in full">
          </div>
       </div>
       <div class="col d-flex">
          <div class="form-group w-100">
             <label>Membership in Association/Org:</label>
             <div class="d-flex">
                <input type="text" class="form-control" placeholder="Enter Write in full">
                <button class="btn btn-danger btn-sm remove-btn d-none ml-2" onclick="removeRow(this)">
                   <i class="fa-solid fa-xmark"></i>
                </button>
             </div>
          </div>
       </div>
    </div>
 </div>

 <!-- Add Button (aligned with Membership field) -->
 <div class="form-group mt-2">
    <button class="btn btn-success btn-sm text-white" onclick="addRow()">
       <i class="fa-solid fa-plus"></i> Add More
    </button>
 </div>

 <h4>Reference Information</h4>
 <hr class="border">

 <!-- Container for dynamically added rows -->
 <div id="reference-info-container">
    <div class="row reference-info-row align-items-end">
       <div class="col">
          <div class="form-group">
             <label>Name:</label>
             <input type="text" class="form-control" placeholder="Enter Name">
          </div>
       </div>
       <div class="col">
          <div class="form-group">
             <label>Address:</label>
             <input type="text" class="form-control" placeholder="Enter Address">
          </div>
       </div>
       <div class="col d-flex">
          <div class="form-group w-100">
             <label>Telephone Number:</label>
             <div class="d-flex">
                <input type="text" class="form-control" placeholder="Enter Telephone Number">
                <button class="btn btn-danger btn-sm remove-btn d-none ml-2" onclick="removeReferenceRow(this)">
                   <i class="fa-solid fa-xmark"></i>
                </button>
             </div>
          </div>
       </div>
    </div>
 </div>

 <!-- Add Button (aligned with Telephone Number field) -->
 <div class="form-group mt-2">
    <button class="btn btn-success btn-sm text-white" onclick="addReferenceRow()">
       <i class="fa-solid fa-plus"></i> Add More
    </button>
 </div>



 <script>
    // Other Information
    function addRow() {
       let container = document.getElementById("other-info-container");
       let firstRow = document.querySelector(".other-info-row");
       let newRow = firstRow.cloneNode(true);

       // Clear input values in the cloned row
       let inputs = newRow.getElementsByTagName("input");
       for (let i = 0; i < inputs.length; i++) {
          inputs[i].value = "";
       }

       // Show the "Remove" button in the new row
       let removeBtn = newRow.querySelector(".remove-btn");
       if (removeBtn) {
          removeBtn.classList.remove("d-none");
       }

       // Append new row
       container.appendChild(newRow);
    }

    function removeRow(button) {
       let row = button.closest(".other-info-row");
       let container = document.getElementById("other-info-container");

       if (container.childElementCount > 1) {
          row.remove();
       } else {
          alert("You must have at least one row!");
       }
    }

    // Reference Information
    function addReferenceRow() {
       let container = document.getElementById("reference-info-container");
       let firstRow = document.querySelector(".reference-info-row");
       let newRow = firstRow.cloneNode(true);

       // Clear input values in the cloned row
       let inputs = newRow.getElementsByTagName("input");
       for (let i = 0; i < inputs.length; i++) {
          inputs[i].value = "";
       }

       // Show the "Remove" button in the new row
       let removeBtn = newRow.querySelector(".remove-btn");
       if (removeBtn) {
          removeBtn.classList.remove("d-none");
       }

       // Append new row
       container.appendChild(newRow);
    }

    function removeReferenceRow(button) {
       let row = button.closest(".reference-info-row");
       let container = document.getElementById("reference-info-container");

       if (container.childElementCount > 1) {
          row.remove();
       } else {
          alert("You must have at least one row!");
       }
    }
 </script>