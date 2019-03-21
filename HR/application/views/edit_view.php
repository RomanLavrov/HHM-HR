<div class="create-body">
    <form action="/HR/uploadPhoto" method="post" enctype="multipart/form-data">
        <input class="input1" id="imageUpload" type="file" name="fileToUpload">
        <input type="hidden" name="id" value=<?php echo($this->employee->Id);?>>
        <input class="input2" id="imageButton" type="submit" value="Upload Image" name="photo">
    </form>

    <form action="/HR/update" method="post">
        <div class="row">
            <div class="col-md-3">
                <div id="personal-main" class="create-personal">
                    <div class="create-personal-header">Mitarbeiter</div>

                    <div class="personal-image">
                        <img src=<?php echo $this->employee->Photo; ?>
                            onerror="this.onerror=null;this.src='images/user.png';">
                        <label id="fileNameLabel" class="input-label-text">Foto auswählen</label>
                        <div>
                        <label for=""><?php echo $this->upload_err; ?></label>
                        </div>
                        
                        <input type="hidden" name="Photo" value=<?php echo $this->employee->Photo; ?>>
                        
                        <div class="input-buttons">
                            <label class="input-label-select" for="imageUpload">Durchsuche</label>
                            <label class="input-label-upload" for="imageButton">Hochladen</label>
                        </div>
                    </div>

                    <div>
                        <div class="bio-description">Name</div>
                         <input type="hidden" name="id" value=<?php echo($this->employee->Id);?>>
                        <input type="text" name="Name" class="bio-value" value=<?php echo($this->employee->Name);?>>
                    </div>

                    <div>
                        <div class="bio-description">Vorname</div>
                        <input type="text" name="LastName" class="bio-value" value=<?php echo($this->employee->LastName);?>>
                    </div>

                    <input type="submit" id="btn-add" class="personal-categories-btn" value="Hinzufügen">
                    <button id="btn-cancel" class="personal-categories-btn">Abbrechen</button>
                </div>
            </div>

            <div id="personal-details" class="col-md-9">
                <div id="personal-details-header" class="create-personal-header">Details</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="create-personal">
                            <div class="create-personal-header">Personal</div>

                            <div>
                                <div class="bio-description">Geburtsdatum</div>
                                <input type="date" name="BirthDate" class="bio-value" value=<?php echo $this->employee->BirthDate; ?>>
                            </div>
                            <div>
                            <div class="bio-description">Zivilstand</div>
                            <input list="CivilStand" name="CivilState" class="bio-value" value=<?php echo $this->employee->CivilState; ?>>
                                <datalist id="CivilStand">
                                    <option value="Ledig">
                                    <option value="Verheirated">
                                    <option value="Geschieden">
                                    <option value="Verwitwet">
                                </datalist>
                              
                            </div>
                            <div>
                                <div class="bio-description">Wohnadresse</div>
                                <input type="text" name="Address" class="bio-value" value=<?php echo $this->employee->Address; ?>>
                            </div>
                            <div>
                                <div class="bio-description">PLZ</div>
                                <input type="text" name="PLZ" class="bio-value" value=<?php echo $this->employee->PLZ; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Ort</div>
                                <input type="text" name="Place" class="bio-value" value=<?php echo $this->employee->Place; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Telefonnummer</div>
                                <input type="tel" name="Phone" class="bio-value" value=<?php echo $this->employee->Phone; ?>>
                            </div>
                        </div>

                        <div class="create-personal">
                            <div class="create-personal-header">Pass</div>
                            <div>
                                <div class="bio-description">Pass Name</div>
                                <input type="text" name="Pass_Name" class="bio-value" value=<?php echo $this->employee->Pass_Name; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Pass Vorname</div>
                                <input type="text" name="Pass_LastName" class="bio-value" value=<?php echo $this->employee->Pass_LastName; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Pass Nummer</div>
                                <input type="text" name="Pass_Number" class="bio-value" value=<?php echo $this->employee->Pass_Number; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Gültigkeit:</div>
                                <input type="date" name="Pass_Expired" class="bio-value" value=<?php echo $this->employee->Pass_Expired; ?>>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="create-personal-short">
                            <div class="create-personal-header">Career</div>
                            <div>
                                <div class="bio-description">Eintrittsdatum</div>
                                <input type="date" name="CareerStart" class="bio-value" value=<?php echo $this->employee->StartDate; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Position</div>
                                <input type="text" name="Position" class="bio-value" value=<?php echo $this->employee->Position; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Lohn</div>
                                <input type="text" name="Salary" class="bio-value" value=<?php echo $this->employee->Salary; ?>>
                            </div>
                        </div>

                        <div class="create-personal-short">
                            <div class="create-personal-header">G17</div>
                            <div>
                                <div class="bio-description">G17 E-Mail</div>
                                <input type="mail" name="G17_email" class="bio-value" value=<?php echo $this->employee->G17_email; ?>>
                            </div>
                            <div>
                                <div class="bio-description">G17 Kürzel</div>
                                <input type="text" name="G17_initials" class="bio-value" value=<?php echo $this->employee->G17_initials; ?>>
                            </div>
                        </div>

                        <div class="create-personal-short">
                            <div class="create-personal-header">HHM</div>
                            <div>
                                <div class="bio-description">HHM E-Mail</div>
                                <input type="text" name="HHM_email" class="bio-value" value=<?php echo $this->employee->HHM_email; ?>>
                            </div>
                            <div>
                                <div class="bio-description">HHM Kürzel</div>
                                <input type="text" name="HHM_initials" class="bio-value" value=<?php echo $this->employee->HHM_initials; ?>>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="create-personal">
                            <div class="create-personal-header">Kinder</div>
                            <div>
                                <div class="bio-description">Kinder Name</div>
                                <input type="text" name="ChildName1" class="bio-value" value=<?php echo $this->employee->Children[0]->ChildName; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Kinder Vorame</div>
                                <input type="text" name="ChildLastName1" class="bio-value" value=<?php echo $this->employee->Children[0]->ChildLastName; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Geburtsdatum</div>
                                <input type="date" name="ChildBirthday1" class="bio-value" value=<?php echo $this->employee->Children[0]->ChildBirthday; ?>>
                            </div>

                        </div>
                        <div class="create-personal">
                            <div class="create-personal-header">Kinder</div>
                            <div>
                                <div class="bio-description">Kinder Name</div>
                                <input type="text" name="ChildName2" class="bio-value" value=<?php echo $this->employee->Children[1]->ChildName; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Kinder Vorame</div>
                                <input type="text" name="ChildLastName2" class="bio-value" value=<?php echo $this->employee->Children[1]->ChildLastName; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Geburtsdatum</div>
                                <input type="date" name="ChildBirthday2" class="bio-value" value=<?php echo $this->employee->Children[1]->ChildBirthday; ?>>
                            </div>
                        </div>
                        <div class="create-personal">
                            <div class="create-personal-header">Kinder</div>
                            <div>
                                <div class="bio-description">Kinder Name</div>
                                <input type="text" name="ChildName3" class="bio-value" value=<?php echo $this->employee->Children[2]->ChildName; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Kinder Vorame</div>
                                <input type="text" name="ChildLastName3" class="bio-value" value=<?php echo $this->employee->Children[2]->ChildLastName; ?>>
                            </div>
                            <div>
                                <div class="bio-description">Geburtsdatum</div>
                                <input type="date" name="ChildBirthday3" class="bio-value" value=<?php echo $this->employee->Children[2]->ChildBirthday; ?>>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="js/employeeCreate.js">
</script>