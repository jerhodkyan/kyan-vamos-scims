<div id="transportation"
   class="d-none pt-4">
   <div class="container-fluid">
      <div class="row g-3 align-items-stretch">
         <!-- Profile Card (Left Section) -->
         <div class="col-md-3">
            <div class="card card-secondary card-outline align-self-start">
               <?php include 'profilecard3.php'; ?>
            </div>
         </div>

         <!-- Tab Navigation and Content (Right Section) -->
         <div class="col-md-9">
            <div class="card-secondary card-outline">
               <div id="transport-tab"
                  <div class="card card-tabs d-flex flex-column">
                  <div class="card-header p-0 pt-1">
                     <ul class="nav nav-tabs3"
                        id="custom-tabs-three-tab"
                        role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active"
                              id="transportation-info-tab"
                              data-toggle="pill"
                              href="#transportation-info"
                              role="tab">Basic Information</a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link"
                              id="vamos-cred-3-info-tab"
                              data-toggle="pill"
                              href="#vamos-cred-3-info"
                              role="tab">Vamos Credentials</a>
                        </li>
                     </ul>
                  </div>
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                     <div class="tab-pane fade show active" id="transportation-info" role="tabpanel">
                        <?php include 'transportation-info.php'; ?>
                     </div>

                     <div class="tab-pane fade" id="vamos-cred-3-info" role="tabpanel">
                        <?php include 'vamoscred3.php'; ?>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>


      <style>
         .nav-tabs3 .nav-link {
            background-color: white !important;
            color: black !important;
         }

         .nav-tabs3 .nav-link.active {
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