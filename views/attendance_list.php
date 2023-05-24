<?php include "../controller/connections.php"; ?>
<!-- conference attendance list -->
<div id="attendance_list" class="displays allResults">
    <!-- filter by columns -->
    <section class="filters">
        <div class="user_types">
            <label for="user_type">Filter by User type</label>
            <select name="filter" id="filter" onchange="filterAttendance(this.value, 'filter_user_type.php')">
                <option value=""selected>Select user type</option>
                <option value="delegate">Delegates</option>
                <option value="Guest">Guest</option>
            </select>
        </div>
        <div class="user_types">
            <label for="user_type">Filter by Country</label>
            <select name="filter_country" id="filter_country" onchange="filterAttendance(this.value, 'filter_country.php')">
                <option value=""selected>Select Country</option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
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
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and herzegovina">Bosnia and herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Brazil">Brazil</option>
                <option value="Brunei">Brunei</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroona</option>
                <option value="Canada">Canada</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Costa Rica">Costa rica</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="DR Congo">DR Congo</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Greece">Greece</option>
                <option value="Grenada">Grenada</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-Bissau">Guinea-Bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Honduras">Honduras</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran">Iran</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzsatn">Kyrgyzsatn</option>
                <option value="Laos">Laos</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libya">Libya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mexico">Mexico</option>
                <option value="Moldova">Moldova</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="North Korea">North Korea</option>
                <option value="North Macedonia">North Macedonia</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Panama">Panama</option>
                <option value="Papau New Guinea">Papau New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Phillipines">Phillipines</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Qatar">Qatar</option>
                <option value="Romania">Romania</option>
                <option value="Russia">Russia</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
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
                <option value="South Korea">South Korea</option>
                <option value="South Sudan">South Sudan</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="State of Palestine">State of Palestine</option>
                <option value="Sudan">Sudan</option>
                <option value="Sweden">Sweden</option>
                <option value="Syria">Syria</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Thailand">Thailand</option>
                <option value="Togo">Togo</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United State">United States</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
            </select>
        </div>
        <div class="user_types">
            <label for="user_type">Filter by State</label>
            <select name="filter_state" id="filter_state" onchange="filterAttendance(this.value, 'filter_state.php')">
                <option value=""selected>Select state</option>
                <option value="Abia">Abia</option>
                <option value="Adamawa">Adamawa</option>
                <option value="Akwa-ibom">Akwa-ibom</option>
                <option value="Anambra">Anambra</option>
                <option value="Bauchi">Bauchi</option>
                <option value="Bayelsa">Bayelsa</option>
                <option value="Benue">Benue</option>
                <option value="Borno">Borno</option>
                <option value="Cross rivers">Cross Rivers</option>
                <option value="Delta">Delta</option>
                <option value="Ebonyi">Ebonyi</option>
                <option value="Edo">Edo</option>
                <option value="Ekiti">Ekiti</option>
                <option value="Enugu">Enugu</option>
                <option value="Gombe">Gombe</option>
                
                <option value="Imo">Imo</option>
                <option value="Jigawa">Jigawa</option>
                <option value="Kaduna">Kaduna</option>
                <option value="Kano">Kano</option>
                <option value="Katsina">Katsina</option>
                <option value="Kebbi">Kebbi</option>
                <option value="Kogi">Kogi</option>
                <option value="Kwarra">Kwarra</option>
                <option value="Lagos">Lagos</option>
                <option value="Nasarawa">Nassarawa</option>
                <option value="Niger">Niger</option>
                <option value="Ogun">Ogun</option>
                <option value="Ondo">Ondo</option>
                <option value="Osun">Osun</option>
                <option value="Oyo">Oyo</option>
                <option value="Plateau">Plateau</option>
                <option value="Rivers">Rivers</option>
                <option value="Sokoto">Sokoto</option>
                <option value="Taraba">Taraba</option>
                <option value="Yobe">Yobe</option>
                <option value="Zamfara">Zamfara</option>
                <option value="Abuja">Abuja</option>
            </select>
        </div>
        <div class="user_types">
            <label for="user_type">Technical group</label>
            <select name="filter_tech" id="filter_tech" onchange="filterAttendance(this.value, 'filter_tech_group.php')">
                <option value=""selected>Select Country</option>
                <option value=""selected>Select technical group</option>
                <option value="PSN-YPG">PSN-YPG</option>
                <option value="ACPN">ACPN</option>
                <option value="NAPA">NAPA</option>
                <option value="NAIP">NAIP</option>
                <option value="ALPS">ALPS</option>
                <option value="CPAN">CPAN</option>
                <option value="AHAPN">AHAPN</option>
            </select>
        </div>
        <div class="user_types">
            <label for="user_type">Technical group</label>
            <select name="filter_gtype" id="filter_gtype" onchange="filterAttendance(this.value, 'filter_guest_type.php')">
                <option value=""selected>Select Guest type</option>
                <?php
                    $get_guest = $connectdb->prepare("SELECT * FROM guest_types ORDER BY guest_type");
                    $get_guest->execute();
                    $rows = $get_guest->fetchAll();
                    foreach($rows as $row){
                ?>
                <option value="<?php echo $row->guest_type_id?>"><?php echo $row->guest_type?></option>
                <?php }?>
            </select>
        </div>
    </section>
    <div class="filter_data">
        <h2>Attendance List for PSN 2023 Conference</h2>
            <hr>
            <div class="options">
                <div class="search">
                    <input type="search" id="searchAttendance" placeholder="Enter keyword" onkeyup="searchData(this.value)">
                </div>
                <button id="downloadAttend" class="downloadAttend" onclick="convertToExcel('attendList_table', 'Attendnace List for Jewell 2023')">Export to Excel <i class="fas fa-file-excel"></i></button>
            </div>
            <table id="attendList_table" class="searchTable">
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Full Name</td>
                        <td>User type</td>
                        <td>PCN Number</td>
                        <td>Country</td>
                        <td>State</td>
                        <td>Phone Numbers</td>
                        <td>Reg_Number</td>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                        $get_all = $connectdb->prepare("SELECT * FROM users WHERE last_name != 'Admin' AND attendance = 1 OR attendance = 2 ORDER BY reg_date");
                        $get_all->execute();
                        $n = 1;
                        
                        $alls = $get_all->fetchAll();

                        foreach($alls as $all):
                    ?>
                    <tr>
                        <td style="color:red; text-align:center"><?php echo $n?></td>
                        <td><?php echo $all->first_name . " " . $all->last_name;?></td>
                        <td style="color:var(--primaryColor)"><?php echo $all->user_type?></td>
                        <td><?php echo $all->pcn_number;?></td>
                        <td><?php 
                            if($all->country == ""){
                                echo "Nigeria";
                            }else{
                                echo $all->country;
                            }
                        ?></td>
                        <td><?php echo $all->res_state?></td>
                        <td><?php echo $all->whatsapp.", ".$all->other_number;?></td>
                        <td><?php echo $all->reg_number;?></td>
                        
                    </tr>
                <?php $n++; endforeach;?>
            </tbody>
        </table>
        <?php
            if(!$get_all->rowCount() > 0){
                echo "<p class='no_result'>'No result found!'</p>";
            }
        ?>
    </div>
</div>