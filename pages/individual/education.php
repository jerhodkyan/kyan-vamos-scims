<table id="education" class="display table" style="width:100%">
   <thead>
      <tr>
         <th style="width:max-content">Level</th>
         <th>Name of School</th>
         <th class="text-nowrap text-center">Period of Attendance <br> (From / To)</th>
         <th class="text-nowrap text-center">Highest level/Units Earned <br>(if not Graduated)</th>
         <th class="text-center">Year Graduated</th>
         <th class="text-center">Scholarship/Academic <br>Honors Received</th>
         <th class="text-center">Remarks</th>
         <th class="text-center">Action</th>
      </tr>
   </thead>
   <tbody id="education-tbody">
      <tr>
         <td>
            <div class="form-group">
               <select class="form-control select2" placeholder="Select Educational Level" style="width: 100%;">
                  <option></option>
                  <option>Elementary</option>
                  <option>High School</option>
                  <option>College</option>
                  <option>Post Graduate</option>
                  <option>TESDA Graduate</option>
                  <option>Vocational Course</option>
               </select>
            </div>
         </td>
         <td>
            <div class="form-group">
               <input type="text" class="form-control" placeholder="Enter Fullname of School" name="schoolName">
            </div>
         </td>
         <td>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                     </span>
                  </div>
                  <input type="text" class="form-control float-right reservation">
               </div>
            </div>
         </td>
         <td>
            <div class="form-group">
               <input type="text" class="form-control" placeholder="Enter Units Earned" name="unitsEarned">
            </div>
         </td>
         <td>
            <div class="form-group">
               <div class="input-group date datetimepicker" data-target-input="nearest">
                  <input type="date" class="form-control" name="yearGraduated">

               </div>
            </div>
         </td>
         <td>
            <div class="form-group">
               <input type="text" class="form-control" placeholder="Enter Honors Received" name="honors">
            </div>
         </td>
         <td>
            <div class="form-group">
               <input type="text" class="form-control" placeholder="Enter Remarks" name="remarks">
            </div>
         </td>
         <td>
            <div class="form-group d-flex align-items-center">
               <button class="btn btn-success btn-sm text-white addRow">
                  <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
               </button>
            </div>
         </td>
      </tr>
   </tbody>
</table>

<button class="btn btn-info btn-sm test">Save Education Data</button>