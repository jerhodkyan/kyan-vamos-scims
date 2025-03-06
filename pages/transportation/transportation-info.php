<div class="row">
   <div class="col-6">
      <div class="form-group">
         <label>Transportation Base:</label>
         <select class="form-control" name="transportation_base" required>
            <option value="">--Select--</option>
            <option value="Land">Land</option>
            <option value="Sea">Sea</option>
         </select>
      </div>
   </div>
</div>
<div class="row">
   <!-- For Sea -->
   <div class="col-md-6">
      <div class="form-group">
         <label>Type of Transportation/For Sea:</label>
         <select class="form-control" name="transport_type" required>
            <option value="">--Select--</option>
            <option value="Ship/Ferry">Ship/Ferry</option>
            <option value="Motorized Banca">Motorized Banca</option>
            <option value="Non-Motorized Banca">Non-Motorized Banca</option>
         </select>
      </div>
      <div class="form-group">
         <label>Name of Vehicle or Vessel:</label>
         <input type="text" class="form-control" name="vehicle_name" placeholder="Enter Name of Vehicle or Vessel" required>
      </div>
      <div class="form-group">
         <label>Voyage #:</label>
         <input type="text" class="form-control" name="voyage_no" placeholder="Enter Voyage # (Sea)">
      </div>
      <div class="form-group">
         <label>Port of Embarkation:</label>
         <input type="text" class="form-control" name="port_of_embarkation" placeholder="Enter Port of Embarkation (Sea)">
      </div>
   </div>

   <!-- For Land -->
   <div class="col-md-6">
      <div class="form-group">
         <label>For Land:</label>
         <select class="form-control" name="land_transport">
            <option value="">--Select--</option>
            <option value="Bus">Bus</option>
            <option value="Jeep">Jeep</option>
            <option value="Habal-Habal">Habal-Habal</option>
            <option value="Motorcab">Motorcab</option>
            <option value="Motorcycle">Motorcycle</option>
            <option value="Pedicab">Pedicab</option>
            <option value="UV-Express">UV-Express</option>
         </select>
      </div>

      <div class="form-group">
         <label>Vehicle:</label>
         <input type="text" class="form-control" name="vehicle" placeholder="Enter Vehicle (Land)">
      </div>

      <div class="form-group">
         <label>Plate #:</label>
         <input type="text" class="form-control" name="plate_no" placeholder="Enter Plate # (Land)">
      </div>
      <div class="form-group">
         <label>Terminal:</label>
         <input type="text" class="form-control" name="terminal_name" placeholder="Enter Terminal (Land)">
      </div>

   </div>
</div>

<br>
<h4>Contact Details</h4>
<hr class="border">
</hr>
<div class="row">
   <div class="col">

      <!-- Name & Position in One Row -->
      <div class="col-6">
         <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="contact_name" placeholder="Name" required>
         </div>
      </div>
      <div class="col-6">
         <div class="form-group">
            <label>Position:</label>
            <input type="text" class="form-control" name="contact_position" placeholder="Enter Position">
         </div>
      </div>
   </div>
   <div class="col-6">
      <div class="form-group">
         <label>Contact:</label>
         <input type="text" class="form-control" name="contact_number" placeholder="Enter Contact" required>
      </div>
   </div>
</div>