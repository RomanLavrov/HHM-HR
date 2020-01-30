<div class="create-body">
      <form action="/uploadphoto" method="post" enctype="multipart/form-data">
            <input class="input1" id="imageUpload" type="file" name="fileToUpload">
            <input class="input2" id="imageButton" type="submit" value="Upload Image" name="photo">
      </form>

      <form action="/create" method="post">
            <div class="row">
                  <div class="col-md-3">
                        <div id="personal-main" class="create-personal">
                              <div class="create-personal-header">Mitarbeiter</div>

                              <div class="personal-image">

                                    <img src=<?php echo $this->user_photo; ?>
                                          onerror="this.onerror=null;this.src='images/user.png';">
                                    <label id="fileNameLabel" class="input-label-text">Foto auswählen</label>
                                    <div>
                                          <label for=""><?php echo $this->upload_err; ?></label>
                                    </div>

                                    <input type="hidden" name="Photo" value=<?php echo $this->user_photo; ?>>
                                    <div class="input-buttons">
                                          <label class="input-label-select" for="imageUpload">Durchsuche</label>
                                          <label class="input-label-upload" for="imageButton">Hochladen</label>
                                    </div>
                              </div>

                              <div>
                                    <div class="bio-description">Name</div>
                                    <input type="text" name="Name" class="bio-value">
                              </div>

                              <div>
                                    <div class="bio-description">Vorname</div>
                                    <input type="text" name="LastName" class="bio-value">
                              </div>

                              <div>
                                    <div class="bio-description">Arbeitsstatus</div>                                   
                                    <input list="WorkStatus" type="text" name="Status" class="bio-value">
                                    <datalist id="WorkStatus">
                                          <option value="Arbeitet"></option>
                                          <option value="Ausgetreten"></option>
                                          <option value="Mutterschlafsurlaub"></option>
                                    </datalist>
                              </div>

                              <input type="submit" id="btn-add" class="personal-categories-btn" value="Speichern">
                              <a id="btn-cancel" class="personal-categories-btn" href="/main">Abbrechen</a>
                        </div>
                  </div>

                  <div id="personal-details" class="col-md-9">
                        <div id="personal-details-header" class="create-personal-header">Details</div>
                        <div class="row">
                              <div class="col-md-4">
                                    <div class="create-personal">
                                          <div class="create-personal-header">Persönliche Daten</div>

                                          <div>
                                                <div class="bio-description">Geburtsdatum</div>
                                                <input type="date" name="BirthDate" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Zivilstand</div>

                                                <input list="CivilStand" name="CivilState" class="bio-value">
                                                <datalist id="CivilStand">
                                                      <option value="Ledig">
                                                      <option value="Verheiratet">
                                                      <option value="Geschieden">
                                                      <option value="Verwitwet">
                                                </datalist>
                                          </div>
                                          <div>
                                                <div class="bio-description">Wohnadresse</div>
                                                <input type="text" name="Address" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">PLZ</div>
                                                <input type="text" name="PLZ" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Ort</div>
                                                <input type="text" name="Place" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Telefonnummer</div>
                                                <input type="tel" name="Phone" class="bio-value"
                                                      pattern="+38([0-9]{3})">
                                          </div>
                                    </div>

                                    <div class="create-personal">
                                          <div class="create-personal-header">Reisepass</div>
                                          <div>
                                                <div class="bio-description">Pass Name</div>
                                                <input type="text" name="Pass_Name" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Pass Vorname</div>
                                                <input type="text" name="Pass_LastName" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Pass Nummer</div>
                                                <input type="text" name="Pass_Number" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Gültigkeit:</div>
                                                <input type="date" name="Pass_Expired" class="bio-value">
                                          </div>
                                    </div>

                                    <div class="create-personal-short">
                                          <div class="create-personal-header">Karriere</div>
                                          <div>
                                                <div class="bio-description">Eintrittsdatum</div>
                                                <input type="date" name="CareerStart" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Kommentar</div>
                                                <input type="text" name="Comment" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Position</div>
                                                <input type="text" name="Position" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Lohn</div>
                                                <input type="text" name="Salary" class="bio-value">
                                          </div>
                                    </div>

                              </div>

                              <div class="col-md-4">
                                    <div class="create-personal-short">                       
                                          <div class="create-personal-header">G17</div>
                                          <div>
                                                <div class="bio-description">G17 E-Mail</div>
                                                <input type="text" name="G17_email" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">G17 Kürzel</div>
                                                <input type="text" name="G17_initials" class="bio-value">
                                          </div>
                                    </div>

                                    <div class="create-personal-short">
                                          <div class="create-personal-header">HHM</div>
                                          <div>
                                                <div class="bio-description">HHM E-Mail</div>
                                                <input type="text" name="HHM_email" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">HHM Kürzel</div>
                                                <input type="text" name="HHM_initials" class="bio-value">
                                          </div>
                                    </div>

                                    <div class="create-personal">
                                          <div class="create-personal-header">Kinder</div>
                                          <div>
                                                <div class="bio-description">Kinder Name</div>
                                                <input type="text" name="ChildName1" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Kinder Vorname</div>
                                                <input type="text" name="ChildLastName1" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Geburtsdatum</div>
                                                <input type="date" name="ChildBirthday1" class="bio-value">
                                          </div>
                                    </div>

                                    <div class="create-personal">
                                          <div class="create-personal-header">Kinder</div>
                                          <div>
                                                <div class="bio-description">Kinder Name</div>
                                                <input type="text" name="ChildName2" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Kinder Vorname</div>
                                                <input type="text" name="ChildLastName2" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Geburtsdatum</div>
                                                <input type="date" name="ChildBirthday2" class="bio-value">
                                          </div>
                                    </div>

                                    <div class="create-personal">
                                          <div class="create-personal-header">Kinder</div>
                                          <div>
                                                <div class="bio-description">Kinder Name</div>
                                                <input type="text" name="ChildName3" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Kinder Vorname</div>
                                                <input type="text" name="ChildLastName3" class="bio-value">
                                          </div>
                                          <div>
                                                <div class="bio-description">Geburtsdatum</div>
                                                <input type="date" name="ChildBirthday3" class="bio-value">
                                          </div>
                                    </div>
                              </div>

                              <div class="col-md-4">
                                    <div id="visitPlaceholder">                                    
                                          <div class="create-personal-short" >
                                                <div class="create-personal-header"><div style="display:inline-block">Schweiz-Aufenthalte</div>
                                                <button id="btnVisitRemove" class="btn btn-danger" type="button" onclick="DeleteVisit(this)" style="height:30px; line-height:10px; vertical-align:middle;  margin-left:80px; display:inline-block">Entfernen</button>
                                                </div>
                                                
                                                <div>
                                                      <div class="bio-description">Reisebeginn</div>
                                                      <input type="date" name="visit[VisitStart_1]" class="bio-value">
                                                </div>
                                                <div>
                                                      <div class="bio-description">Reiseende</div>
                                                      <input type="date" name="visit[VisitEnd_1]" class="bio-value">
                                                </div>
                                                <div>
                                                      <div class="bio-description">Standort</div>
                                                      <input type="text" name="visit[VisitLocation_1]" class="bio-value">
                                                </div>
                                                <div>
                                                      <div class="bio-description">Unterkunft</div>
                                                      <input type="text" name="visit[VisitAccommodation_1]" class="bio-value">
                                                </div>                                                                                                                                                                                                                       
                                                <div>
                                                      <div class="bio-description">Ziel</div>
                                                      <input type="text" name="visit[VisitGoal_1]" class="bio-value">
                                                </div>
                                                <div>
                                                      <div class="bio-description">Gruppe</div>
                                                      <input type="text" name="visit[VisitGroup_1]" class="bio-value">
                                                </div>
                                          </div>
                                    </div>
                                    <button id="btnAddVisit" type="button" class="btn btn-success">Neues Reisen</button>
                              </div>

                        </div>
                  </div>
            </div>
      </div>
</form>


<div id="visitTemplate" class="create-personal-short" style="visibility:hidden">
      <div class="create-personal-header">Schweiz-Aufenthalte
            <button id="btnVisitRemove" class="btn btn-danger" type="button" onclick="DeleteVisit(this)" style="height:30px; line-height:10px; margin-left:80px; display:inline-block">Entfernen</button>
      </div>
      <div>
            <div class="bio-description">Reisebeginn</div>
            <input type="date" name="visit[VisitStart_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Reiseende</div>
            <input type="date" name="visit[VisitEnd_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Standort</div>
            <input type="text" name="visit[VisitLocation_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Unterkunft</div>
            <input type="text" name="visit[VisitAccommodation_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Ziel</div>
            <input type="text" name="visit[VisitGoal_1]" class="bio-value">
      </div>
      <div>
            <div class="bio-description">Gruppe</div>
            <input type="text" name="visit[VisitGroup_1]" class="bio-value">
      </div>
</div>

<script src="js/employeeCreate.js">
</script>