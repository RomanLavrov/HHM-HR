<script src="/HR/js/employeeDeleteConfirm.js"></script>
<table class="table table-striped table-light table-fixed" style="display:table; table-layout:fixed; width:100%; margin-top:40px;">
      <thead class="thead-dark"
            style="position: fixed; top: 50px;left: 80;width: 100%;height: 50px;table-layout: fixed;display: table; z-index:100 !important; margin-top:10px;">
            <tr style="border:1px solid black; z-index:">
                  <th class="category-id" style="vertical-align: middle; ">ID</th>
                  <th class="category-personal" style="vertical-align: middle">Mitarbeiter</th>
                  <th class="category-personalData" style="vertical-align: middle">Personalien</th>
                  <th class="category-career" style="vertical-align: middle">Arbeit</th>
                  <th class="category-passport" style="vertical-align: middle">Pass-Angaben</th>
                  <th class="category-children" style="vertical-align: middle">Kinder</th>
                  <th class="category-HHM" style="vertical-align: middle; text-align:left">Schweiz-Aufenthalte</th>
            </tr>
      </thead>
      <tbody style="display:table; margin-top:10px; width:100%; table-layout:fixed">
            <?php $counter = 1 ?>
            <?php foreach ($this->list as $employee) : ?>
            <tr>
                  <td class="category-id">
                        <div>
                              <?php print htmlentities($counter++); ?>

                              <span><img src="images/Work.svg" alt="" style="background:forestgreen">
                              <?php print htmlentities($employee->Status)?></span>
                        </div>
                       
                  </td>
                  <td class="category-personal border-right">
                        <div class="employee-main">
                              <div class="employee-name">
                                    <img class="employee-photo" src=<?php print htmlentities($employee->Photo); ?>
                                          alt="">
                                    <div style="display:inline-block">
                                          <?php print htmlentities($employee->Name); ?>
                                    </div>
                                    <div style="display:inline-block">
                                          <?php print htmlentities($employee->LastName); ?>
                                    </div>
                              </div>
                        </div>

                        <div class="row" style=" width:300px; z-index=-10">
                                    <div class="col-md-3">
                                          <form action="/HR/edit" method="post">
                                          <input type="hidden" name="idEmployee"
                                                value=<?php print htmlentities($employee->Id); ?>>
                                          <input class="editButton" type="submit" title="Daten bearbeiten">
                                    </form>
                                    </div>
                                    <div class="col-md-3" style="margin-left: 0px;">
                                    <form action="/HR/calendar" method="post">
                                          <input type="hidden" name="idEmployee"
                                                value=<?php print htmlentities($employee->Id); ?>>
                                          <input class="vacationButton" type="submit" title="Urlaubskalender">
                                    </form>
                                    </div>

                                    <div class="col-md-3">
                                    <form action="/HR/sick" method="post">
                                          <input type="hidden" name="idEmployee"
                                                value=<?php print htmlentities($employee->Id); ?>>
                                          <input class="sickButton" type="submit" title="Krankheitsurlaub">
                                    </form>
                                    </div>
                                    <div class="col-md-3">
                                    <button class="deleteButton" data-toggle="modal"
                                          data-target="#bucketModalDelete">Test
                                          <span class="tooltip-text"> Daten löschen </span></button>
                                    </div>
                             </div>

                        <div class="mail-card-G17">
                                    <div>G17 E-Mail:</div>
                                    <div>
                                          <?php print htmlentities($employee->G17_email)?>
                                    </div>
                                    <div>
                                          G17 Kürzel: <?php print htmlentities($employee->G17_initials)?>
                                    </div>
                              </div>

                        <div class="mail-card-HHM">
                                    <div>HHM E-Mail:</div>
                                    <div>
                                          <?php print htmlentities($employee->HHM_email)?>
                                    </div>
                                    <div>
                                          HHM Kürzel: <?php print htmlentities($employee->HHM_initials)?>
                                    </div>
                              </div>         

                       
                  </td>

                  <td class="category-personalData">
                        <table class="table table-sm table-hover table-bordered">
                              <tbody>
                                    <tr>
                                          <td>Geburtsdatum</td>
                                          <td><?php print htmlentities(date("d-m-Y", strtotime($employee->BirthDate))); ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Zivilstand</td>
                                          <td><?php print htmlentities($employee->CivilState); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Wohnadresse</td>
                                          <td><?php print htmlentities($employee->Address); ?></td>
                                    </tr>
                                    <tr>
                                          <td>PLZ</td>
                                          <td><?php print htmlentities($employee->PLZ); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Ort</td>
                                          <td><?php print htmlentities($employee->Place); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Telefon</td>
                                          <td><?php print htmlentities($employee->Phone); ?></td>
                                    </tr>
                              </tbody>
                        </table>
                  </td>

                  <td class="category-career">
                        <table class="table table-sm table-hover table-bordered">
                              <tbody>
                                    <tr>
                                          <td>Eintrittsdatum</td>
                                          <td class="workStartDate">
                                                <?php print htmlentities(date("d-m-Y", strtotime($employee->StartDate))); ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Anzahl Jahre bei G17</td>
                                          <td class="experience">Weniger als ein Jahr.</td>
                                    </tr>
                                    <tr>
                                          <td>Kommentar</td>
                                          <td><?php print htmlentities($employee->Comment) ?></td>
                                    </tr>
                                    <tr>
                                          <td>Position</td>
                                          <td><?php print htmlentities($employee->Position); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Lohn</td>
                                          <td><?php print htmlentities($employee->Salary); ?></td>
                                    </tr>
                              </tbody>
                        </table>
                  </td>
                  <td class="category-passport">
                        <table class="table table-sm table-hover table-bordered">
                              <tbody>
                                    <tr>
                                          <td>Pass Name</td>
                                          <td><?php print htmlentities($employee->Pass_Name); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Pass Vorname</td>
                                          <td><?php print htmlentities($employee->Pass_LastName); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Passnummer</td>
                                          <td> <?php print htmlentities($employee->Pass_Number); ?></td>
                                    </tr>
                                    <tr>
                                          <td>Gültigkeit</td>
                                          <td><?php print htmlentities(date("d-m-Y", strtotime($employee->Pass_Expired))); ?>
                                          </td>
                                    </tr>
                              </tbody>
                        </table>
                  </td>

                  <td class="category-children">
                        <table class="table table-sm table-hover table-bordered">
                              <thead>
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
</td>


<td class="category-HHM">
      <table class="table table-sm table-hover table-bordered">
            <thead>
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
</td>
<?php endforeach; ?>
</tbody>
</table>

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