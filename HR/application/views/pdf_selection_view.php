<div class="pdf-header-main">
      Prepare PDF
</div>
<div class="pdf-filters" style="display:inline-block; >
<form action="/HR/PDF/print" method="post">
      <div class="pdf-parameter-card">
            <div class="pdf-header">
                  Mitarbeiter
            </div>
            <div style="padding:10px; background: lightblue; height:40vh; overflow-y: scroll">
                  <?php foreach ($this->list as $employee) : ?>
                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name=<?php print htmlentities("Id[]" . $employee->Id) ?>
                                    value=<?php print htmlentities($employee->Id) ?> checked=true>
                        </div>
                        <div class="pdf-value">
                              <?php print htmlentities($employee->Name . " " . $employee->LastName); ?>
                        </div>
                        <div style="display:inline-block; float:right; padding-right:10px; line-height:30px">
                              <?php print htmlentities($employee->Id) ?>
                        </div>
                  </div>
                  <?php endforeach ?>
            </div>

            <div style="width: 280px; margin:0 auto; ">
                  <div style="display:inline-block;">
                        <button class="btn btn-primary pdf-button" id="btn-select-employee"type="button">Select All</button>
                  </div>
                  <div style="display:inline-block; ">
                        <button class="btn btn-danger pdf-button" id="btn-unselect-employee"type="button">Unselect All</button>
                  </div>
            </div>
      </div>

      <div class="pdf-parameter-card">
            <div class="pdf-header">
                  Datei
            </div>
            <div>
                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="PersonalData" value="1" checked=true>
                        </div>
                        <div class="pdf-value">
                              Personalien
                        </div>
                  </div>

                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="Career" value="1" checked=true>
                        </div>
                        <div class="pdf-value">
                              Arbeit
                        </div>
                  </div>

                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="ForeignPassport" value="1" checked=true>
                        </div>
                        <div class="pdf-value">
                              Pass-Angaben
                        </div>
                  </div>

                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="Children" value="1" checked=true>
                        </div>
                        <div class="pdf-value">
                              Kinder
                        </div>
                  </div>

                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="SwissVisit" value="1" checked=true>
                        </div>
                        <div class="pdf-value">
                              Schweiz-Aufenthalte
                        </div>
                  </div>
            </div>
      </div>
      <!--<input type="submit">-->
      <button class="btn btn-primary" type="button" onclick="print()">Print</button>
      </form>
</div>

<div class="pdf-preview">      
      <?php $counter=1 ?>
      <?php foreach ($this->list as $employee) : ?>
      <div class="row print-employee " id=<?php print htmlentities($employee->Id)?>>
            <div class="col-md-2" style="font-size:10pt; border-right:1px solid black">
                  <div >
                        <div>
                              <img class="employee-photo" src=<?php print htmlentities($employee->Photo); ?>>
                        </div>

                        <?php print htmlentities($counter++.". ".$employee->Name. " " .$employee->LastName) ?>

                  </div>
                  <div>
                        <?php print htmlentities($employee->Position)?>
                  </div>
            </div>
            <div class="col-md" style="vertical-align: top; ">
                  <div class="print-personal">
                        <div>
                              Geburtsdatum: <?php print htmlentities(date("d-m-Y", strtotime($employee->BirthDate))) ?>
                        </div>
                        <div>
                              Zivilstand: <?php print htmlentities($employee->CivilState)?>
                        </div>
                        <div>
                              Wohnadresse: <?php print htmlentities($employee->Address)?>
                        </div>
                        <div>
                              PLZ: <?php print htmlentities($employee->PLZ)?>
                        </div>
                        <div>
                              Ort: <?php print htmlentities($employee->Place)?>
                        </div>
                        <div>
                              Telefon: <?php print htmlentities($employee->Phone)?>
                        </div>

                  </div>
                  <div class="print-career">
                        <div>
                              Eintrittsdatum:
                              <?php print htmlentities(date("d-m-Y", strtotime($employee->StartDate))) ?>
                        </div>
                        <div>
                              Kommentar: <?php print htmlentities($employee->Comment)?>
                        </div>
                        <div>
                              Position: <?php print htmlentities($employee->Position)?>
                        </div>
                  </div>

                  <div class="print-pass">
                        <div>
                              Pass Name: <?php print htmlentities($employee->Pass_Name)?>
                        </div>
                        <div>
                              Pass Vorname: <?php print htmlentities($employee->Pass_LastName)?>
                        </div>
                        <div>
                              Passnummer: <?php print htmlentities($employee->Pass_Number)?>
                        </div>
                        <div>
                              Gültigkeit: <?php print htmlentities(date("d-m-Y", strtotime($employee->Pass_Expired)))?>
                        </div>
                  </div>
                  <div class="print-children">
                        <div class="row">
                              <div class="col-md-4">
                                    Name
                              </div>
                              <div class="col-md-4">
                                    Vorname
                              </div>
                              <div class="col-md-4">
                                    Geburtstag
                              </div>
                        </div>
                        <?php foreach ($employee->Children as $child) : {
                                          if (isset($child->Name)) {;
                                          } ?>
                        <div class="row">
                              <div class="col-md-4">
                                    <?php print htmlentities($child->ChildName)?>
                              </div>
                              <div class="col-md-4">
                                    <?php print htmlentities($child->ChildLastName)?>
                              </div>
                              <div class="col-md-4">
                                    <?php print htmlentities(date("d.m.Y", strtotime($child->ChildBirthday))); ?>
                              </div>
                        </div>
                        <?php } endforeach?>
                  </div>

                  <div class="print-visit">

                        <div class="row" style="margin:0; margin: 0px; 100px">
                              <div class="col-md-2">
                                    Datum
                              </div>
                              <div class="col-md-3">
                                    Standort
                              </div>
                              <div class="col-md-3">
                                    Unterkunft
                              </div>
                              <div class="col-md-2">
                                    Ziel
                              </div>
                              <div class="col-md-2">
                                    Gruppe
                              </div>
                        </div>

                        <?php foreach ($employee->SwissVisit as $visit) :  ?>
                        <div class="row" style="margin:0">
                              <div class="col-md-2">
                                    <?php print htmlentities(date("d-m-Y", strtotime($visit->StartDate))); ?>
                                    <?php print htmlentities(date("d-m-Y", strtotime($visit->EndDate))); ?>
                              </div>
                              <div class="col-md-3">
                                    <?php print htmlentities($visit->Location); ?>
                              </div>
                              <div class="col-md-3">
                                    <?php print htmlentities($visit->Accommodation); ?>
                              </div>
                              <div class="col-md-2">
                                    <?php print htmlentities($visit->Goal) ?>
                              </div>
                              <div class="col-md-2">
                                    <?php print htmlentities($visit->Group)?>
                              </div>
                        </div>
                        <?php endforeach; ?>
                  </div>
            </div>
      </div>
      <?php endforeach ?>
</div>

<script src="/HR/js/print.js"></script>