<?php 	
	ob_start();
	session_start();
	include "../validation/serverTest.php";
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
	
    <!-- Form Handling -->
    <?php

    if(isset($_POST['value']))
    {

        if(isset($_POST['password']) && isset($_POST['confirm_password'])) {

            //First it makes sure if the password and confirm_password text fields have anything inside them

            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            //Then it compares whether the password and confirm_password are matching.

            if($password == $confirm_password ) {

                if (isset ($_POST['userName'])) {
                    $username = $_POST['userName'];
                   
                }

                if (isset ($password)) {
                 
                }

                if (isset ($_POST['firstName'])) {
                    $firstname = $_POST['firstName'];
              
                }

                if (isset ($_POST['lastName'])) {
                    $lastname = $_POST['lastName'];
                   
                }

                if (isset ($_POST['email'])) {
                    $email = $_POST['email'];
           
                }

                if (isset ($_POST['phone'])) {
                    $phone = $_POST['phone'];
                   
                }

                if (isset ($_POST['country'])) {
                    $country = $_POST['country'];
                   
                }

                if (isset ($_POST['city'])) {
                    $city = $_POST['city'];
                   
                }

                if (isset ($_POST['provinceState'])) {
                    $provincestate = $_POST['provinceState'];
                    
                }

                if (isset ($_POST['zipPostal'])) {
                    $zippostal = $_POST['zipPostal'];
                    
                }

                if (isset ($_POST['address'])) {
                    $address = $_POST['address'];
                    
                }

                //After everything is validated it puts the information to the database.

               

                //Starting session

                $sql = " SELECT username FROM student_account where username=?";
                $stmt = $conn->prepare($sql);

                $stmt->bind_param("s", $username);
                $stmt->execute();

                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();

                if( $count==null)
                {
                    $sql = "INSERT INTO student_account(username,password,first_name,last_name)
        VALUES (?,?,?,?)";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssss", $username, $password , $firstname , $lastname);
                    $stmt->execute();

                    $sql="SELECT id FROM student_account WHERE username ='".$username."'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $stmt->bind_result($count);
                        while($stmt->fetch())
                        {
                            $_SESSION['accountSession'] = $count;
                        }

                    $_SESSION['userFirstName'] = $firstname;
                    $_SESSION['userLastName'] = $lastname;
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['userPhone'] = $phone;
                    $_SESSION['userCountry'] = $country;
                    $_SESSION['userCity'] = $city;
                    $_SESSION['userProvinceState'] = $provincestate;
                    $_SESSION['userAddress'] = $address;
                    $_SESSION['userZipPostal'] = $zippostal;

                        header("Location:../validation/finalRegistration.php");

                }
				else
				{
					  echo "<script> alert('Username already taken!');</script>";
				}

            }
        }
    }

    ?>

		<title>registration</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
		<link href="../stylesheet/registrationBootstrap.css" rel="stylesheet" type="text/css">
		
</head>

<body style="padding-top: 0px;">
<?php
	include "../template/template.php";
?>
<div class="wrapper">
    <div class="content">
        <div id="registrationHeader">
            <h1>Account Registration</h1>
        </div>
        <div class="container">
            <div class="col-lg-12 well" style="margin-bottom:0px;">
                <div class="row">	
                    <form action="registrationBootstrap.php" method="post" onsubmit="jsTest()">
                        <div class="col-sm-12">
                            <div class="row">
								
							
                                <div class="col-sm-6 form-group">
                                    <label><small style="color: red;">*</small> Username <small style="color: black;">( max. 16 characters, cannot contain special character  (e.g. !, @, #, $ etc.)) </small></label>
                                    <input maxlength="16" type="text" placeholder="Enter username.." class="form-control" name="userName" id="userName" required="" oninvalid="this.setCustomValidity('Username is required / invalid !')" oninput="setCustomValidity('')" pattern="[A-Za-z0-9_]{1,16}">
                                </div>
								
                                <div class="col-sm-6 form-group">
                                    <label><small style="color: red;">*</small> Password <small style="color: black;">( max. 16 characters, cannot contain special character  (e.g. !, @, #, $ etc.)) </small></label>
                                    <input maxlength="16" type="password" placeholder="Enter password.." class="form-control" name="password" id="password" required="" oninvalid="this.setCustomValidity('Password is required / invalid !')" oninput="setCustomValidity('')" pattern="^[a-zA-Z0-9]{1,16}$">
                                </div>


                                    <div class="col-sm-6 form-group">
                                    </div>

                                
                                <div class="col-sm-6 form-group">
                                    <label>Confirm password</label>
                                    <input maxlength="16" type="password" placeholder="Confirm password.." class="form-control" id="confirm_password" name="confirm_password" required="" oninvalid="this.setCustomValidity('Confirm password is required / invalid !')" oninput="setCustomValidity('')" pattern="[A-Za-z0-9_]{1,16}">
                                </div>



                                <div class="col-sm-6 form-group">
                                    <label><small style="color: red;">*</small> First Name <small>( max. 30 characters) </small> </label>
                                    <input maxlength="30" type="text" placeholder="Enter First Name Here.." class="form-control" name="firstName" required="" oninvalid="this.setCustomValidity('First name is required / invalid !')" oninput="setCustomValidity('')" pattern="[A-Za-z0-9_]{1,30}">
                                </div>
								
                                <div class="col-sm-6 form-group">
                                    <label><small style="color: red;">*</small> Last Name <small>( max. 30 characters) </small></label>
                                    <input maxlength="30" type="text" placeholder="Enter Last Name Here.." class="form-control" name="lastName" required="" oninvalid="this.setCustomValidity('Last name is required / invalid !')" oninput="setCustomValidity('')" pattern="[A-Za-z0-9_]{1,30}">
                                </div>
                            </div>



                            <div class="form-group">
                                <label><small style="color: red;">*</small> Email Address <small>( max. 300 characters, e.g example@hotmail.com ) </small></label>
                                <input maxlength="300" type="text" placeholder="Enter Email Address Here.." class="form-control" name="email" required="" oninvalid="this.setCustomValidity('Email is required / invalid !')" oninput="setCustomValidity('')" pattern="[A-Za-z0-9_.-]{1,}@[a-zA-Z]{1,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})">
                            </div>

                            <div class="form-group">
                                <label><small style="color: red;">*</small> Phone Number <small>( e.g 416XXXXXXX ) </small></label>
                                <input maxlength="10" type="text" placeholder="Enter Phone Number Here.." class="form-control" name="phone" required="" oninvalid="this.setCustomValidity('Phone number is required / invalid !')" oninput="setCustomValidity('')" pattern="[0-9]{10,10}">
                            </div>


                                <label>Country</label>
                                <br>

                                    <select name="country" style="width:388px; height:35px; margin-bottom:18px;" >
                                        <option value="">Choose your country...</option>
                                        <option value="Afganistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
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
                                        <option value="Bonaire">Bonaire</option>
                                        <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Canary Islands">Canary Islands</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Channel Islands">Channel Islands</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Island">Cocos Island</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote DIvoire">Cote D'Ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Curaco">Curacao</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Ter">French Southern Ter</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Great Britain">Great Britain</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Hawaii">Hawaii</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea North">Korea North</option>
                                        <option value="Korea Sout">Korea South</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia">Macedonia</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Midway Islands">Midway Islands</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Nambia">Nambia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherland Antilles">Netherland Antilles</option>
                                        <option value="Nevis">Nevis</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau Island">Palau Island</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Phillipines">Philippines</option>
                                        <option value="Pitcairn Island">Pitcairn Island</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Republic of Montenegro">Republic of Montenegro</option>
                                        <option value="Republic of Serbia">Republic of Serbia</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="St Barthelemy">St Barthelemy</option>
                                        <option value="St Eustatius">St Eustatius</option>
                                        <option value="St Helena">St Helena</option>
                                        <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                        <option value="St Lucia">St Lucia</option>
                                        <option value="St Maarten">St Maarten</option>
                                        <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                                        <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                                        <option value="Saipan">Saipan</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="Samoa American">Samoa American</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
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
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Tahiti">Tahiti</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Erimates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States of America">United States of America</option>
                                        <option value="Uraguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City State">Vatican City State</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                        <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                        <option value="Wake Island">Wake Island</option>
                                        <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zaire">Zaire</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>City</label>
                                    <input type="text" placeholder="Enter City Name Here.." class="form-control" name="city" pattern="[a-zA-Z0-9\s]{1,100}" title="Exceeds character limit">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Province/State</label>
                                    <input type="text" placeholder="Enter State Name Here.." class="form-control" name="provinceState" pattern="[a-zA-Z0-9\s]{1,100}" title="Exceeds character limit">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Zip</label>
                                    <input type="text" placeholder="Enter Zip Code Here.." class="form-control" name="zipPostal" pattern="[a-zA-Z0-9\s]{1,20}" title="Exceeds character limit">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea placeholder="Enter Address Here.." rows="3" class="form-control" name="address" title="Exceeds character limit"></textarea>
                            </div>
                          <button class="btn btn-lg btn-info" type="submit" name="value">Create Account</button>							
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <script>
            var username;

            function jsTest()
            {
               password = document.getElementById("password").value;
               confirm_password = document.getElementById("confirm_password").value;

               if(password != confirm_password)
               {
                   alert("Password does not match");
               }
            }
        </script>
    </div>
    <?php include '../template/templateFoot.php'?>


</div>
</body>
</html>
