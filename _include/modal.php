<?php if(basename($_SERVER['PHP_SELF']) == 'modal.php'): ?>
<?php header("Location: index.php"); ?>
<?php endif; ?>

<?php if(in_array(basename($_SERVER['PHP_SELF']),array('customer_types.php','room_types.php','reservation_types.php','room_locations.php','room_accommodations.php'))): ?>
<div class="modal" tabindex="-1" id="add_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Insert <?= ucfirst($title) ?></h5>
      </div>
      <div class="modal-body">
        <form name="add_form" id="add_form" onsubmit="return: false;">
            <input type="hidden" name="action" value="create">
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Name" name="name">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Remark</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Remark" name="remark">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_btn">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" id="edit_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update <?= ucfirst($title) ?></h5>
      </div>
      <div class="modal-body">
        <form name="edit_form" id="edit_form" onsubmit="return: false;">
            <input type="hidden" name="action" value="update">
            <input type="hidden" id="id" name="id" value="0">
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" id="name" class="form-control" placeholder="Name" name="name">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Remark</label>
                <div class="col-sm-10">
                    <input type="text" id="remark" class="form-control" placeholder="Remark" name="remark">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save_btn">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(basename($_SERVER['PHP_SELF']) == 'customers.php'): ?>
<div class="modal" tabindex="-1" id="add_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Insert <?= ucfirst($title) ?></h5>
      </div>
      <div class="modal-body">
        <form name="add_form" id="add_form" onsubmit="return: false;">
            <input type="hidden" name="action" value="create">
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Title</label>
                <div class="col-sm-10">
                    <select class="form-control" name="title">
                      <option value="MR" selected>Mr</option>
                      <option value="Miss">Miss</option>
                      <option value="MRS">Mrs</option>
                      <option value="DR">Dr</option>
                      <option value="PROF">Prof</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="First Name" name="first_name">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Middle Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Middle Name" name="middle_name">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Phone Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Gender</label>
                <div class="col-sm-10">
                    <select class="form-control" name="gender">
                      <option value="MALE" selected>Male</option>
                      <option value="FEMALE">Female</option>
                      <option value="OTHER">Other</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Birthday</label>
                <div class="col-sm-10">
                    <input name="birthday" class="form-control" type="date">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="type_id">
                      <?php
                        $sql = $db->prepare("SELECT id,name FROM customer_types WHERE ISNULL(deleted_at)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                          extract($data);
                          echo "<option value='$id'>$name</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Country</label>
                <div class="col-sm-10">
                    <select class="form-control" name="country">
                      <option value="Afghanistan">Afghanistan</option>
                      <option value="Åland Islands">Åland Islands</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antarctica">Antarctica</option>
                      <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                      <option value="Argentina">Argentina</option>
                      <option value="Armenia">Armenia</option>
                      <option value="Aruba">Aruba</option>
                      <option value="Australia">Australia</option>
                      <option value="Austria">Austria</option>
                      <option value="Azerbaijan">Azerbaijan</option>
                      <option value="Bahamas">Bahamas</option>
                      <option value="Bahrain">Bahrain</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Barbados">Barbados</option>
                      <option value="Belarus">Belarus</option>
                      <option value="Belgium">Belgium</option>
                      <option value="Belize">Belize</option>
                      <option value="Benin">Benin</option>
                      <option value="Bermuda">Bermuda</option>
                      <option value="Bhutan">Bhutan</option>
                      <option value="Bolivia">Bolivia</option>
                      <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                      <option value="Botswana">Botswana</option>
                      <option value="Bouvet Island">Bouvet Island</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                      <option value="Brunei Darussalam">Brunei Darussalam</option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">Central African Republic</option>
                      <option value="Chad">Chad</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comoros">Comoros</option>
                      <option value="Congo">Congo</option>
                      <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Cote D'ivoire">Cote D'ivoire</option>
                      <option value="Croatia">Croatia</option>
                      <option value="Cuba">Cuba</option>
                      <option value="Cyprus">Cyprus</option>
                      <option value="Czech Republic">Czech Republic</option>
                      <option value="Denmark">Denmark</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Dominican Republic">Dominican Republic</option>
                      <option value="Ecuador">Ecuador</option>
                      <option value="Egypt">Egypt</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Equatorial Guinea">Equatorial Guinea</option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Ethiopia">Ethiopia</option>
                      <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                      <option value="Faroe Islands">Faroe Islands</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Finland">Finland</option>
                      <option value="France">France</option>
                      <option value="French Guiana">French Guiana</option>
                      <option value="French Polynesia">French Polynesia</option>
                      <option value="French Southern Territories">French Southern Territories</option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guernsey">Guernsey</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guinea-bissau">Guinea-bissau</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                      <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Isle of Man">Isle of Man</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jersey">Jersey</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                      <option value="Korea, Republic of">Korea, Republic of</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macao">Macao</option>
                      <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                      <option value="Moldova, Republic of">Moldova, Republic of</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montenegro">Montenegro</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Namibia">Namibia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherlands">Netherlands</option>
                      <option value="Netherlands Antilles">Netherlands Antilles</option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau">Palau</option>
                      <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Philippines">Philippines</option>
                      <option value="Pitcairn">Pitcairn</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Reunion">Reunion</option>
                      <option value="Romania">Romania</option>
                      <option value="Russian Federation">Russian Federation</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="Saint Helena">Saint Helena</option>
                      <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                      <option value="Saint Lucia">Saint Lucia</option>
                      <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                      <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                      <option value="Samoa">Samoa</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Serbia">Serbia</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra Leone">Sierra Leone</option>
                      <option value="Singapore">Singapore</option>
                      <option value="Slovakia">Slovakia</option>
                      <option value="Slovenia">Slovenia</option>
                      <option value="Solomon Islands">Solomon Islands</option>
                      <option value="Somalia">Somalia</option>
                      <option value="South Africa">South Africa</option>
                      <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                      <option value="Spain">Spain</option>
                      <option value="Sri Lanka">Sri Lanka</option>
                      <option value="Sudan">Sudan</option>
                      <option value="Suriname">Suriname</option>
                      <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                      <option value="Swaziland">Swaziland</option>
                      <option value="Sweden">Sweden</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                      <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                      <option value="Thailand">Thailand</option>
                      <option value="Timor-leste">Timor-leste</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Ukraine">Ukraine</option>
                      <option value="United Arab Emirates">United Arab Emirates</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="United States">United States</option>
                      <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                      <option value="Uruguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Viet Nam">Viet Nam</option>
                      <option value="Virgin Islands, British">Virgin Islands, British</option>
                      <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                      <option value="Wallis and Futuna">Wallis and Futuna</option>
                      <option value="Western Sahara">Western Sahara</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">City</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="City" name="city">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Address" name="address">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Postal Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Postal Code" name="postalcode">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Remark</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Remark" name="remark">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_btn">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(basename($_SERVER['PHP_SELF']) == 'rooms.php'): ?>
<div class="modal" tabindex="-1" id="add_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Insert <?= ucfirst($title) ?></h5>
      </div>
      <div class="modal-body">
        <form name="add_form" id="add_form" onsubmit="return: false;">
            <input type="hidden" name="action" value="create">
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Name" name="name">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-control" name="status">
                      <option value="FREE" selected>Free</option>
                      <option value="RESERVED">Reserved</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="type_id">
                      <?php
                        $sql = $db->prepare("SELECT id,name FROM room_types WHERE ISNULL(deleted_at)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                          extract($data);
                          echo "<option value='$id'>$name</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Location</label>
                <div class="col-sm-10">
                    <select class="form-control" name="location_id">
                      <?php
                        $sql = $db->prepare("SELECT id,name FROM room_locations WHERE ISNULL(deleted_at)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                          extract($data);
                          echo "<option value='$id'>$name</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Accommodation</label>
                <div class="col-sm-10">
                    <select class="form-control" name="accommodation_id">
                      <?php
                        $sql = $db->prepare("SELECT id,name FROM room_accommodations WHERE ISNULL(deleted_at)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                          extract($data);
                          echo "<option value='$id'>$name</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Price</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Price" name="price">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Remark</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Remark" name="remark">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_btn">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if(basename($_SERVER['PHP_SELF']) == 'reservations.php'): ?>
<div class="modal" tabindex="-1" id="add_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Insert <?= ucfirst($title) ?></h5>
      </div>
      <div class="modal-body">
        <form name="add_form" id="add_form" onsubmit="return: false;">
            <input type="hidden" name="action" value="create">
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Room</label>
                <div class="col-sm-10">
                    <select class="form-control" name="room_id">
                      <?php
                        $sql = $db->prepare("SELECT id,name FROM rooms WHERE ISNULL(deleted_at) AND status = 'FREE'");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                          extract($data);
                          echo "<option value='$id'>$name</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Customers</label>
                <div class="col-sm-10">
                    <select class="form-control" name="customer_id">
                      <?php
                        $sql = $db->prepare("SELECT id,CONCAT(first_name,' ',middle_name,' ',last_name) as name FROM customers WHERE ISNULL(deleted_at)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                          extract($data);
                          echo "<option value='$id'>$name</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Reservation Type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="reservation_type_id">
                      <?php
                        $sql = $db->prepare("SELECT id,name FROM reservation_types WHERE ISNULL(deleted_at)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                          extract($data);
                          echo "<option value='$id'>$name</option>";
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Reserved Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" placeholder="Reserved Date" name="reserved_date">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Check-In</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" placeholder="Check-In Date" name="checkin">
                </div>
            </div>
                        <div class="form-group row">
                <label class="col-sm-2 form-control-label">Check-Out</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" placeholder="Check-Out Date" name="checkout">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Adults</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Adults" name="adults">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Children</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="Children" name="children">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Guaranteed</label>
                <div class="col-sm-10">
                    <select class="form-control" name="guaranteed">
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Meal</label>
                <div class="col-sm-10">
                    <select class="form-control" name="meal">
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Remark</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Remark" name="remark">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_btn">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>


<?php if(basename($_SERVER['PHP_SELF']) == 'users.php'): ?>
<div class="modal" tabindex="-1" id="add_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Insert <?= ucfirst($title) ?></h5>
      </div>
      <div class="modal-body">
        <form name="add_form" id="add_form" onsubmit="return: false;">
            <input type="hidden" name="action" value="create">
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Name" name="full_name">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Permission</label>
                <div class="col-sm-10">
                    <select class="form-control" name="permission">
                      <option value="ADMIN">Admin</option>
                      <option value="USER">User</option>
                    </select>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_btn">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" id="edit_modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Password <?= ucfirst($title) ?></h5>
      </div>
      <div class="modal-body">
        <form name="edit_form" id="edit_form" onsubmit="return: false;">
            <input type="hidden" name="action" value="update_password">
            <input type="hidden" id="id" name="id" value="0">
            <div class="form-group row">
                <label class="col-sm-2 form-control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Password" value="" autocomplet name="password">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save_btn">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>