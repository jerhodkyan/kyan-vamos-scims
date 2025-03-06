<div class="card-body box-profile text-center d-flex flex-column justify-content-center">
   <img id="photo" class="profile-user-img img-fluid img-circle" src="" alt="User Photo" style="width: 150px; height: 150px;">
   <h5 style="margin: 2%;"><span class="badge" id="statusBadge" name="statusBadge"></span></h5>

   <div class="mt-2">
      <button type="button" class="btn btn-primary btn-import" style="width: 90px;">Import</button>
   </div>

   <div class="form-group w-75 mt-4">

      <label for="entity1">Select Individual</label>
      <select id="entity1"
         class="form-control select2 select2-hidden-accessible"
         style="width: 100%;"
         data-select2-id="1"
         tabindex="-1"
         aria-hidden="true">
         <option selected disabled data-select2-id="3">Select Individual</option>
      </select>

      <span id="notify"></span>
   </div>

   <div class="form-group w-75">
      <label>Entity Number:</label>
      <input type="text" id="entityNum" class="form-control text-center" placeholder="ENTITY NUMBER" disabled>
   </div>
</div>