<?php $counter = 1 ?>
<?php foreach ($this->list as $employee) : ?>
<div id="container">


<div class="row employee-card">
      <div class="col-md">
            <div class="employee-main">
                  <form action="/HR/edit" method="post">
                        <input type="hidden" name="idEmployee" value=<?php print htmlentities($employee->Id); ?>>
                        <div class="employee-name" data-status="<?php print htmlentities($employee->Status); ?>"
                              onclick="this.parentNode.submit()">
                              <div style="display:inline-block; vertical-align:top">
                                    <img class="employee-photo" src=<?php print htmlentities($employee->Photo); ?>
                                          alt="" />
                              </div>
                              <div style="display:inline-block; vertical-align:middle; padding-top:10px;">
                                    <div style="display:inline-block; font-size: 18px; margin-top:-3px;">
                                          <div style="display:inline-block">
                                                <?php print htmlentities($employee->Name); ?>
                                          </div>
                                          <div style="display:inline-block">
                                                <?php print htmlentities($employee->LastName); ?>
                                          </div>
                                          <div
                                                style="display:inline-block; position:absolute; top:15px; right:30px; color:#ccc; font-size:11pt">
                                                <?php print htmlentities($counter++); ?>
                                          </div>
                                          <div style="font-size: 12px">
                                                <?php print htmlentities($employee->Position); ?>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </form>
            </div>

            <div class="mail-card-G17">
                  <div class="row">
                        <div class="col-md-4 bio-title">G17 E-Mail:</div>
                        <div class="col-md bio-data">
                              <?php print htmlentities($employee->G17_email) ?>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-md-4 bio-title">G17 Kürzel:</div>
                        <div class="col-md bio-data">
                              <?php print htmlentities($employee->G17_initials) ?>
                        </div>
                  </div>
            </div>

            <div class="mail-card-HHM">
                  <div class="row">
                        <div class="col-md-4 bio-title">HHM E-Mail:</div>
                        <div class="col-md bio-data"><?php print htmlentities($employee->HHM_email) ?></div>
                  </div>

                  <div class="row">
                        <div class="col-md-4 bio-title">HHM Kürzel:</div>
                        <div class="col-md bio-data"><?php print htmlentities($employee->HHM_initials) ?></div>
                  </div>
            </div>

            <div class="row" style="margin-left:0px; margin-bottom:15px">
                  <!--
                  <div class="col-md-3">
                        
                        <form action="/HR/edit" method="post">
                              <input type="hidden" name="idEmployee" value=<?php print htmlentities($employee->Id); ?>>
                              <input class="editButton" type="submit" title="Daten bearbeiten">
                        </form>
                  </div>-->
                  <div class="col-md-3" style="margin-left: 0px; padding-left:0px;">
                        <form action="/HR/calendar" method="post">
                              <input type="hidden" name="idEmployee" value=<?php print htmlentities($employee->Id); ?>>
                              <input class="vacationButton" type="submit" title="Urlaubskalender">
                        </form>
                  </div>
                  <div class="col-md-3" style="margin-left: 0px; padding-left:0px;">
                        <form action="/HR/sick" method="post">
                              <input type="hidden" name="idEmployee" value=<?php print htmlentities($employee->Id); ?>>
                              <input class="sickButton" type="submit" title="Krankheitsurlaub">
                        </form>
                  </div>
                  <div class="col-md-3" style="margin-left: 0px; padding-left:0px;">
                        <button class="deleteButton" data-toggle="modal" data-target="#bucketModalDelete">Test
                              <span class="tooltip-text"> Daten löschen </span></button>
                  </div>
            </div>

      </div>

      <div class="col-md main-personal-data">
            <div class="bio-header">
                  PERSONALIEN
            </div>
            <div class="separator-personal"></div>

            <div class="row">
                  <div class="col-md bio-title">Geburtsdatum</div>
                  <div class="col-md bio-data">
                        <?php print htmlentities(date("d-m-Y", strtotime($employee->BirthDate))); ?></div>
            </div>
            <div class="row">
                  <div class="col-md bio-title">Zivilstand</div>
                  <div class="col-md bio-data"><?php print htmlentities($employee->CivilState); ?></div>
            </div>
            <div class="row">
                  <div class="col-md bio-title">Wohnadresse</div>
                  <div class="col-md bio-data"><?php print htmlentities($employee->Address); ?></div>
            </div>
            <div class="row">
                  <div class="col-md bio-title">PLZ</div>
                  <div class="col-md bio-data"><?php print htmlentities($employee->PLZ); ?></div>
            </div>
            <div class="row">
                  <div class="col-md bio-title">Ort</div>
                  <div class="col-md bio-data"><?php print htmlentities($employee->Place); ?></div>
            </div>
            <div class="row">
                  <div class="col-md bio-title">Telefon</div>
                  <div class="col-md bio-data"><?php print htmlentities($employee->Phone); ?></div>
            </div>
      </div>

      <div class="col-md main-personal-data">
            <div class="bio-header">
                  ARBEIT
            </div>
            <div class="separator-work"></div>

            <div class="row">
                  <div class="col-md-5 bio-title">Eintrittsdatum</div>
                  <div class="col-md bio-data workStartDate">
                        <?php print htmlentities(date("d-m-Y", strtotime($employee->StartDate))); ?>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-5 bio-title">Anzahl Jahre bei G17</div>
                  <div class="col-md bio-data experience">Weniger als ein Jahr.</div>
            </div>
            <div class="row">
                  <div class="col-md-5 bio-title">Kommentar</div>
                  <div class="col-md-7 bio-data"><?php print htmlentities($employee->Comment) ?></div>
            </div>
            <div class="row">
                  <div class="col-md-5 bio-title">Position</div>
                  <div class="col-md-7 bio-data"><?php print htmlentities($employee->Position); ?></div>
            </div>
            <div class="row">
                  <div class="col-md-5 bio-title">Lohn</div>
                  <div class="col-md-7 bio-data" id=<?php print htmlentities($employee->Name.$employee->LastName); ?>><?php print htmlentities($employee->Salary); ?></div>
            </div>
      </div>

      <div class="col-md main-personal-data">
            <div class="bio-header">
                  PASS-ANGABEN
            </div>
            <div class="separator-pass"></div>

            <div class="row">
                  <div class="col-md bio-title">Pass Name</div>
                  <div class="col-md bio-data"><?php print htmlentities($employee->Pass_Name); ?></div>
            </div>
            <div class="row">
                  <div class="col-md bio-title">Pass Vorname</div>
                  <div class="col-md bio-data"><?php print htmlentities($employee->Pass_LastName); ?></div>
            </div>
            <div class="row">
                  <div class="col-md bio-title">Passnummer</div>
                  <div class="col-md bio-data"> <?php print htmlentities($employee->Pass_Number); ?></div>
            </div>
            <div class="row">
                  <div class="col-md bio-title">Gültigkeit</div>
                  <div class="col-md bio-data">
                        <?php print htmlentities(date("d-m-Y", strtotime($employee->Pass_Expired))); ?>
                  </div>
            </div>
      </div>

      <div class="col-md main-personal-data">
            <div class="bio-header">
                  KINDER
            </div>
            <div class="separator-children"></div>
            <table class="table table-stripped table-dark table-sm">
                  <thead class="thead-dark employee-table">
                        <th>Name</th>
                        <th>Vorname</th>
                        <th>Geburtstag</th>
                  </thead>
                  <tbody>
                        <?php foreach ($employee->Children as $child) : {
                                          if (isset($child->Name)) {;
                                          } ?>
                        <tr>
                              <td>
                                    <?php print htmlentities($child->ChildName); ?>
                              </td>
                              <td>
                                    <?php print htmlentities($child->ChildLastName); ?>
                              </td>
                              <td>
                                    <?php print htmlentities(date("d-m-Y", strtotime($child->ChildBirthday))); ?>
                              </td>
                        </tr>
                        <?php }
                        endforeach; ?>
                  </tbody>
            </table>
      </div>

      <div class="col-md main-personal-data">
            <div class="bio-header">
                  SCHWEIZ-AUFENTHALTE
            </div>
            <div class="separator-visit"></div>

            <table class="table table-stripped table-dark table-sm">
                  <thead class="thead-dark employee-table">
                        <th>Datum</th>
                        <th>Standort</th>
                        <th>Unterkunft</th>
                        <th>Ziel</th>
                        <th>Gruppe</th>
                  </thead>
                  <tbody>
                        <?php foreach ($employee->SwissVisit as $visit) : { ?>
                        <tr>
                              <td>
                                    <div style="white-space: nowrap">
                                          <?php print htmlentities(date("d-m-Y", strtotime($visit->StartDate))); ?>

                                    </div>
                                    <div>
                                          <?php print htmlentities(date("d-m-Y", strtotime($visit->EndDate))); ?>
                                    </div>
                              </td>
                              <td>
                                    <?php print htmlentities($visit->Location); ?>
                              </td>
                              <td>
                                    <?php print htmlentities($visit->Accommodation); ?>
                              </td>
                              <td>
                                    <?php print htmlentities($visit->Goal) ?>
                              </td>
                              <td>
                                    <?php print htmlentities($visit->Group) ?>
                              </td>
                        </tr>
                        <?php }
                        endforeach; ?>
                  </tbody>
            </table>
      </div>
</div>
<div class="employee-separator"></div>
</div>

<?php endforeach; ?>



<div class="modal fade" id="bucketModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Drücken Sie Ja, um die Löschung zu bestätigen.
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                  <form action="/HR/delete" method="post">
                        <div class="modal-body">
                              <input type="hidden" name="idEmployee" value=<?php print htmlentities($employee->Id); ?>>
                              <button type="submit" class="btn btn-danger">Ja</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Abbrechen</button>
                        </div>
                        <div class="modal-footer"></div>
                  </form>
            </div>
      </div>
</div>

<script src="/HR/js/employeeDeleteConfirm.js"></script>