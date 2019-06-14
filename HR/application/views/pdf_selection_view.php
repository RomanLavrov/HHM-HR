<div class="row" style="background: $fdfdfd; padding-top:15px; width:100%">

      <div class="col-md-3 pdf-filters" style="display:inline-block; width:100%">
            <div class="pdf-parameter-card">
                  <div class="pdf-header">
                        Mitarbeiter
                  </div>
                  <div class="pdf-parameter-card-employee">
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


            </div>
            <div class="row" style="margin-right:0px; margin-bottom:15px;">
                  <div class="col-md-6">
                        <button class="btn btn-primary pdf-button" id="btn-select-employee" type="button">Alle
                              auswählen</button>
                  </div>
                  <div class="col-md-6">
                        <button class="btn btn-danger pdf-button" id="btn-unselect-employee" type="button">Alle
                              abwählen</button>
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

            <div class="row" style="margin-right:0px">
                  <div class="col-md-6">
                        <button class="btn btn-primary pdf-button" id="btn-select-categories">Alle
                              auswählen</button>
                  </div>
                  <div class="col-md-6">
                        <button class="btn btn-danger pdf-button" id="btn-unselect-categories">Alle
                              abwählen</button>
                  </div>
            </div>
            <div style="margin: 0px 15px;">
                  <button class="btn btn-success pdf-print" type="button" onclick="print()">Drucken</button>
            </div>
            <!--<input type="submit">-->
            </form>
      </div>

      <div class="col-md-9">
            <div class="pdf-header-preview">
                  Vorschau
            </div>
            <div class="pdf-preview-container">
                  <div class="pdf-preview">
                        <?php $counter = 1 ?>
                        <?php foreach ($this->list as $employee) : ?>
                        <div class="print-employee" id=<?php print htmlentities($employee->Id) ?>>
                              <div style="width: 20%;  display:inline-block; height:auto">
                                    <div style="text-align:center">
                                          <div>
                                                <img class="employee-photo"
                                                      style=" margin-top:15px; margin-left:auto; margin-right:auto; display: block"
                                                      src=<?php print htmlentities($employee->Photo); ?>>
                                          </div>

                                          <?php print htmlentities($counter++ . ". " . $employee->Name . " " . $employee->LastName) ?>
                                    </div>
                                    <div style="text-align:center">
                                          <?php print htmlentities($employee->Position) ?>
                                    </div>
                              </div>

                              <div style="display:inline-block; vertical-align:top; width:79%">
                                    <div class="row pdf-print-data" style="width:100%">
                                          <div class="col-md print-personal">
                                                <div>
                                                      Geburtsdatum:
                                                      <?php print htmlentities(date("d-m-Y", strtotime($employee->BirthDate))) ?>
                                                </div>
                                                <div>
                                                      Zivilstand:
                                                      <?php print htmlentities($employee->CivilState) ?>
                                                </div>
                                                <div>
                                                      Wohnadresse: <?php print htmlentities($employee->Address) ?>
                                                </div>
                                                <div>
                                                      PLZ: <?php print htmlentities($employee->PLZ) ?>
                                                </div>
                                                <div>
                                                      Ort: <?php print htmlentities($employee->Place) ?>
                                                </div>
                                                <div>
                                                      Telefon: <?php print htmlentities($employee->Phone) ?>
                                                </div>
                                          </div>
                                          <div class="col-md print-career">
                                                <div>
                                                      Eintrittsdatum:
                                                      <?php print htmlentities(date("d-m-Y", strtotime($employee->StartDate))) ?>
                                                </div>
                                                <div>
                                                      Kommentar: <?php print htmlentities($employee->Comment) ?>
                                                </div>
                                                <div>
                                                      Position: <?php print htmlentities($employee->Position) ?>
                                                </div>
                                          </div>
                                          <div class="col-md print-pass">
                                                <div>
                                                      Pass Name: <?php print htmlentities($employee->Pass_Name) ?>
                                                </div>
                                                <div>
                                                      Pass Vorname:
                                                      <?php print htmlentities($employee->Pass_LastName) ?>
                                                </div>
                                                <div>
                                                      Passnummer:
                                                      <?php print htmlentities($employee->Pass_Number) ?>
                                                </div>
                                                <div>
                                                      Gültigkeit:
                                                      <?php print htmlentities(date("d-m-Y", strtotime($employee->Pass_Expired))) ?>
                                                </div>
                                          </div>
                                          <div class="col-md print-children">

                                                <table class="table table-sm table-stripped">
                                                      <thead>
                                                            <tr>
                                                                  <td>Kinder Name</td>
                                                                  <td>Vorname</td>
                                                                  <td>Geburtstag</td>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            <?php foreach ($employee->Children as $child) : {
                                                                        if (isset($child->Name)) {;
                                                                        } ?>
                                                                        <tr>
                                                                              <td><?php print htmlentities($child->ChildName) ?></td>
                                                                              <td><?php print htmlentities($child->ChildLastName) ?></td>
                                                                              <td><?php print htmlentities(date("d.m.Y", strtotime($child->ChildBirthday))); ?></td>
                                                                        </tr>
                                                            <?php }
                                                      endforeach ?>
                                                      </tbody>
                                                </table>                                               

                                          </div>
                                          <div class="col-md print-visit">
                                                <table class="table table-sm table-stripped">
                                                      <thead>
                                                                        <tr>
                                                                              <td>Datum</td>
                                                                              <td>Standort</td>
                                                                              <td>Unterkunft</td>
                                                                              <td>Ziel</td>
                                                                              <td>Gruppe</td>
                                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <?php foreach ($employee->SwissVisit as $visit) :  ?>
                                                      <tr>
                                                            <td> <?php print htmlentities(date("d-m-Y", strtotime($visit->StartDate))); ?>
                                                            <?php print htmlentities(date("d-m-Y", strtotime($visit->EndDate))); ?></td>
                                                            <td><?php print htmlentities($visit->Location); ?></td>
                                                            <td><?php print htmlentities($visit->Accommodation); ?></td>
                                                            <td><?php print htmlentities($visit->Goal) ?></td>
                                                            <td><?php print htmlentities($visit->Group) ?></td>
                                                      </tr>
                                                      <?php endforeach; ?>

                                                      </tbody>
                                                </table>
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <?php endforeach ?>
                  </div>
            </div>
      </div>

</div>
<script src="/HR/js/print.js"></script>