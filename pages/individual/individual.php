<div id="individual" class="d-none pt-4">
   <div class="container-fluid">
      <div class="row g-3 align-items-stretch">
         <!-- Profile Card (Left Section) -->
         <div class="col-md-3">
            <div class="card card-secondary card-outline align-self-start">
               <?php include 'profilecard.php'; ?>
            </div>
         </div>

         <!-- Tab Navigation and Content (Right Section) -->
         <div class="col-md-9">
            <div class="card-secondary card-outline">
               <div id="indi-tab" class="card card-tabs d-flex flex-column">
                  <div class="card-header p-0 pt-1">
                     <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="personal-info-tab" data-toggle="pill" href="#personal-info" role="tab">Basic Information</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="additional-details-tab" data-toggle="pill" href="#additional-details" role="tab">Identification</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="address-information-tab" data-toggle="pill" href="#address-information" role="tab">Address Information</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="family-background-tab" data-toggle="pill" href="#family-background" role="tab">Family Background</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="educational-background-tab" data-toggle="pill" href="#educational-background" role="tab">Educational Background</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="work-experience-tab" data-toggle="pill" href="#work-experience" role="tab">Work Experience</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="vamos-credentials-tab" data-toggle="pill" href="#vamos-credentials" role="tab">Vamos Credentials</a>
                        </li>
                     </ul>
                  </div>

                  <div class="tab-content" id="custom-tabs-one-tabContent">


                     <div class="tab-pane fade show active" id="personal-info" role="tabpanel">
                        <?php include 'basicinfo.php'; ?>
                     </div>

                     <div class="tab-pane fade" id="additional-details" role="tabpanel">
                        <?php include 'identification.php'; ?>
                     </div>

                     <div class="tab-pane fade" id="address-information" role="tabpanel">
                        <?php include 'address.php'; ?>
                     </div>

                     <div class="tab-pane fade" id="family-background" role="tabpanel">
                        <?php include 'family.php'; ?>
                     </div>

                     <div class="tab-pane fade" id="educational-background" role="tabpanel">
                        <?php include 'education.php'; ?>
                     </div>

                     <div class="tab-pane fade" id="work-experience" role="tabpanel">
                        <?php include 'work.php'; ?>
                     </div>

                     <div class="tab-pane fade" id="vamos-credentials" role="tabpanel">
                        <?php include 'vamoscred.php'; ?>
                     </div>

                  </div>

                  <!-- <div align="center" class="card-footer">
                     <button type="button" class="btn btn-primary" id="formSave">Save</button>
                  </div> -->
                  <div align="center" class="col-12 card-footer">
                     <button type="button" id="formSave" class="btn btn-primary">Save</button>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <style>
         .nav-tabs .nav-link {
            background-color: white !important;
            color: black !important;
         }

         .nav-tabs .nav-link.active {
            background-color: #343a40 !important;
            color: white !important;
            font-weight: bold;
         }

         .tab-pane {
            padding: 15px;
            display: none;
         }

         .tab-pane.show.active {
            display: block;
         }

         .box-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
         }
      </style>
   </div>



</div>