<form id="personalInfoForm">
   <div class="row">
      <div class="col-4">
         <div class="form-group">
            <label>First name:</label>
            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First name">
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Middle name:</label>
            <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Enter Middle name">
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Last name:</label>
            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last name">
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Extension name:</label>
            <input type="text" name="suffix" id="suffix" class="form-control" placeholder="Enter Extension name">
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Select Gender</label>
            <select class="form-control select2" name="gender" id="gender" data-placeholder="Select Gender">
               <option></option>
               <option>Male</option>
               <option>Female</option>
            </select>
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Date of Birth:</label>
            <div class="input-group date datetimepicker" id="reservationdate" data-target-input="nearest">
               <input type="text" name="dobInput" class="form-control datetimepicker-input" data-target="#reservationdate" id="dobInput" placeholder="YYYY/MM/DD">
               <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                  <div class="input-group-text">
                     <i class="fa fa-calendar"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Place of Birth:</label>
            <input type="text" name="place_birth" class="form-control" placeholder="Enter Place of Birth" id="place_birth">
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Contact Number:</label>
            <input type="text" name="contact" class="form-control" placeholder="Enter Contact Number" id="contact">
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Civil Status</label>
            <select class="form-control select2" name="civilstatus" id="civilstatus" data-placeholder="Select Civil Status">
               <option></option>
               <option>Single</option>
               <option>Married</option>
               <option>Widow/Widower</option>
               <option>Separated/Annulled</option>
               <option>Living with Partner</option>
            </select>
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Blood Type</label>
            <select class="form-control select2" name="blood_type" id="blood_type" data-placeholder="Select Blood Type">
               <option></option>
               <option>O+</option>
               <option>O-</option>
               <option>A-</option>
               <option>A+</option>
               <option>B+</option>
               <option>B-</option>
               <option>AB+</option>
               <option>AB-</option>
            </select>
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Religion</label>
            <select class="form-control select2" name="religion" id="religion" data-placeholder="Select Religion">
               <option></option>
               <option>Roman Catholic</option>
               <option>Bible Baptist</option>
               <option>Baptist Conference of the Philippines</option>
               <option>Church of Christ of the Latter Day Saints</option>
               <option>Muslim</option>
               <option>Dios Amahan</option>
               <option>Protestant</option>
               <option>Jehova's Witness</option>
               <option>Ladder of Praise</option>
               <option>Baptist Fellowship</option>
               <option>Hinduism</option>
               <option>Iglesia ni Cristo</option>
               <option>Seventh Day Adventist</option>
               <option>Born Again</option>
            </select>
         </div>
      </div>
      <div class="col-4">
         <div class="form-group">
            <label>Citizenship</label>
            <select class="form-control select2" name="citizenship" id="citizenship" data-placeholder="Select Citizenship">
               <option></option>
               <option>Filipino</option>
               <option>Chinese</option>
               <option>American</option>
               <option>Japanese</option>
               <option>Korean</option>
               <option>Indian</option>
               <option>Spanish</option>
               <option>Arab/Middle Eastern</option>
               <option>German</option>
               <option>British</option>
               <option>French</option>
               <option>Dutch</option>
               <option>Australian</option>
               <option>Canadian</option>
            </select>
         </div>
      </div>
   </div>
</form>